<?php
namespace App\Http\Controllers\BackEnd;
use App\Content;
use App\Log;
use App\Visitor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CheckInfo;
use App\FunctionGet;
use App\App;
use App\User;
class ApiController extends Controller{
    public function Log(Request $request){
        if ($request->has('id_app') && $request->has('key')){
        $objCheck = new CheckInfo();
        $objApp = new App();
        $getWebsite = $objApp->loadOneWebsite($request->get('id_app'));
        $checkIdApi = $objCheck->checkIdApi($request->get('id_app'));
        $checkId = false;
        foreach ($checkIdApi as $key)
        {
            //echo $key['dk_id_app']->uuid();
            if (in_array($request->get('id_app'),(array)$key['dk_id_app']->uuid())){
                $checkId = true;
                break;
            }
        }
        foreach ($getWebsite as $k){
            $getWebsite = ($k['website']);
        }
        $checkKey = md5($request->get('id_app').$getWebsite) == $request->get('key') ? true : false;
        //$checkWebsite = strpos($_SERVER['HTTP_REFERER'],$getWebsite) > 0 ? true : false;
        if ($checkId && $checkKey){
            $objApi = new Content();
//            $objApi->delete();
//                die();
            $objLog = new Log();
//            $objLog->delete();
//            die();

            $checkTag = $objLog->getList();
            $arrayTag = [];
            foreach ($checkTag as $key ){
//                var_dump($key['tag']);
                $arrayTag[] = $key['tag'];
            }
            if (!in_array($request->get('tag'),$arrayTag)){
                $objLog->tag = !empty($request->get('tag')) ? $request->get('tag') : die();
                $objLog->saveNew();
//                echo "ok";
            }
            $objApi->id_user = $request->get('id_user');
            $request->offsetUnset('id_user');
            $params = $request->all();
            echo '<pre>';
                print_r($params);
            echo '</pre>';

//            $objApi->content = !empty($request->get('content')) ? $request->get('content') : die('content empty');
//            $objApi->id_app = !empty($request->get('id_app')) ? $request->get('id_app') : die('id_app empty');
//            $objApi->iplog = !empty($request->get('iplog')) ? $request->get('iplog') : die('iplog empty');
//            $objApi->logtype = !empty($request->get('logtype')) ? $request->get('logtype') : die('logtype empty');
//            $objApi->tag = !empty($request->get('timelog_client')) ? $request->get('timelog_client') : die('timelog_client empty');

            $objApi->content = $request->get('content');
            $objApi->id_app = $request->get('id_app');
            $objApi->iplog = $request->get('iplog');
            $objApi->logtype = $request->get('logtype');
            $objApi->tag = $request->get('tag');
            $objApi->timelog_client = $request->get('timelog_client');
            $objApi->SaveNew();
//            die();
        }else
            die ("id_app hoặc key không đúng");
        }else
            die ("không tìm thấy id_app hoặc key");
    }
    public function Visitor(Request $request){
        if ($request->has('id_app') && $request->has('key')){
        $objCheck = new CheckInfo();
        $functionGet = new FunctionGet();
        $objApp = new App();
        $getWebsite = $objApp->loadOneWebsite($request->get('id_app'));

        $checkIdApi = $objCheck->checkIdApi($request->get('id_app'));
        $checkId = false;
        foreach ($checkIdApi as $key)
        {
            if (in_array($request->get('id_app'),(array)$key['dk_id_app']->uuid())){
                $checkId = true;
                break;
            }
        }
        foreach ($getWebsite as $k){
            $getWebsite = ($k['website']);
        }
//        echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')';
//            var_dump($getWebsite);
//        echo '</pre>';
//        die();

        $checkKey = md5($request->get('id_app').$getWebsite) == $request->get('key') ? true : false;
        $checkWebsite = strpos($_SERVER['HTTP_REFERER'],$getWebsite) > 0 ? true : false;
        if ($checkId && $checkWebsite && $checkKey){
            $GetSystem = $functionGet->getOS($_SERVER['HTTP_USER_AGENT']);
            $GetBrowser = $functionGet->getBrowser($_SERVER['HTTP_USER_AGENT']);
            $getLocation = $functionGet->getLocation($_SERVER['REMOTE_ADDR']);
            $objApi = new Visitor();
            $objApi->id_app = $request->get('id_app');
            $params = $request->all();
            echo '<pre>';
            print_r($params);
            echo '</pre>';

            $objApi->he_dieu_hanh = $GetSystem;
            $objApi->browser = $GetBrowser['name'] .' '. $GetBrowser['version'];
            $objApi->ip_khach = $_SERVER['REMOTE_ADDR'];
            $objApi->link_view = $_SERVER['HTTP_REFERER'];
            $objApi->location = $getLocation;
            $objApi->ngay_gio_vao = date('Y-m-d H:i:s');
            //$objApi->ngay_gio_vao = date('H:i:s d-m-Y');
            $objApi->SaveNew();
        }else
            die("id_app hoặc key không đúng");
        }else
            die ("không tìm thấy id_app hoặc key");
    }
    public function ExampleLog(){
        $data=['msg'=>[]];
        $data['title'] = 'Example Log Api';
        $objAccount = new User();
        $objAccount->id_user = session()->get('auth')->id_user;
        $data['load_one'] = $objAccount->loadOne();
        return view('BackEnd.Api.examplelog',['data'=>$data]);
    }
    public function ExampleVisitor(){
        $data=['msg'=>[]];

        $data['title'] = 'Example Visitor Api';
        return view('BackEnd.Api.examplevisitor',['data'=>$data]);
    }
}