<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Rules\StrongPassword;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

//    function getData(Request $req){
//        $req->validate([
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'password' => ['required',
//                'min:8',
//                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
//                'confirmed'],
//            'password_confirmation' => ['required',
//                'min:8',
//                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
//                'confirmed']
//        ]);
//
//        return $req->input();
//    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return array|\Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required',
                'min:8',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                'confirmed'],
            'password_confirmation' => ['required',
                'min:8',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                'confirmed']
        ])->validate();

        if ($validator->fails()) {
            return response()->json();
        }

//        $this->validator($request->all())->validate();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function register(Request $request)
    {

        $containsLetter  = preg_match('/[a-zA-Z]/',    $request->password);
        $containsDigit   = preg_match('/\d/',          $request->password);
        $containsSpecial = preg_match('/[^a-zA-Z\d]/', $request->password);
        $containsAll = $containsLetter && $containsDigit && $containsSpecial;

        if($request->password!= $containsAll){
            return redirect()->back()->with(session()->flash('alert-danger', 'Password must contain:
            English uppercase characters (A – Z),
            English lowercase characters (a – z),
            Base 10 digits (0 – 9),
            Non-alphanumeric (For example: !, $, #, or %)'));
        }

        if($request->password != $request->password_confirmation){
            return redirect()->back()->with(session()->flash('alert-danger', 'Password does not match!'));
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->verification_code = sha1(time());
        $user->save();

        if($user != null){
            MailController::sendSignupEmail($user->name,$user->email, $user->verification_code);
            return redirect()->back()->with(session()->flash('alert-success', 'Your account has been created. Please check email for verification link.'));
        }

        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong!'));
    }

    public function verifyUser(Request $request){
        $verification_code = \Illuminate\Support\Facades\Request::get('code');
        $user = User::where(['verification_code' => $verification_code])->first();
        if($user != null){
            $user->is_verified = 1;
            $user->save();
            return redirect()->route('login')->with(session()->flash('alert-success', 'Your account is verified. Please login!'));
        }

        return redirect()->route('login')->with(session()->flash('alert-danger', 'Invalid verification code!'));
    }
}
