<?php

namespace App\Modules\Contracts\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Contracts\Models\Contracts;
use Illuminate\Http\Request;

class ContractsController extends Controller
{
    public function index()
    {
    $moduleConfig = require base_path('app/Modules/Contracts/module.php');

    $actions = $moduleConfig['actions'] ?? [];

    $contracts = Contracts::all();

    return view('contracts::index', compact('contracts', 'actions'));
    }

    public function create()
    {
        return view('contracts::create');
    }

    public function store(Request $request)
    {
        // TODO: validation and store logic
        return redirect()->route('contracts.index');
    }

    public function edit($id)
    {
        return view('contracts::edit');
    }

    public function update(Request $request, $id)
    {
        // TODO: validation and update logic
        return redirect()->route('contracts.index');
    }

    public function destroy($id)
    {
        // TODO: delete logic
        return redirect()->route('contracts.index');
    }
}
