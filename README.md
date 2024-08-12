l<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
# Laravel-zero-dependency-translation-manager
-A Laravel zero dependency translation manager for your new or existing web application app
-This laravel translation manager come up with both command line and user interface with out any third partiy package.
# Usage in command
- First download and put on your existing project
- On your root directory type `php artisan lang:en "fi fi-us"` by specify the new language and and it's [flag icon](https://github.com/lipis/flag-icons)
- The command copy the existing en language to the new language the translation is done through interface
![command](https://github.com/user-attachments/assets/815d275f-c412-4ae0-89a3-1fd5e3186b4b)
# Usage in user Interface
- Login Your project and call the route `your-project-path/admin/translations` example `http://localhost/lara-locale/admin/translations`
- Then you will get the below ui
![index](https://github.com/user-attachments/assets/a68e79da-fb91-4d4b-9754-6660ca353c30)
- If you want add new locale click the **add new language** button then you will see this modal and type the lang name and flag icon value the new language is added and write into `config/panel.php`
![add](https://github.com/user-attachments/assets/faced523-be16-40f0-91c4-0062217b961d)
# Translation
![translation](https://github.com/user-attachments/assets/0453538c-65c6-43bf-bbea-1ebd5dab80da)
# Modifing the key
![edit](https://github.com/user-attachments/assets/b9133bcb-dd12-4f33-8d13-0b1111ca657e)









