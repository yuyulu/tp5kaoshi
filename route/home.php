<?php
//GET
Route::get('/', 'home/Index/index');
Route::get('welcome', 'home/Index/welcome');
Route::get('login', 'home/User/login');
Route::get('verify', 'home/User/verify');
Route::get('create', 'home/User/create');
Route::get('save', 'home/User/save');
Route::get('read/:id', 'home/User/read');
//POST
Route::post('create', 'home/User/create');
Route::post('login', 'home/User/login');
?>