<div class="w-full py-5">
    <div class="pb-5">
        <div class="d-flex align-items-center justify-content-between flex-wrap page-heading">
            <h3 class="mb-0">Notifications</h3>
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
        @if (!$notifications->isEmpty())
            <button wire:click="markAllAsRead" class="button btn-blue m-0">
                <i class="fa fa-check mr-1"></i> Mark All as Read
            </button>
        @endif
    </div>

    <div class="table-responsive">
        <table class="table w-full table-striped table-auto mb-5">
            @if ($notifications->isEmpty())
                <tr>
                    <td>No notifications found.</td>
                </tr>
            @else
                @foreach ($notifications as $notification)
                    <tr class="{{ ! $notification->read_at ? 'unread' : '' }}"
                        style="{{ ! $notification->read_at ? 'background-color:#f0f0f5;' : '' }}">
                        <td>
                            {{ $notification->data['message'] ?? 'No message available.' }}
                        </td>
                        <td>
                            <small> ({{ $notification->created_at->diffForHumans() }}) </small>
                        </td>
                        <td>
                            <button wire:click="markAsRead('{{ $notification->id }}')">Mark as Read</button>
                        </td>
                    </tr>

                @endforeach
                {{ $notifications->links() }}
            @endif
        </table>
    </div>
</div>

</div>