<?php

use App\Events\OrderStatusUpdated;
use App\Models\Task;
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

class order{
    public $id;

    public function __construct($id){
        $this->id = $id;
    }
}

Route::get('/', function () {
    // event(new Order);
    return view('welcome');
});

// Route::get('/update', function(){
//     OrderStatusUpdated::dispatch(new Order(3));
// });

Route::get('/tasks', function(){
    return Task::latest()->pluck('body');
});

Route::post('/tasks', function(){
    Task::forceCreate(request(['body']));
});