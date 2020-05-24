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

Route::get('/', function () {
	// $url = route('view2');
	// dd($url);
	return view('welcome4');
});

Route::post('/form' , function() {
	dd('ok blade 3');
})->name('form_post');

Route::get('/blade2'  , function(){
	return view('welcome2');
})->name('view2');

Route::get('/abc', function(){
	return view('welcome3');
})->name('view3');

Route::post('/update', function(){  //dd = die dump (dung de fix bug), post ko return view
	dd('ok');
});

Route::get('post/{user_id}', function ($id){
	return "User la :" . $id;
});

Route::get('user/{id}/post/{post_id}/{view_count}', function($id,$postID,$view_count){ //truyen tham so
	// return "This is post:  " .  $postID ." of user :" . $id . " view count :" . $view_count;
	return "This is post $postID of user $id has view count = $view_count"; 
})->name('user.post');

Route::get('user/{id?}', function($id = null) { 
// ?: dung de dinh nghia tham so do co the ton tai hoac ko nen de tham so chua ? o cuoi url
	// $url = route('user.post');
	// dd($url);
	$url2 = route('user.post',[
		'id'=> 1, 
		'post_id' => 4

	]);
	dd($url2);
	if ($id == null) {
		return 'List users';
	}

	return "User $id";
});

// NHOM ROUTE
Route::prefix('admin')->group(function () { // B1: NHÓM TẤT CẢ ROUTE CÓ TIỀN TỐ ADMIN THÀNH 1 GROUP

	Route::prefix('users')->group(function(){ // B2: NHÓM TẤT CẢ TIỀN TỐ USERS THÀNH 1 NHÓM
		Route::get('/', function () {
			dd('user index');

		})->name('admin.user.index');

		Route::get('create', function () {
			dd('user create');

		});

		Route::get('update', function () {
			dd('a');

		});




	});
//-------------------------------------

	Route::get('posts', function () { //B3 NHÓM TẤT CẢ TIỀN TỐ POSTS THÀNH 1 NHÓM
		dd('day la post');

	});

	Route::get('posts/create', function () {
		dd('day la post create');

	});
//-------------------
	Route::get('categories', function () { // B4: NHÓM TẤT CẢ TIỀN TỐ CATEGORIES THÀNH 1 NHÓM
		dd('day la categories');

	});

});

//----------------------------------------------------------------------------------------------------------------
//HOMEWORK

// Route::get('task/complete/3', function() {
// 	dd('Đây là tính năng hoàn thành');
// })->name('todo.task.complete');

// Route::get('task/reset/3' , function(){
// 	dd('Day la tinh nang lam lai');
// })->name('todo.task.reset');


Route::prefix('task') ->group(function() {

	Route::get('complete/3', function(){
		dd('Cong viec da hoan thanh !!');
	})->name('todo.task.complete');

	Route::get('reset/3', function(){
		dd('Da xoa cong viec !!!');
	})->name('todo.task.reset');
	
});