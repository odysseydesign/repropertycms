<div class="w-full py-5">
    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
        <h5 class="mb-0">Pages</h5>
        <a href="{{ route('admin.pages.create') }}"
                class="btn-blue m-0">
            <i class="fa fa-plus mr-1"></i> Create Page
        </a>
    </div>

    <div class="table-responsive w-full">
        <table class="table w-full table-striped table-auto">
            <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 w-20">No.</th>
                <th class="px-4 py-2">Title</th>
                <th class="px-4 py-2">Slug</th>
                <th class="px-4 py-2">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($pages as $page)
                <tr>
                    <td class="border px-4 py-2">{{ $page->id }}</td>
                    <td class="border px-4 py-2">{{ $page->title }}</td>
                    <td class="border px-4 py-2">{{ $page->slug }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $page->id }})"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit
                        </button>
                        <button wire:click="delete({{ $page->id }})"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="border px-4 py-2 text-center" colspan="4">No pages found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ $pages->links() }}
    </div>
</div>