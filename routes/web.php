<?php

use App\Models\User;
use App\Models\resultModel;
use App\Models\studentModel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RelationshipController;
use Illuminate\Database\Eloquent\Factories\Factory;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('index',[RelationshipController::class,'index'])->name('index');
// Route::post('store_branch',[RelationshipController::class,'store_branch'])->name('store_branch');

Route :: get('index',function(){
    $users = User::all();
    return view('test.index',compact('users'));
    // User::Factory()->count(5)->create();
    // resultModel::create([
    //     'user_id'=>1,
    //     'country_name'=>'india'
    // ]);
    // resultModel::create([
    //     'user_id'=>2,
    //     'country_name'=>'Nepal'
    // ]);
    // resultModel::create([
    //     'user_id'=>3,
    //     'country_name'=>'USA'
    // ]);
    // resultModel::create([
    //     'user_id'=>4,
    //     'country_name'=>'China'
    // ]);
    // resultModel::create([
    //     'user_id'=>5,
    //     'country_name'=>'Japan'
    // ]);
    // resultModel::create([
    //     'user_id'=>6,
    //     'country_name'=>'Maldives'
    // ]);
    // resultModel::create([
    //     'user_id'=>7,
    //     'country_name'=>'Sri Lanka'
    // ]);
    // resultModel::create([
    //     'user_id'=>8,
    //     'country_name'=>'Singapor'
    // ]);
    // resultModel::create([
    //     'user_id'=>9,
    //     'country_name'=>'Russia'
    // ]);
    // resultModel::create([
    //     'user_id'=>10,
    //     'country_name'=>'India'
    // ]);

});

