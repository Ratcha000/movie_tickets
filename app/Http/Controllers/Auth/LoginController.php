<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//เรียกใช้ Request จาก Laravel Framework เอาไว้ใช้จัดการกับ Http request
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
        $this->middleware('auth')->only('logout');

    }

    //ทำการสร้าง function login เพื่อรับ request เข้ามา
    public function login(Request $request){
        
        //คลาส Request จะใช้เพื่อเข้าถึงข้อมูลจากคำขอที่ส่งมายังแอปพลิเคชัน เช่น ข้อมูลจากฟอร์ม,
        //ข้อมูล query string, ข้อมูล header หรือไฟล์ที่ถูกอัปโหลด เป็นต้น

        //สร้าง $input เพื่อเก็บข้อมูลทั้งหมด จากการเรียกใช้ all() แล้วทำการรับ request 
        $input = $request->all();

        //validate คือกระบวนการตรวจสอบความถูกต้องของข้อมูลที่ผู้ใช้ส่งมาในฟอร์มหรือผ่าน HTTP request
        //เพื่อให้แน่ใจว่าข้อมูลที่ถูกส่งมานั้นตรงตามกฎเกณฑ์ที่เรากำหนดไว้ เช่น ต้องเป็นอีเมลที่ถูกต้อง, ต้องไม่ว่าง, ต้องเป็นตัวเลข เป็นต้น
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        //ทำการเช็คว่า email กับ password ที่ส่งเข้ามามันตรงกับที่เซ็ทไว้ นั่นคือ ถ้าเป็น 1 จะทำการ redirect ไปที่หน้า admin แต่ถ้าเป็น 0 จะทำการ redirect ไปที่หน้า home
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))){
            if(auth()->user()->is_admin == 1 ){
                return redirect()->route('admin.home');
            }else{
                return redirect()->route('home');
            }
        }else{
            //ถ้า email กับ password ไม่ถูกต้องจะทำการ redirect ไปที่หน้า login 
            return redirect()->route('login')->with('error',"Email-address and Password are wrong");
        }
    }
}