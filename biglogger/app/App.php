<?php
namespace App;
use App\ConnectCql;
class App
{
    public $id_user;
    public $username;
    public $ten_app;
    public $website;
    public $res;
    public $tb_name = "app";
    public $pagination;
    public $paging_state_token;
    public $option_search;
    public $search;
    public function __construct()
    {
        $this->res = new ConnectCql();
    }

    public function getList($str){
        $this->res->pagination = $this->pagination;
        $this->res->paging_state_token = $this->paging_state_token;
        $cql = 'SELECT * FROM '.$this->tb_name.' where ';
        if (!empty($this->option_search) && !empty($this->search))
            $cql .= $this->option_search.' like \'%'.$this->search.'%\' and ';
        $cql .= 'username = \''.$str.'\' ALLOW FILTERING';

        $data = $this->res->QueryCQL($cql);

        return $data;
    }
    //
    public function SaveNew(){

        $cql = "INSERT INTO $this->tb_name(dk_id_app,ten_app,username,website)
          VALUES (uuid(),'$this->ten_app','$this->username','$this->website')";

        $res = $this->res->QueryCQL($cql);

        if($res)
            return true;
        else
            return false;
    }
    public  function loadOneWebsite($str){
        $cql = "select website from $this->tb_name where dk_id_app = ".$str;

        $data = $this->res->QueryCQL($cql);

        return $data;
    }
    public function loadOne($str){
        $cql = "select * from $this->tb_name where dk_id_app = ".$str;

        $data = $this->res->QueryCQL($cql);

        return $data;
    }
    public function Update($str){
        $cql = "UPDATE app set ten_app = '$this->ten_app', website = '$this->website' WHERE dk_id_app = ".$str;

        $data = $this->res->QueryCQL($cql);

        return $data;
    }
    public function deleteApp($str){
        $cql = "delete from $this->tb_name where dk_id_app = ".$str;

        $data = $this->res->QueryCQL($cql);

        return $data;
    }
//    public function getUser($str){
//        $cql = 'select username from '.$this->tb_name .' where dk_id_app =\''.$str.'\'';
//
//        $res = $this->res->QueryCQL($cql);
//
//        return $res;
//    }
}