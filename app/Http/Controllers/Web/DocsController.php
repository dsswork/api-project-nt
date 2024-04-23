<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class DocsController extends Controller
{
    public function index(): View
    {
        return view('web.docs');
    }
}
