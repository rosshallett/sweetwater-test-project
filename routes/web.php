<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/customer_comments', function() {
    $all_rows = DB::table('sweetwater_test')->get();

    // Get rows related to call / don't call
    $call_me_rows = DB::table('sweetwater_test')->where('comments', 'like', '%call me%')->get();

    // Get rows related to who referred me
    $referred_rows = DB::table('sweetwater_test')->where('comments', 'like', '%referred%')->get();

    // Get rows related to signatures
    $signature_rows = DB::table('sweetwater_test')->where('comments', 'like', '%signature')->get();


    // $candy_filters = ['candy', 'smarties', 'honey', 'cinn'];
    // $candy_comments = DB::table('sweetwater_test')->where('comments', );
    return view('comments_report')->with('call_me_rows', $call_me_rows)->with('referred_rows', $referred_rows)->with('signature_rows', $signature_rows);
});
