<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index() {
        $this->authorize('view-any', User::class);
        return response()->json(User::all());
    }
}
