<?php
namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use App\Visitor;
use App\App;
use Illuminate\Http\Request;

class VisitorController extends Controller{
    public function Index($id_app,Request $request){
        $data = ['msg'=>[]];

        $data['title'] = 'Visitor List';

        if (empty(session()->get('auth')))
            return redirect()->route('ViewHome');
//        if(!$request->has('id_app'))
//            return redirect()->route('App');

//        echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')';
//            var_dump($request->all());
//        echo '</pre>';
//        die();
        $objApp = new App();
        $encodeIdApp = $objApp->getList(session()->get('auth')->username);

//        tạo mảng IdApp
        $IdApp = [];
        foreach ($encodeIdApp as $key){
            $IdApp[] = $key['dk_id_app']->uuid();
        }
        if (!isset($id_app) && !in_array($id_app,$IdApp))
            return redirect()->route('App');

        $objVisitor = new Visitor();
//        $objVisitor->delete($id_app);
//        die();
        if ($request->has('option-search'))
            switch ($request->get('option-search')){
                case 1:
                    session(['selected' => '1']);
                    $data['msg'][]= 'chọn option';
                    break;
                case 2:
                    $objVisitor->option_search = 'browser';
                    session(['selected' => '2']);
                    $data['option-search'] = $request->get('option-search');
                    break;
                case 3:
                    $objVisitor->option_search = 'he_dieu_hanh';
                    session(['selected' => '3']);
                    $data['option-search'] = $request->get('option-search');
                    break;
                case 4:
                    $objVisitor->option_search = 'ip_khach';
                    session(['selected' => '4']);
                    $data['option-search'] = $request->get('option-search');
                    break;
                case 5:
                    $objVisitor->option_search = 'link_view';
                    session(['selected' => '5']);
                    $data['option-search'] = $request->get('option-search');
                    break;
                case 6:
                    $objVisitor->option_search = 'location';
                    session(['selected' => '6']);
                    $data['option-search'] = $request->get('option-search');
                    break;
                default:
                    $data['msg'][]= 'giá trị value thẻ option không đúng';
                    $objVisitor->option_search = '';
            }
        if ($request->has('search'))
            $objVisitor->search = $request->get('search');
        session(['search'=>$request->get('search')]);
        $data['search']=$request->get('search');

        $data['id_app'] = $id_app;
        $objVisitor->id_app = $id_app;

        $objVisitor->pagination = (int)env('APP_pagination');

        if (!empty($request->get('pg_st')))
            $objVisitor->paging_state_token = hex2bin($request->get('pg_st'));

        $data['list'] = $objVisitor->getList($id_app);
//        echo '<pre>';
//        foreach ($data['list'] as $f){
//            var_dump((array)$f['ngay_gio_vao']->timestamp());
////            echo date('m/d/Y H:i:s',$f['ngay_gio_vao']);
//        }
//        echo '</pre>';
//        die();
        $data['count_res'] = $objVisitor->count($id_app);
        foreach($data['count_res'] as $k){
            $data['count']=$k['count']->value();
        }
        return view('BackEnd.Visitor.index',['data'=>$data]);
    }
    public function VisitorMenu(request $request){
        $objApp = new App();
        $encodeIdApp = $objApp->getList(session()->get('auth')->username);

        //tạo mảng IdApp
        $IdApp = [];
        foreach ($encodeIdApp as $key){
            $IdApp[] = $key['dk_id_app']->uuid();
        }
        if (!$request->has('id_app') && !in_array($request->get('id_app'),$IdApp))
            return redirect()->route('App');
    }
}
