<?php
namespace App;
use App\ConnectCql;

class Visitor
{
    public $res;
    public $tb_name = "visitor";
    public $browser;
    public $he_dieu_hanh;
    public $id_app;
    public $ip_khach;
    public $link_view;
    public $location;
    public $ngay_gio_vao;
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
        $cql = 'SELECT * FROM '.$this->tb_name.' where id_app = \''.$str.'\'';
        if (!empty($this->option_search) && !empty($this->search))
            $cql .=' and '. $this->option_search.' like \'%'.$this->search.'%\'';
        $cql .= ' ALLOW FILTERING';
       // ORDER BY id ASC
        $data = $this->res->QueryCQL($cql);

        return $data;
    }
    public function SaveNew(){
        $cql = "INSERT INTO $this->tb_name(id,browser,he_dieu_hanh,id_app,ip_khach,link_view,location,ngay_gio_vao)
          VALUES (uuid(),'$this->browser','$this->he_dieu_hanh','$this->id_app','$this->ip_khach','$this->link_view','$this->location','$this->ngay_gio_vao')";

        $res = $this->res->QueryCQL($cql);
//        echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')';
//            var_dump($cql);
//        echo '</pre>';
//        die();
        if($res)
            //insert thành công thì $res = true
            return $res;
        else
            return false;
    }
    public  function delete($str){
        $abc = $this->getList($str);
        $data = [];
        foreach ($abc as $key){
            $data[] = $key['id'];
        }
        foreach ($data as $key){
            $cql = "DELETE  FROM visitor where id = $key";
            $res = $this->res->QueryCQL($cql);
        }

    }
    public function count($strAppId){
        $cql = "select count(*) from visitor where id_app = '$strAppId' ALLOW FILTERING";
        $abc = $this->res->QueryCQL($cql);
        return $abc;
    }
}