@if (auth()->user())
    {{-- Check for authenticated user --}}
    <span wire:poll.5000ms="updateNotificationCount"
          class="absolute top-5 right-5 grid min-h-[24px] min-w-[24px] translate-x-2/4 -translate-y-2/4 place-items-center rounded-full bg-red-600 text-xs px-1 text-white"
          x-show="$wire.notificationCount > 0">
                         {{ $notificationCount }} {{-- Use a property for the count --}}

                    </span>
@endif