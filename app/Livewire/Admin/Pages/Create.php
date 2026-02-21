<?php

namespace App\Livewire\Admin\Pages;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use App\Models\Page;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    //    use HandleBlocks;

    public $title;

	public $slug;

    public $content;

    public $meta_title;

    public $meta_description;

    public $meta_keywords;

    public $pageId;

    public $body = null;

    public function store($body)
    {
        $validatedData = $this->validate([
            'title' => 'required',
            // Add validation rules for other fields as needed
        ]);
        $content = json_decode($body->get('content'), true);

        Page::create([
            'title' => $validatedData['title'],
            'content' => $content,
        ]);

        return redirect()->route('admin.pages.lists')->with('success', 'Page created successfully');
    }

    #[On('save-page')]
    public function savePage($body)
    {
	    $content = json_decode($body['content'], true);
        Page::updateOrCreate([
            'id' => $body->pageId,
        ], [
            'title' => $body->title,
            'content' => $body,
        ]);

        $this->body = $body;
    }

	public function updatedTitle($value)
	{
		$this->slug = Str::slug($value);
	}

    public function render()
    {
        return view('livewire.admin.pages.create');
    }
}
