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

    // Get rows related to call / don't call
    $call_me_rows = DB::table('sweetwater_test')->where('comments', 'like', '%call me%')->get();

    // Get rows related to who referred me
    $referred_rows = DB::table('sweetwater_test')->where('comments', 'regexp', 'referred|referral')->get();

    // Get rows related to signatures
    $signature_rows = DB::table('sweetwater_test')->where('comments', 'like', '%signature%')->get();

    // Get rows related to candy
    $candy_filters = ['candy', 'smarties', 'honey', 'cinnanom'];
    $candy_rows = DB::table('sweetwater_test')->where('comments', 'regexp', implode('|', $candy_filters))->get();

    // Get all other rows
    $misc_rows = DB::table('sweetwater_test')->whereRaw('comments not like "%call me%" and comments not regexp "referred|referral" and comments not like "%signature%" and comments not regexp "'.implode('|', $candy_filters).'"')->get();

    return view('comments_report')->with('call_me_rows', $call_me_rows)->with('referred_rows', $referred_rows)->with('signature_rows', $signature_rows)->with('candy_rows', $candy_rows)->with('misc_rows', $misc_rows);
});
