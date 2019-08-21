<?php
namespace App\Http\Controllers\BackEnd;
use App\CheckInfo;
use App\Http\Controllers\Controller;
use App\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\ConnectCql;
class AppController extends Controller{
    public function Index(Request $request){
        //msg : thông báo lỗi
        $data = ['msg'=>[]];

        // tiêu đề
        $data['title'] = 'App List';

        //kiểm tra chưa đăng nhập thì chuyển trang home
        if (empty(session()->get('auth')))
            return redirect()->route('ViewHome');

        //xử lý option search
        $result = new App();
        //nếu có option-search và search trong $request thì...
        if ($request->has('option-search') && $request->has('search')){
            //gán giá trị search vào $result->search
            $result->search = $request->get('search');
            //gán giá trị option-search vào $result->option_search
            //lưu số thứ tự vào session và mảng data để hiển thị ra form
            // option-search = 1 là chưa chọn gì cả
            switch ($request->get('option-search')){
                case 1:
                    session(['selected' => '1']);
                    $data['msg'][]= 'chọn option';
                    break;
                case 2:
                    $result->option_search = 'ten_app';
                    session(['selected' => '2']);
                    $data['search'] = $request->get('search');
                    $data['option-search'] = $request->get('option-search');
                    break;
                case 3:
                    $result->option_search = 'website';
                    session(['selected' => '3']);
                    $data['search'] = $request->get('search');
                    $data['option-search'] = $request->get('option-search');
                    break;
                default:
                    $data['msg'][]= 'giá trị value thẻ option không đúng';
                    $result->option_search = '';
            }
        }

        //lưu search vào session và $data['search'] để in ra form
        session(['search'=>$request->get('search')]);
        $data['search']=$request->get('search');

        //số lượng bản ghi hiển thị trong 1 trang
        $result->pagination = (int)env('APP_pagination');

        //không mã hóa là trình duyệt không hiểu -.-
        if (!empty($request->get('pg_st')))
            $result->paging_state_token = hex2bin($request->get('pg_st'));

        //gọi phương thức getList
        $data['res'] = $result->getList(session()->get('auth')->username);

        foreach ($data['res'] as $key){
            $data['list'][] = $key;
        }
        if (!empty($data['list']))
        for($i=0;$i<count($data['list']);$i++){
            $data['list'][$i]['dk_id_app'] = $data['list'][$i]['dk_id_app']->uuid();
            $data['list'][$i]['key'] = md5($data['list'][$i]['dk_id_app'].$data['list'][$i]['website']);
        }

//        echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')';
//            var_dump($data['list']);
//        echo '</pre>';
//        die();
        return view('BackEnd.App.index',['data'=>$data]);
    }
    public function Create(Request $request){
        //msg : thông báo lỗi
        $data = ['msg'=>[]];

        // tiêu đề
        $data['title'] ="Create New App";

        //kiểm tra chưa đăng nhập thì chuyển trang home
        if (empty(session()->get('auth')))
            return redirect()->route('ViewHome');

        //kiểm tra nếu là phương thức post và có create trong request
        if($request->isMethod('post') && $request->has('create')) {
            //sử dụng Validator của laravel để xủ lý dữ liệu gửi lên
            $rules = array(
                'ten_app'    => 'required|min:3',//ten_app bắt buộc phải nhập và ít nhất 3 ky tự
                'website' => 'required|min:3',//website bắt buộc phải nhập và ít nhất 3 ky tự
                'password_confirm'    => 'required|min:6|max:20'//password_confirm bắt buộc phải nhập và ít nhất 6 ky tự, nhiều nhất 20 ký tự
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                foreach($validator->errors()->getMessages() as $k)
                    foreach ($k as $e)
                        $data['msg'][] = $e;
            }else{
                $objCheckInfo = new CheckInfo();
                $objCheckInfo->strUsername=session()->get('auth')->username;
                $objCheckInfo->getPassCheck($request->get('password_confirm'));
                $encodePassword = $objCheckInfo->encodePassword();
                $checkPassword = $objCheckInfo->checkPassword($encodePassword);
                $checkNameApp = $objCheckInfo->checkNameApp($request->get('ten_app'),session()->get('auth')->username);
                $checkWebsite = $objCheckInfo->checkWebsite($request->get('website'),session()->get('auth')->username);
                if ($checkPassword)
                    $data['msg'][] = 'password không đúng';
                elseif (!$checkNameApp)
                    $data['msg'][] = 'Tên app đã tồn tại';
                elseif (!$checkWebsite)
                    $data['msg'][] = 'Website đã tồn tại';
                else{
                    $objCreateApp = new App();
                    $objCreateApp->id_user = session()->get('auth')->id_user;
                    $objCreateApp->username = $request->get('username');
                    $objCreateApp->ten_app = $request->get('ten_app');
                    $objCreateApp->website = $request->get('website');
                    $res = $objCreateApp->SaveNew();
                    if ($res) {
                        return redirect()->route('App');
                    } else
                        $data['msg'][] = 'Thêm app không thành công';
                }
            }
        }
        return view('BackEnd.App.create',['data'=>$data]);
    }
    public function Edit($id_app,request $request){
        //msg : thông báo lỗi
        $data = ['msg'=>[]];

        // tiêu đề
        $data['title'] ="Edit App";

        if (empty(session()->get('auth')))
            return redirect()->route('ViewHome');

        $objCheck = new CheckInfo();
        $checkIdApi = $objCheck->checkIdApi($id_app);
        $checkId = false;
        foreach ($checkIdApi as $key)
        {
            //echo $key['dk_id_app']->uuid();
            if (in_array($id_app,(array)$key['dk_id_app']->uuid())){
                $checkId = true;
                break;
            }
        }
        if (!isset($id_app)) die('không tìm thấy Id App');
        if (!$checkId) die('Id App không đúng');

        $objEditApp = new App();
        $data['app-edit'] = $objEditApp->loadOne($id_app);
        foreach ($data['app-edit'] as $k){
            $app_edit = $k;
        }
        $app_edit['dk_id_app'] = $app_edit['dk_id_app']->uuid();
        $data['app-edit'] = $app_edit;
//        echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')';
//            var_dump($app_edit);
//        echo '</pre>';
//        die();

        if($request->isMethod('post') && $request->has('edit')) {
            //sử dụng Validator của laravel để xủ lý dữ liệu gửi lên
            $rules = array(
                'ten_app'    => 'required|min:3',//ten_app bắt buộc phải nhập và ít nhất 3 ky tự
                'website' => 'required|min:3',//website bắt buộc phải nhập và ít nhất 3 ky tự
                'password_confirm'    => 'required|min:6|max:20'//password_confirm bắt buộc phải nhập và ít nhất 6 ky tự, nhiều nhất 20 ký tự
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                foreach($validator->errors()->getMessages() as $k)
                    foreach ($k as $e)
                        $data['msg'][] = $e;
            }else{
                $objCheckInfo = new CheckInfo();
                $objCheckInfo->strUsername=session()->get('auth')->username;
                $objCheckInfo->getPassCheck($request->get('password_confirm'));
                $encodePassword = $objCheckInfo->encodePassword();
                $checkPassword = $objCheckInfo->checkPassword($encodePassword);
                $checkNameApp = $objCheckInfo->checkNameApp($request->get('ten_app'),session()->get('auth')->username);
                $checkWebsite = $objCheckInfo->checkWebsite($request->get('website'),session()->get('auth')->username);
                if ($checkPassword)
                    $data['msg'][] = 'password không đúng';
                elseif (!$checkNameApp)
                    $data['msg'][] = 'Tên app đã tồn tại';
                elseif (!$checkWebsite)
                    $data['msg'][] = 'Website đã tồn tại';
                else{

                    $objEditApp->id_user = session()->get('auth')->id_user;
                    $objEditApp->ten_app = $request->get('ten_app');
                    $objEditApp->website = $request->get('website');
                    $res = $objEditApp->Update($id_app);
                    if ($res) {
                        return redirect()->route('App');
                    } else
                        $data['msg'][] = 'Thêm app không thành công';
                }
            }
        }
        return view('BackEnd.App.edit',['data'=>$data]);
    }
    public function Delete($id_app){
        $objCheck = new CheckInfo();
        $checkIdApi = $objCheck->checkIdApi($id_app);
        $checkId = false;
        foreach ($checkIdApi as $key)
        {
            //echo $key['dk_id_app']->uuid();
            if (in_array($id_app,(array)$key['dk_id_app']->uuid())){
                $checkId = true;
                break;
            }
        }
        if (!isset($id_app)) die('không tìm thấy Id App');
        if (!$checkId) die('Id App không đúng');
        $objApp = new App();
        $objApp->deleteApp($id_app);
        return redirect()->route('App');
    }
}