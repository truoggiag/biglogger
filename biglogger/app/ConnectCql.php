<?php
namespace App;
use Cassandra;
class ConnectCql
{
    public $cluster;
    public $session;
    public $pagination;
    public $paging_state_token;
    public function __construct()
    {
        $this->cluster = \Cassandra::cluster()
//            ->withContactPoints(env('CQL_HOST'))
            //->withPort(env('CQL_PORT'))
            ->build();
        $this->session  = $this->cluster->connect(env('CQL_KEYSPACE'));
        return $this->session;
    }
    public function QueryCQL($str){


//        echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')';
//            print_r($str);
//        echo '</pre>';
//        die();


        $options['page_size'] = $this->pagination;
        if (!empty($this->paging_state_token))
            $options['paging_state_token'] = $this->paging_state_token;


        if (!empty($this->pagination) && !empty($this->paging_state_token)){
//            $result = $this->session->execute('select * from app where username = \'a\' allow filtering',$options);
            $result = $this->session->execute($str,$options);
            return $result;
        }
        elseif (!empty($this->pagination)){
            $result = $this->session->execute($str,$options);
            return $result;
        }
        $result = $this->session->execute(new \Cassandra\SimpleStatement($str));


        return $result;
    }
}
