<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StrukController extends Controller
{
    public function preview()
    {
        return view('user.struk'); // pastikan file struk.blade.php ada di resources/views/
    }
}

