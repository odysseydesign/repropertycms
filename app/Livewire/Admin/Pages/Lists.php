<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithPagination;

class Lists extends Component
{
    use WithPagination;

    public function render()
    {
        $pages = Page::paginate(10);

        return view('livewire.admin.pages.lists', compact('pages'));
    }
}
