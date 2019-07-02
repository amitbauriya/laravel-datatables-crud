<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"><br>
<img src="https://img.shields.io/badge/laravel-5.8-orange.svg"> <img src="https://img.shields.io/badge/yajra-9.x-blueviolet.svg"> <img src="https://img.shields.io/badge/license-MIT-blue.svg"> <img src="https://img.shields.io/badge/build-passing-green.svg"></p>

## Laravel Datatables Crud Introduction

<p>This project is created to handle crud operations through Yajra DataTables plugin via AJAX option.<br><br>
Data tables whose behavior and appearance have be extended by components. For example authentication with email verify support, sorting, pagination or search the table. Added Import and Export option provided. </p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

## About Yajra Datatables


DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible tool, based upon the foundations of progressive enhancement, and will add advanced interaction controls to any HTML table.

Official documentation of Yajra DataTables is available at [yajra.com](http://yajrabox.com/docs/laravel-datatables)

### Requirements

------------

- Composer
- PHP >7.0
- Laravel >5.8
- Laravel DataTables v8.x|v9.x

### Documentation

------------

- [Laravel DataTables Documentation](http://yajrabox.com/docs/laravel-datatables)
- Demo of [yajra-datatables](http://datatables.yajrabox.com/) is available for artisan's reference.

### Installation

	Config database and email through .env in root directory
	composer install
    php artisan migrate
    php artisan serve  or php -S localhost:8000 -t public/
	Run http://localhost:8000 in web browser

### Screenshot
[![Screenshot](https://github.com/amitbauriya/laravel-datatables-crud/blob/master/screenshot.png?raw=true "Screenshot")](https://github.com/amitbauriya/laravel-datatables-crud/blob/master/screenshot.png?raw=true "Screenshot")

### Security Vulnerabilities

------------



If you discover a security vulnerability within Laravel, please send an e-mail to Amit Bauriya via [amit001bauriya@gmail.com](mailto:amit001bauriya@gmail.com). All security vulnerabilities will be promptly addressed.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
