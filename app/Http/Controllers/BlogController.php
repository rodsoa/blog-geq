<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;

class BlogController extends Controller
{
    public function index() {
        return view('home');
    }

    public function exibir( $noticia ) {
        $noticia = Noticia::findOrFail( $noticia );
        return view('noticia', compact('noticia'));
    }
}
