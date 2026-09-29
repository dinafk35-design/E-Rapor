<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableCard extends Component
{
    public string $title;
    public string $subtitle;
    public ?string $createRoute;
    public $items;

    public function __construct(
        string $title = '',
        string $subtitle = '',
        ?string $createRoute = null,
        $items = null
    ) {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->createRoute = $createRoute;
        $this->items = $items;
    }

    public function render(): View|Closure|string
    {
        return view('components.table-card');
    }
}
