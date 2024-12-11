<div class="max-w-4xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Manage Posts</h1>

    <form wire:submit.prevent="{{ $postId ? 'update' : 'create' }}" class="mb-6">
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

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
            {{ $postId ? 'Update' : 'Create' }}
        </button>
    </form>

    <hr class="my-4">

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
                    <button wire:click="edit({{ $post->id }})" class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</button>
                    <button wire:click="delete({{ $post->id }})" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
