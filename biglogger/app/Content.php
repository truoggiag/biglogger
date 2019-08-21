<?php
namespace App;
use App\ConnectCql;

class Content
{
    public $id_user;
    public $content;
    public $id_app;
    public $iplog;
    public $logtype;
    public $tag;
    public $timelog_client;
    public $timelog_server;
    public $res;
    public $tb_name = "content";
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
        $cql = 'SELECT * FROM '.$this->tb_name.' where';
        if (!empty($this->option_search) && !empty($this->search))
            $cql .= $this->option_search.' like \'%'.$this->search.'%\' and ';
        $cql .= ' id_user = '.$str.' ALLOW FILTERING';
//        $cql .= ' id_user = '.$str.' order by ngay_gio_vao desc  ALLOW FILTERING';


        $data = $this->res->QueryCQL($cql);


        return $data;
    }
    public function SaveNew(){
        $this->timelog_server = date('Y-m-d h:i:s');
        $cql = "INSERT INTO $this->tb_name(id,id_user,content,id_app,iplog,logtype,tag,timelog_client,timelog_server)
          VALUES (uuid(),$this->id_user,'$this->content','$this->id_app','$this->iplog','$this->logtype','$this->tag','$this->timelog_client','$this->timelog_server')";

        $res = $this->res->QueryCQL($cql);
        if($res)
            //insert thành công thì $res = true
            return $res;
        else
            return false;
    }
    public  function delete(){
        $cql = "select * from content";
        $abc = $this->res->QueryCQL($cql);
        $data = [];
        foreach ($abc as $key){
            $data[] = $key['id']->uuid();
        }
        foreach ($data as $key){
            $cql = "DELETE  FROM content where id = $key";
            $res = $this->res->QueryCQL($cql);
        }

    }
    public function count($strUserId){
        $cql = "select count(*) from content where id_user = $strUserId ALLOW FILTERING";
        $abc = $this->res->QueryCQL($cql);
        return $abc;
    }
}