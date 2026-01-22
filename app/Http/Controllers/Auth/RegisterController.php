<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo()
    {
        // ตรวจสอบว่าผู้ใช้ที่ล็อกอินเป็น Admin หรือไม่
        if (auth()->user()->is_admin == '1') {
            return '/adminHome'; // เปลี่ยนเส้นทางไปหน้า adminHome.blade.php
        }

        return '/home'; // ถ้าไม่ใช่ Admin ให้ไปหน้า Home ทั่วไป
    }

    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // ตรวจสอบว่าอีเมลลงท้ายด้วย @admin.com หรือไม่
        $is_admin = (strpos($data['email'], '@admin.com') !== false) ? '1' : '0';

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_admin' => $is_admin, // กำหนด is_admin ถ้าเป็น admin
        ]);
    }
}
