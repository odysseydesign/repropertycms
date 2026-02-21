<?php

namespace App\Livewire\Agent\Document;

use App\Models\Properties;
use App\Models\PropertyDocuments;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use WireElements\Pro\Concerns\InteractsWithConfirmationModal;

#[On('refresh')]
#[On('refresh_document')]
class Index extends Component
{
    use InteractsWithConfirmationModal;
    use LivewireAlert;

    public $property;

    public $property_documents;

    public function deleteDocument($id)
    {
        $this->askForConfirmation(
            callback: function () use ($id) {
                $doc = PropertyDocuments::find($id);

                deleteS3Image($doc->file_name);
                $doc->delete();

                $this->dispatch('refresh');
                $this->dispatch('reinitDocDropzone');

                $this->alert('success', 'Document is Deleted !', [
                    'toast' => true,
                ]);
            },
            prompt: [
                'title' => __('Delete Document'),
                'message' => __('Are you sure you want to delete this Document?'),
                'confirm' => __('Yes, Delete'),
                'cancel' => __('Stop'),
            ],
            modalAttributes: [
                'size' => '2xl',
            ]
        );
    }

    public function mount(Properties $property)
    {
        $this->property = $property;
    }

    public function render()
    {
        $this->property_documents = $this->property->property_documents;

        return view('livewire.agent.document.index');
    }
}
