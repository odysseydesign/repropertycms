@props(['contentPadding' => true, 'onSubmit' => null])
<div class="modal-content-wrapper {{ $attributes->get('class') }}">
    <div class="modal-content">
        <form wire:submit.prevent="{{ $onSubmit }}" class="contact-form">
            <div class="wep-modal-header">
                @if($title ?? false)
                    <h5 class="modal-title">{{ $title }}</h5>
                @endif
                <button type="button" class="me-0 button-close" wire:click="$dispatch('modal.close')"
                        aria-label="Close">x</button>
            </div>
            <div @class(['modal-body' , 'px-0 py-0' => !$contentPadding])>
                {{ $slot }}
            </div>
            @if($buttons ?? false)
                <div class="modal-footer">
                    {{ $buttons }}
                </div>
            @endif
        </form>
    </div>
</div>
