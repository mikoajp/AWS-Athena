<div class="max-w-4xl mx-auto p-4">
    <!-- Show Create Button -->
    @if(!$showCreateForm && !$postId)
        <button wire:click="showCreate" class="mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
            Create Post
        </button>
        <a href="{{ route('posts.pdf') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700">
            Download Posts as PDF
        </a>
    @endif

    <!-- Create Form -->
    @if($showCreateForm)
        <form wire:submit.prevent="create" class="mb-6 bg-gray-50 p-4 rounded-lg border">
            <h2 class="text-lg font-semibold mb-4">Create New Post</h2>
            <div class="mb-4">
                <label for="title" class="block font-medium text-gray-700">Title:</label>
                <input type="text" id="title" wire:model="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="content" class="block font-medium text-gray-700">Content:</label>
                <textarea id="content" wire:model="content" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Save Post
                </button>
                <button type="button" wire:click="hideCreate" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    Cancel
                </button>
            </div>
        </form>
    @endif

    <!-- Edit Form -->
    @if($postId)
        <div class="mb-6 bg-gray-50 p-4 rounded-lg border">
            <h2 class="text-lg font-semibold mb-4">Edit Post</h2>
            <form wire:submit.prevent="update">
                <div class="mb-4">
                    <label for="edit_title" class="block font-medium text-gray-700">Title:</label>
                    <input type="text" id="edit_title" wire:model="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="edit_content" class="block font-medium text-gray-700">Content:</label>
                    <textarea id="edit_content" wire:model="content" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end mt-4 space-x-3">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Save Changes
                    </button>
                    <button type="button" wire:click="cancelEdit" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    @endif

    <hr class="my-4">

    <!-- Posts List -->
    <h2 class="text-xl font-semibold mb-4">Post List</h2>
    <table class="min-w-full table-auto border-collapse border border-gray-200">
        <thead>
        <tr>
            <th class="border border-gray-300 px-4 py-2">Title</th>
            <th class="border border-gray-300 px-4 py-2">Content</th>
            <th class="border border-gray-300 px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $post->title }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $post->content }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    <button wire:click="edit({{ $post->id }})" class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                        Edit
                    </button>
                    <button wire:click="delete({{ $post->id }})" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


@if (session()->has('message'))
        <div class="mt-4 p-4 rounded-lg bg-green-100 text-green-700">
            {{ session('message') }}
        </div>
    @endif
</div>
