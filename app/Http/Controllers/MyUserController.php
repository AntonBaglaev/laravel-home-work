<?php

namespace App\Http\Controllers;

use App\Models\MyUser;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class MyUserController extends Controller
{
    public function index(): View|Factory|Application
    {
        return view('users', ['users' => MyUser::all()]);
    }

    public function showForm(): View|Factory|Application
    {
        return view('user_form');
    }

    public function get(Request $request, $id): View|Factory|Application
    {
        $user = MyUser::where('id', $id)->first();

        return view('users', ['users' => [$user]]);
    }

    public function store(Request $request): void
    {
        $result = $request->validate([
            'name' => ['required', 'string', 'max:50', 'min:1'],
            'surname' => ['required', 'string', 'max:50', 'min:1'],
            'email' => ['required', 'regex:/^.+@.+$/i'],
        ]);

        $user = MyUser::create(...$result);

        echo "Создан новый пользователь: {$user->id}.{$user->name} {$user->surname} ({$user->email})";
    }

    public function resume(Request $request, $id): Application|Redirector|RedirectResponse
    {
        return redirect("pdf/$id");
    }
}
