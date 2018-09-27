<?php
Route::get('/', function () {
    return view('welcome');
});

Route::get('members/create', 'MembersController@create')->name('createMemberForm');
Route::post('members', 'MembersController@store');
