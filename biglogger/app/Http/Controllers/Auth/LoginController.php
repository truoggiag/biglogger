<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //==============================================


    public function showLogin() {

        echo "<br>User INFO: ";
        echo '<pre>' . __FILE__ . '::' . __METHOD__ . '(' . __LINE__ . ')';
        print_r(Auth::user());
        echo '</pre>';

        // show the form
        return view('FrontEnd.login',['data'=>['title'=>'av']]);
    }

    public function doLogin(Request $request) {
// validate the info, create rules for the inputs
        $rules = array(
            'username' => 'required', // make sure the email is an actual email
            'password' => 'required', // password can only be alphanumeric and has to be greater than 3 characters
        );

// run the validation rules on the inputs from the form
        $validator = Validator::make($request->all(), $rules);

// if the validator fails, redirect back to the form
        if ($validator->fails()) {
            echo '<pre>' . __FILE__ . '::' . __METHOD__ . '(' . __LINE__ . ')';
            print_r($validator->errors);
            echo '</pre>';
        } else {

            echo Hash::make($request->get('password')) . '<br>';
            // create our user data for the authentication
            $userdata = array(
                'username' => $request->get('username'),
                'password' => $request->get('password'),
            );

            $x = Auth::attempt($userdata);
            // attempt to do the login
            if ($x) {

                // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success (even though echoing in a controller is bad)
                echo 'SUCCESS!';

                echo "<br>User INFO: ";
                echo '<pre>' . __FILE__ . '::' . __METHOD__ . '(' . __LINE__ . ')';
                print_r(Auth::user());
                echo '</pre>';
                return $x;


            } else {
                die('loi');

                // validation not successful, send back to form
                return Redirect::to('login');

            }

        }
    }
}
