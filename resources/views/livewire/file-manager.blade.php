<div>
    <h1 class="text-2xl font-bold">File Manager</h1>

    <!-- Upload Form -->
    <form wire:submit.prevent="upload" class="my-4">
        <input type="file" wire:model="newFile">
        @error('newFile') <span class="error">{{ $message }}</span> @enderror
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Upload</button>
    </form>

    <!-- Files List -->
    <ul>
        @foreach($files as $file)
            <li class="flex justify-between items-center my-2">
                <a href="{{ Storage::disk('s3')->url($file->path) }}" target="_blank" class="text-blue-500">
                    {{ $file->name }}
                </a>
                <button wire:click="delete({{ $file->id }})" class="bg-red-500 text-white px-2 py-1 rounded">
                    Delete
                </button>
            </li>
        @endforeach
    </ul>
</div>
