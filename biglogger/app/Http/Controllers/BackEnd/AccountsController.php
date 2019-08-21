<?php
namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use App\User;
use App\CheckInfo;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountsController extends Controller
{
    public function Index(Request $request)
    {
        $data = [];
        $data['title'] = 'Accounts List';

        $objUser = new User();

        if (empty(session()->get('auth')))
            return redirect()->route('ViewHome');

        if (session()->get('auth')->id_privilege != 1)
            return redirect()->route('App');

        //tạo link sắp xếp
        session($request->all());
        if (!session()->has('sort'))
            session(['sort'=>'desc']);
        $route = route('AccountList');
        if (!session()->has('keyword')){
            if (session()->has('sort')) {
                if (session()->get('sort') == 'asc')
                    $linkhref = $route . '/?sort=desc&type=';
                if (session()->get('sort') == 'desc')
                    $linkhref = $route . '/?sort=asc&type=';
            }else
                $linkhref = $route . '/?sort=desc&type=';
            $data['linkhref'] = $linkhref;
        }
        else{
            if (session()->has('sort')){
                if (session()->get('sort') == 'asc')
                    $linkhref = route('AccountList').'/?keyword='.session()->get('keyword').'&sort=desc&type=';
                if (session()->get('sort') == 'desc')
                    $linkhref = route('AccountList').'/?keyword='.session()->get('keyword').'&sort=asc&type=';
            }else
                $linkhref = $route . '/?keyword='.session()->get('keyword').'&sort=desc&type=';
            $data['linkhref'] = $linkhref;
        }

        if($request->has('type'))
            $objUser->row = $request->get('type');
        if ($request->has('sort'))
            $objUser->sort = $request->get('sort');
        $data['account-list']=$objUser->search($request->get('keyword'));
        $data['keyword'] = $request->get('keyword');

        $data['count'] = $objUser->count();

        return view('BackEnd.Accounts.index',['data'=>$data]);
    }
    public function Create(Request $request){
        $data = ['msg'=>[]];
        // thêm mới
        $data['title'] ="Create New Accounts";

        if (empty(session()->get('auth')))
            return redirect()->route('ViewHome');

        if (!session()->get('id_privilege')==1)
            return redirect()->route('App');

        if ($request->isMethod('post') && $request->has('create')) {
            $objCheckInfo = new CheckInfo();
            $objAccounts = new User();

            $rules = array(
                'username'    => 'required|alphaNum|min:5',
                'firstname'=>'required|min:3',
                'lastname'=>'required|min:3',
                'email' => 'email',
                'password'=>'required|min:6|max:20',
                'password_confirm'=>'required|min:6|max:20'
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                foreach($validator->errors()->getMessages() as $k)
                    foreach ($k as $e)
                        $data['msg'][] = $e;
            } else {
                $objCheckInfo->encode = hash::make($request->get('password_confirm'));
                $password = $objCheckInfo->encodePassword();
                $checkEmail = $objCheckInfo->checkEmail($request->get('email'));
                $checkusername = $objCheckInfo->checkUsername($request->get('username'));
                if ($checkEmail)
                    $data['msg'][] = 'Email đã tồn tại';
                if ($checkusername)
                    $data['msg'][] = 'Username đã tồn tại';
                else{
                    $encode = hash::make($request->get('password_confirmation'));
                    $username = $request->get('username');
                    $objCheckInfo->encode = $encode;
                    $objAccounts->firstname = $_POST['firstname'];
                    $objAccounts->lastname = $_POST['lastname'];
                    $objAccounts->username = $username;
                    $objAccounts->encode = $encode;
                    $objAccounts->password = $password;
                    $objAccounts->email = $request->get('email');
                    $objAccounts->id_privilege = 2;//nhân viên

                    $res = $objAccounts->SaveNew();
                    if ($res) {
                        $Login = $objAccounts->Login();
                        if (is_a($Login, 'stdClass')) {
                            // nếu kết quả của hàm là 1 đối tượng kiểu stdClass ==> là đăng ký thành công.
                            // ghi vào session
                            session(['auth' => $Login]); // bỏ đối tượng này vào biến session
                            return redirect()->route('AccountList');
                        }else{
                            $data['msg'][] = 'thông tin tài khoản không đúng';
                        }
                    }
                }
            }
        }
        return view('BackEnd.Accounts.create',['data'=>$data]);
    }
    public function Edit($id,Request $request){
        $data = [];
        $data['title'] = "Edit Accounts";

        if (empty(session()->get('auth')))
            return redirect()->route('ViewHome');

//        if (session()->get('id_privilege')==1)
//            return redirect()->route('App');

        if(!isset($id)) die("ID not found");

        //load thông tin lên form
        $objAccounts = new User();
        $objAccounts->id_user = $id;
        $data['account-edit'] = $objAccounts->loadOne();

        //click vào cancel chuyển về trang /accounts/



        if($request->isMethod('post')) {
            $objCheckInfo = new CheckInfo();

            $rules = array(
                'username'    => 'required|alphaNum|min:5',
                'email' => 'email',
                'firstname'=>'required|min:3',
                'lastname'=>'required|min:3',
                'password_confirm'=>'required|min:6|max:20'
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                foreach($validator->errors()->getMessages() as $k)
                    foreach ($k as $e)
                        $data['msg'][] = $e;
            } else {
                $objCheckInfo->strUsername=session()->get('auth')->username;
                $objCheckInfo->strPassword=$request->get('password_confirm');
                $Password = $objCheckInfo->encodePassword();
                $checkPassword = $objCheckInfo->checkPassword($Password);
                $checkusername = $objCheckInfo->checkUsername($request->get('username'));
                if (!$checkPassword)
                    $data['msg'][] = 'password không đúng';
                elseif (!$checkusername)
                    $data['msg'][] = 'Tên username không đúng';
                else{
                    //thực hiện sửa tài khoản
                    $objAccounts->id_user = $id;
                    $objAccounts->firstname = $request->get('firstname');
                    $objAccounts->lastname = $request->get('lastname');
                    $objAccounts->email = $request->get('email');
                    $objAccounts->username = session()->get('auth')->username;
                    $objAccounts->password = $Password;
                    $res = $objAccounts->SaveUpdate();
                    if ($res){
                        if (session()->get('auth')->id_user == $data['account-edit']->id_user){
                            $Login = $objAccounts->Login();
                            session(['auth'=>$Login]);
                        }
                        $data['account-edit'] = $objAccounts->loadOne();
                        return redirect()->route('AccountList');
                    }
                }
            }

        }
        return view('BackEnd.Accounts.edit',['data'=>$data]);
    }
}
