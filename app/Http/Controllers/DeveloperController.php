<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    /**
     * Menampilkan halaman profil developer
     */
    public function show()
    {
        return view('pages.developer.show');
    }
}
