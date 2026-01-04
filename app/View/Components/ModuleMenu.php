<?php namespace App\View\Components; 
use Illuminate\View\Component; 
use App\Services\ModuleMenu as ModuleMenuService;

class ModuleMenu extends Component
{
    public array $items;

    public function __construct()
    {
        $this->items = ModuleMenuService::all();
    }

    public function render()
    {
        return view('components.module-menu');
    }
}
