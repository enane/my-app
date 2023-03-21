<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


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

Route::get('/', function () {
    return inertia('Home');
});

Route::get('/users', function (Request $request) {
    $search = $request->search;
    return inertia('Users', [
        'users' => User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->paginate(10)
            ->through(fn($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ])
//        'users' => User::query()
//            ->paginate(10)
//            ->through(fn($user) => [
//                'id' => $user->id,
//                'name' => $user->name,
//                'email' => $user->email
//            ])
    ]);
});

Route::get('/settings', function () {
    return inertia('Settings', [
    ]);
});

Route::post('/logout', function () {
    dd('logging outtt');
});
