<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth:sanctum', 'verified', 'admin']], function() {
    Route::get('/', function() {
        return redirect()->route('location.index');
    });

    Route::get('/location', function() {
        return view('location.index');
    })->name('location.index');

    Route::get('/location/create', function() {
        return view('location.form', ['title' => 'Tambah Lokasi']);
    })->name('location.create');

    Route::get('/location/{id}/edit', function($id) {
        return view('location.form', ['title' => 'Ubah Lokasi', 'editId' => $id]);
    })->name('location.edit');

    Route::get('/user', function() {
        return view('user');
    })->name('user');
});