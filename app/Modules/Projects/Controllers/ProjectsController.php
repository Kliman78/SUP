<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(Request $request)
    {
        return view('projects::index');
    }
}
