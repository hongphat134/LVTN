<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\NhaTuyenDung;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Lunaweb\EmailVerification\Traits\VerifiesEmail;

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

    use RegistersUsers,VerifiesEmail;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
        $this->middleware('guest', ['except' => ['verify', 'showResendVerificationEmailForm', 'resendVerificationEmail']]);
        $this->middleware('auth', ['only' => ['showResendVerificationEmailForm', 'resendVerificationEmail']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:25',
            'email' => 'required|string|email|max:40|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ],
        [
            'name.required' => 'Bạn hãy điền tên đăng nhập!',
            'name.max' => 'Tên đăng nhập chỉ tối đa 25 kí tự!',
            'email.required' => 'Bạn hãy điền địa chỉ Email!',
            'email.max' => 'Email chỉ tối đa 40 kí tự!',
            'email.unique' => 'Email đã có người dùng!',
            'password.min' => 'Mật khẩu phải có tối thiểu 6 kí tự!',
            'password.required' => 'Bạn hãy điền mật khẩu!',
            'password.confirmed' => 'Mật khẩu nhập lại không chính xác!'
        ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {     
        // Tạo Account Nhà tuyển dụng
        if($data['loaitk'] == 1){
            $user = new User;
            $user->ten = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->loaitk = 1;
            $user->remember_token = $data['_token'];

            $user->save();

            $ntd = new NhaTuyenDung;

            $ntd->idUser = $user->id;
            $ntd->ten = $data['name_recruiter'];
            $ntd->diachi = $data['address'];
            $ntd->tinhthanhpho = $data['region'];
            $ntd->quymodansu = $data['scale'];                
            $ntd->remember_token = $data['_token'];

            $ntd->save();  

            return $user;           
        }
        // Tạo Account Người tìm việc
        else{            
            return User::create([
                'ten' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'loaitk' => 0
            ]);
        }
    }
}
