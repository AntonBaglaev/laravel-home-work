<?php

namespace App\Http\Controllers;

use App\Models\MyUser;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PdfGeneratorController extends Controller
{
    public function index(Request $request, $id): Response
    {
        $user = MyUser::where('id', $id)->first();

        $data = [
            'id' => $user['id'],
            'name' => $user['name'],
            'surname' => $user['surname'],
            'email' => $user['email'],
        ];

        $pdf = Pdf::loadView('users', ['users' => [$data]]);
        return $pdf->stream('resume.pdf');
    }
}
