<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserService
{
    public function index(Request $request)
    {
        $search = $request->search;
        return Inertia::render('Users/Index', [
            'users' => User::query()
                ->when($search, function ($query, $search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email
                ]),
            'filters' => $search
        ]);
    }

    public function store(Request $request)
    {
        $attrs = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        User::create($request->all());

//        return Inertia::location('/users');
//        return to_route('users.index');
        return redirect('/users');
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

//        return Inertia::location('/users');
//        return to_route('users.index');
        return redirect('/users');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users');
    }
}
