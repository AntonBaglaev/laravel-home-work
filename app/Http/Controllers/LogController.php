<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;


class LogController extends Controller
{
    public function __invoke(): View|Factory|Application
    {
        return view('logs', ['logs' => Log::all()]);
    }
}
