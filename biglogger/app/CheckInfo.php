<?php
namespace App;
use Illuminate\Support\Facades\DB;
use App\ConnectCql;
class CheckInfo
{
    public $strPassword;
    public $strUsername;
    public $encode;
	public $tb_name="accounts";
	public $tb_name2='app';
    /***
     * mặc định chung kiểm tra đã tồn tại trong CSDL thì trả về true
     * ngược lại nếu chưa tồn tại trong CSDL thì trả về false
     */
	public function getPassCheck($str){
        $data = DB::table($this->tb_name)
            ->select('password')
            ->where('password',$str)
            ->first();
        if (empty($data))
            return false;
        else
            return $this->strPassword = $data->password;
    }

    public function checkNameApp($str,$user){
        $res = new ConnectCql();
        $cql = 'SELECT ten_app FROM '.$this->tb_name2.' where ten_app = \''.$str.'\' and username = \''.$user.'\' ALLOW FILTERING';
        $data = $res->QueryCQL($cql);

        if(empty($data))
            return false;
        else
            return true;
    }

    public function checkWebsite($str,$user){
        $res = new ConnectCql();
        $cql = 'SELECT website FROM '.$this->tb_name2.' where website = \''.$str.'\' and username = \''.$user.'\' ALLOW FILTERING';
        $data = $res->QueryCQL($cql);

        if(empty($data))
            return false;
        else
            return true;
    }

	public function checkUsername($str){
        $data = DB::table($this->tb_name)
            ->select('username')
            ->where('username',$str)
            ->first();
        if(empty($data))
            return false;
        else
            return true;
    }
    public function checkEmail($str){
        $data = DB::table($this->tb_name)
            ->select('email')
            ->where('email',$str)
            ->first();
        if(empty($data))
            return false;
        else
            return true;
    }
    public function checkPassword($str){
        $data = DB::table($this->tb_name)
            ->select('password')
            ->where([
                'password'=>$str,
                'username'=>$this->strUsername
            ])
            ->first();
        if(empty($data))
            return false;
        else
            return true;
    }
    public function checkIdApi($str){
        $res = new ConnectCql();
        $cql = 'SELECT * FROM '.$this->tb_name2.' ALLOW FILTERING';
        $data = $res->QueryCQL($cql);
//        echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')';
//            var_dump($data);
//        echo '</pre>';
//        die();
        return $data;
//        if(empty($data))
//            return false;
//        else
//            return true;
    }
    /***
     * encode password
     * đầu tiên dùng mã hash::make để lấy chuỗi mã hóa ngẫu nhiên từ password nhập vào đồng thời lưu lại trong CSDL
     * rồi thực hiện ghép chuỗi và tiếp tục mã hóa
     *
     */
    public function encodePassword(){
        //khi đã đăng nhập dùng để xác định mật khẩu hoặc nhập lại mật khẩu
        //nếu đã đang nhập thì lấy chuỗi mã hóa trong CSDL ra để kiểm tra mất khẩu khi nhập vào
        if (!empty($this->strUsername) && !empty($this->strPassword)){
            $data = DB::table($this->tb_name)
                ->select('encode')
                ->where('username',$this->strUsername)
                ->first();
            $this->encode = $data->encode;
        }

        $password = md5($this->encode.$this->strPassword.$this->encode);
        $password = sha1($this->encode.$password.$this->encode);
        $password = base64_encode($this->encode.$password.$this->encode);
        return $password;
    }
}