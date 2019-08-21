<?php
namespace App;
use App\ConnectCql;

class Log
{
    public $res;
    public $tag;
    public $tb_name = "log";
    public $pagination;
    public $paging_state_token;
    public $search;
    public function __construct()
    {
        $this->res = new ConnectCql();
    }
    public function getList(){
        $this->res->pagination = $this->pagination;
        $this->res->paging_state_token = $this->paging_state_token;
        $cql = 'SELECT * FROM '.$this->tb_name;
        if (!empty($this->search))
            $cql .= ' where tag like \'%'.$this->search.'%\'';
        $cql .= ' ALLOW FILTERING';

        $data = $this->res->QueryCQL($cql);

        return $data;
    }
    public function saveNew(){
        $cql = "INSERT INTO $this->tb_name(id_app,tag)
          VALUES (uuid(),'$this->tag')";

        $res = $this->res->QueryCQL($cql);
        if($res)
            //insert thành công thì $res = true
            return $res;
        else
            return false;
    }
    public  function delete(){
        $abc = $this->getList();
        $data = [];
        foreach ($abc as $key){
            $data[] = $key['id_app'];
        }
        foreach ($data as $key){
            $cql = "DELETE  FROM log where id_app = $key";
            $res = $this->res->QueryCQL($cql);
        }

    }
}
