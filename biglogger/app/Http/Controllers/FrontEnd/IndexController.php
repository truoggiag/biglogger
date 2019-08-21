<?php
namespace App\Http\Controllers\FrontEnd;
use App\FunctionGet;
use App\Http\Controllers\Controller;
use App\User;
use App\CheckInfo;
use http\Message;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller {
    use AuthenticatesUsers;
    public function index() {
        $data = [];
        //title
        $data['title']='Home';

        //get ip
        $data['ip'] = $_SERVER["REMOTE_ADDR"];

        // datetime now
        $data['date'] = date('H:i:s d-m-Y');

        $functionGet = new FunctionGet();
        $data['strSystem'] = $functionGet->getOS($_SERVER['HTTP_USER_AGENT']);
        $GetBrowser = $functionGet->getBrowser($_SERVER['HTTP_USER_AGENT']);
        $getLocation = $functionGet->getLocation($_SERVER['REMOTE_ADDR']);
        $geo = explode(',',$getLocation);
        if (!empty($geo[0]))
            $data['city'] = $geo[0];
        else
            $data['city'] = 'Không Xác Định';

        if (!empty($geo[1]))
            $data['country'] = $geo[1];
        else
            $data['country'] = 'Không Xác Định';

        $data['strBrowser'] = $GetBrowser['name'] .' '. $GetBrowser['version'];

        $objUser = new User();

        $data['count'] = $objUser->count();

        return view('FrontEnd.index',['data'=>$data]);
    }
    public function login(Request $request) {
        $data = ['msg'=>[]];
        //tiêu đề
        $data['title']='Login';
        //nếu đã đăng nhập rồi thì chuyển trang app
        if (!empty(session()->get('auth')))
            return redirect()->route('App');

        if ($request->isMethod('post'))
        {
            $objAccounts = new User();
            $objcheckinfo = new CheckInfo();
            $rules = array(
                'username'    => 'required|alphaNum|min:5',
                'password' => 'required|min:6|max:20'
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                foreach($validator->errors()->getMessages() as $k)
                    foreach ($k as $e)
                        $data['msg'][] = $e;
            } else {
                $checkusername = $objcheckinfo->checkUsername($request->get('username'));
                if ($checkusername){
                    $username = $request->get('username');
                    $objcheckinfo->strUsername = $username;

                    $password = $request->get('password');
                    $objcheckinfo->strPassword = $password;

                    print_r($username);
                    echo "<br>";
                    print_r($password);
                    echo '<br>';
                    $password = $objcheckinfo->encodePassword();
                    // thực hiện login
                    $objAccounts->password = $password;
                    $objAccounts->username = $username;

//                    echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')';
//                        var_dump($objAccounts);
//                    echo '</pre>';
//                    die();
                    $Login = $objAccounts->Login();
                    if (is_a($Login, 'stdClass')) {
                        // nếu kết quả của hàm là 1 đối tượng kiểu stdClass ==> đăng nhập thành công.
                        // ghi vào session
                        session(['auth' => $Login]);
                        if ($Login->id_privilege == 1)
                            return redirect()->route('AccountList');
                        else
                            return redirect()->route('App');
                    }else{
                        $data['msg'][] = 'thông tin tài khoản không đúng';
                    }
                }else
                    $data['msg'][] = 'thông tin tài khoản không đúng';

            }
        }
        return view('FrontEnd.login',['data'=>$data]);
    }
    public function register(Request $request) {
        $data = ['msg'=>[]];
        //tiêu đề
        $data['title'] = "Register";
        //nếu đã đăng nhập rồi thì chuyển trang app
        if (!empty(session()->get('auth')))
            return redirect()->route('App');

        if ($request->isMethod('post'))
        {
            $rules = array(
                'firstname'=> 'required|alphaNum|min:3',
                'lastname'=> 'required|alphaNum|min:3',
                'email'=> 'email',
                'username'    => 'required|alphaNum|min:5',
                'password' => 'required|min:6|max:20',
                'password_confirmation'=> 'required|min:6|max:20'
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                foreach($validator->errors()->getMessages() as $k)
                    foreach ($k as $e)
                        $data['msg'][] = $e;
            } else {
                $objcheckinfo = new CheckInfo();
                $checkusername = $objcheckinfo->checkUsername($request->get('username'));
                $checkEmail = $objcheckinfo->checkEmail($request->get('email'));
                if ($checkEmail)
                    $data['msg'][]='Email đã tồn tại';
                elseif ($checkusername)
                    $data['msg'][]='Username đã tồn tại';
                else{
                    $encode = hash::make($request->get('password_confirmation'));
                    $username = $request->get('username');
                    $objcheckinfo->encode = $encode;
                    $objcheckinfo->strPassword = $request->get('password_confirmation');
                    $objAccounts = new User();
                    $objAccounts->firstname = $request->get('firstname');
                    $objAccounts->lastname = $request->get('lastname');
                    $objAccounts->username = $username;
                    $objAccounts->encode = $encode;
                    $objAccounts->password = $objcheckinfo->encodePassword();
                    $objAccounts->email = $request->get('email');
                    $objAccounts->id_privilege = 3;//khách hàng

                    $res = $objAccounts->SaveNew();
                    if ($res) {
                        $Login = $objAccounts->Login();
                        if (is_a($Login, 'stdClass')) {
                            // nếu kết quả của hàm là 1 đối tượng kiểu stdClass ==> là đăng ký thành công.
                            // ghi vào session
                            session(['auth' => $Login]); // bỏ đối tượng này vào biến session
                            return redirect()->route('App');
                        }else{
                            $data['msg'][] = 'thông tin tài khoản không đúng';
                        }
                    }
                }
            }
        }
        return view('FrontEnd.register',['data'=>$data]);
    }
    public function logout() {
        session()->flush(); // hủy hết session
        // chuyển trang Home
        return redirect()->route('ViewHome');
    }
}