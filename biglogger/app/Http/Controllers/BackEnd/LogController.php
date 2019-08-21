<?php
namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use App\Log;
use Illuminate\Http\Request;

class LogController extends Controller{
    public function Index(Request $request){
        $data = ['msg'=>[]];

        $data['title'] = 'Log List';

        if (empty(session()->get('auth')))
            return redirect()->route('ViewHome');

        $objLog = new Log();

        if ($request->has('search'))
            $objLog->search = $request->get('search');
        session(['search'=>$request->get('search')]);
        $data['search']=$request->get('search');

        $objLog->pagination = (int)env('APP_pagination');

        if (!empty($request->get('pg_st')))
            $objLog->paging_state_token = hex2bin($request->get('pg_st'));

        $data['list'] = $objLog->getList();
        return view('BackEnd.Log.index',['data'=>$data]);
    }
}