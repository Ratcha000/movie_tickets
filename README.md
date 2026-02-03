#  ระบบจองตั๋วภาพยนตร์ออนไลน์ (Movie Ticket Booking System)
**Web Application Project — University Project**

##  รายละเอียดโปรเจกต์
โปรเจกต์นี้เป็นส่วนหนึ่งของรายวิชาระดับมหาวิทยาลัย  
มีวัตถุประสงค์เพื่อพัฒนาเว็บแอปพลิเคชันสำหรับ **การจองตั๋วภาพยนตร์ออนไลน์**  
เพื่ออำนวยความสะดวกให้แก่ผู้ใช้ทุกเพศทุกวัย ลดขั้นตอนการจองตั๋ว  
และเพิ่มประสิทธิภาพในการจัดการระบบขายตั๋วภาพยนตร์

ระบบถูกออกแบบให้สามารถใช้งานได้ทั้งผู้ใช้งานทั่วไปและผู้เยี่ยมชม (Guest)  
พร้อมทั้งมีระบบจัดการข้อมูลและรายงานผ่านระบบหลังบ้าน

---

## วัตถุประสงค์ของระบบ
1. เพื่ออำนวยความสะดวกให้กับผู้ใช้ทุกเพศทุกวัยในการจองตั๋วภาพยนตร์ผ่าน Web Application  
   - สามารถเลือกภาพยนตร์ที่ต้องการรับชม  
   - สามารถเลือกตำแหน่งที่นั่งได้ตามต้องการ  

2. เพื่อเพิ่มความสะดวกในการจัดการการจองตั๋วสำหรับผู้เข้าชมภาพยนตร์  

3. เพื่อลดระยะเวลาในการต่อคิวชำระเงิน โดยผู้ใช้สามารถชำระเงินหลังจากทำการจองตั๋วผ่านระบบออนไลน์  

4. เพื่อจัดเก็บข้อมูลพฤติกรรมการเลือกชมภาพยนตร์ของผู้ใช้บริการ  

5. เพื่อลดความจำเป็นในการใช้พนักงานขายตั๋ว และลดค่าใช้จ่ายที่เกี่ยวข้องกับการจัดการสถานที่ขายตั๋ว  

6. เพื่อจัดเก็บข้อมูลลูกค้าและนำข้อมูลไปใช้ในการวิเคราะห์ตลาด  
   เช่น การส่งข่าวสาร กิจกรรมใหม่ หรือโปรโมชั่นพิเศษในอนาคต  

7. เพื่อช่วยให้ระบบหลังบ้านสามารถจัดการและรายงานข้อมูล  
   เช่น ยอดขายตั๋ว การจัดการที่นั่ง และการตรวจสอบสถานะของตั๋วได้อย่างมีประสิทธิภาพ  

---

##  ขอบเขตของระบบ (System Scope)

### 1. การวางแผนและออกแบบ

#### 1.1 กลุ่มเป้าหมาย
- ผู้ชมภาพยนตร์ทั่วไป  
- นักเรียน  
- นักศึกษามหาวิทยาลัยขอนแก่น  
- ครอบครัว  

#### 1.2 ระดับผู้ใช้งาน

##### 1.2.1 ผู้ใช้งานทั่วไป (Registered User)
- หน้ารายละเอียดภาพยนตร์  
- ระบบจองตั๋วและเลือกที่นั่ง  
- ระบบชำระเงินออนไลน์  
- ระบบจัดการบัญชีผู้ใช้ (สมัครสมาชิก / เข้าสู่ระบบ)  

##### 1.2.2 ผู้เยี่ยมชม (Guest)
- ดูรอบฉายที่ว่างในแต่ละโรงภาพยนตร์  
- ดูที่นั่งที่เหลืออยู่ในแต่ละรอบฉาย  
- ดูรายละเอียดของภาพยนตร์  

---

### 2. การพัฒนาเว็บไซต์

#### 2.1 โครงสร้างของเว็บไซต์
- หน้าแรก (แสดงภาพยนตร์ที่กำลังฉาย และภาพยนตร์ที่กำลังจะเข้าฉาย)
- หน้ารายละเอียดภาพยนตร์
- หน้าการเลือกที่นั่งและจองตั๋ว
- หน้าการชำระเงิน
- หน้าโปรไฟล์ผู้ใช้
- หน้าโปรโมชั่น
- ระบบเข้าสู่ระบบ (Login)

---

### 3. การพัฒนาระบบหลังบ้าน

#### 3.1 การออกแบบ UI / UX
- ใช้เทคโนโลยี HTML5, CSS3, JavaScript, PHP, MySQL และ Laravel Framework  
- ออกแบบให้ใช้งานง่าย (User-Friendly)  
- รองรับการแสดงผลบนอุปกรณ์ที่หลากหลาย (Responsive Design)

#### 3.2 การจัดการข้อมูล
- ฐานข้อมูลสำหรับจัดเก็บข้อมูลภาพยนตร์  
- ข้อมูลผู้ใช้งาน  
- ข้อมูลการจองตั๋ว  
- ข้อมูลการชำระเงิน  

---

### 4. การทดสอบและปรับปรุงระบบ

#### 4.1 การทดสอบระบบ
- ทดสอบฟังก์ชันการทำงานของแต่ละส่วน เช่น การจองตั๋ว และการชำระเงิน  
- ทดสอบการใช้งานบนอุปกรณ์และเว็บเบราว์เซอร์ที่แตกต่างกัน  

---

##  ความสามารถของเว็บแอปพลิเคชันที่ทำงานร่วมกับฐานข้อมูล

###  ผู้ใช้งานทั่วไป
- สมัครสมาชิกและเข้าสู่ระบบ พร้อมจัดเก็บข้อมูลผู้ใช้  
- ชำระเงินออนไลน์ และจัดเก็บข้อมูลการชำระเงิน  

###  ผู้เยี่ยมชม (Guest)
- เข้าถึงข้อมูลภาพยนตร์และรอบฉาย  
- ดูรายละเอียดภาพยนตร์ เช่น เรื่องย่อ และนักแสดง  

---

##  เทคโนโลยีที่ใช้
- PHP
- Laravel Framework
- MySQL
- HTML / CSS / JavaScript
- Git & GitHub

---


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
