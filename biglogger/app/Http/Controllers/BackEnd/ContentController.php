<?php
namespace App\Http\Controllers\BackEnd;
use App\Content;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContentController extends Controller{
    public function Index(Request $request){
        $data = ['msg'=>[]];

        $data['title'] = 'Content List';

        if (empty(session()->get('auth')))
            return redirect()->route('ViewHome');

        $objContent = new Content();

//        echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')';
//            var_dump($request->all());
//        echo '</pre>';
//        die();
        if ($request->has('option-search'))
            switch ($request->get('option-search')){
                case 1:
                    session(['selected' => '1']);
                    $data['msg'][]= 'chọn option';
                    break;
                case 2:
                    $objContent->option_search = 'logtype';
                    session(['selected' => '2']);
                    $data['search'] = $request->get('search');
                    $data['option-search'] = $request->get('option-search');
                    break;
                case 3:
                    $objContent->option_search = 'content';
                    session(['selected' => '3']);
                    $data['search'] = $request->get('search');
                    $data['option-search'] = $request->get('option-search');
                    break;
                case 4:
                    $objContent->option_search = 'iplog';
                    session(['selected' => '4']);
                    $data['search'] = $request->get('search');
                    $data['option-search'] = $request->get('option-search');
                    break;
                case 5:
                    $objContent->option_search = 'tag';
                    session(['selected' => '5']);
                    $data['search'] = $request->get('search');
                    $data['option-search'] = $request->get('option-search');
                    break;
                default:
                    $data['msg'][]= 'giá trị value thẻ option không đúng';
                    $objContent->option_search = '';
            }
        if ($request->has('search'))
            $objContent->search = $request->get('search');
        session(['search'=>$request->get('search')]);
        $data['search']=$request->get('search');

        $objContent->pagination = (int)env('APP_pagination');


        if (!empty($request->get('pg_st')))
            $objContent->paging_state_token = hex2bin($request->get('pg_st'));

//        $data['pg_st'] = bin2hex($result->pagingStateToken());
        $objContent->id_user = session()->get('auth')->id_user;
//        echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')';
//        var_dump($request->all());
//        echo '</pre>';
//        die();
        $data['list'] = $objContent->getList(session()->get('auth')->id_user);
        $data['count_res'] = $objContent->count(session()->get('auth')->id_user);
        foreach($data['count_res'] as $k){
        $data['count']=$k['count']->value();
        }

        return view('BackEnd.Content.index',['data'=>$data]);
    }
}