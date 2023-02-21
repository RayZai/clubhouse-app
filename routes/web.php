<?php

use App\Http\Controllers\MemberController;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function(){
    Route::get('/home', function (Request $request) {
        $ctrl = new MemberController();
        return $ctrl->index($request);
    })->name('index');
    
    Route::get('/add', function (Request $request) {
        $ctrl = new MemberController();
        return $ctrl->create();
    })->name('member.add');

    Route::post('/add', function (Request $request) {
        $ctrl = new MemberController();
        return $ctrl->store($request);
    });
    Route::get('{id}/edit', function (Request $request,$id) {
        $member = Member::find($id);
        $ctrl = new MemberController();
        return $ctrl->edit($member);
    });
    Route::post('{id}/edit', function (Request $request,$id) {
        $member = Member::find($id);
        $ctrl = new MemberController();
        return $ctrl->update($request,$member);
    });
    Route::post('{id}/deactivate', function (Request $request,$id) {
        
        $member = Member::find($id);
        $ctrl = new MemberController();
        return $ctrl->deactivate($member);
    })->name('member.deactivate');
});

Route::post('/login', [App\Http\Controllers\AuthController::class, 'Login']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'Logout'])->name('logout');
Route::get('/login', function () {
    return view('login');
})->name('login');
