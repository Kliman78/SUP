<?php

namespace App\Modules\Clients\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index(Request $request)
    {
        return view('clients::index');
    }
}
