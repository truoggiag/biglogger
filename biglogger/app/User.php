<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
    public $id_user;
    public $username;
    public $password;
    public $firstname;
    public $lastname;
    public $encode;
    public $email;
    public $id_privilege;
    public $row = 'id_user';
    public $sort = 'desc';
    protected $tb_name_1 = 'accounts';
    protected $tb_name_2 = 'privilege';

    //lấy danh sách accounts
    public function getList(){
        $res = DB::table($this->tb_name_1)
            ->join($this->tb_name_2,$this->tb_name_1.'.id_privilege',$this->tb_name_2.'.id_privilege')
            ->orderBy('id_user','desc')
            ->paginate(3);
        unset($res->password);
        return $res;
    }
    public function search($str){
        $res = DB::table($this->tb_name_1)
            ->where('username', 'like', '%'.$str.'%')
            ->orWhere('firstname','like', '%'.$str.'%')
            ->orWhere('lastname','like', '%'.$str.'%')
            ->orWhere('email','like', '%'.$str.'%')
            ->orWhere('name_privilege','like', '%'.$str.'%')
            ->join($this->tb_name_2,$this->tb_name_1.'.id_privilege',$this->tb_name_2.'.id_privilege')
            ->orderBy($this->row,$this->sort)
            ->paginate(env('APP_pagination'));
//        echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')';
//            print_r($res);
//        echo '</pre>';
//        die();
        unset($res->password);
        return $res;
    }
    //thêm tài khoản
    public function SaveNew(){
        $res = DB::table($this->tb_name_1)->insert([
            'username' => $this->username,
            'password'=>$this->password,
            'encode'=>$this->encode,
            'firstname'=>$this->firstname,
            'lastname'=>$this->lastname,
            'email'=>$this->email,
            'id_privilege'=>$this->id_privilege
        ]);
        //insert thành công thì trả về true
        return $res;
    }
    //lấy ra 1 tài khoản
    public function loadOne(){
        $res = DB::table($this->tb_name_1)
            ->where('id_user',$this->id_user)
            ->first();
        unset($res->password);
        if(empty($res))
            return die("ID not found");
        else
            return $res;
    }
    //cập nhập mới 1 thông tin tài khoản
    public function SaveUpdate(){
        $res = DB::table($this->tb_name_1)
            ->where('id_user',$this->id_user)
            ->update([
                'firstname'=>$this->firstname,
                'lastname'=>$this->lastname,
                'email'=>$this->email
            ]);
        //update thành công $res = 1
        //update thất bại $res = 0
        if ($res == 1)
            //trả về true => sửa thành công
            return true;
        else
            return false;
    }
    //đăng nhập
    public function Login(){
        $res = DB::table($this->tb_name_1)
            ->where([
                    'username'=>$this->username,
                    'password'=>$this->password
                ])
            ->first();
        unset($res->password);
        unset($res->encode);
//        echo '<pre>';
//            var_dump($res);
//        echo '</pre>';
//        die();

        if(!empty($res))
            //nếu đúng thì trả về res
            return $res;
    }
    public function count(){
        $res = DB::table($this->tb_name_1)->count();

        return $res;

    }
}
