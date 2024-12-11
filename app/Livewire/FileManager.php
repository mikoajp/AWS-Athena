<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\File;

class FileManager extends Component
{
    use WithFileUploads;

    public $files;
    public $newFile;

    public function mount()
    {
        $this->files = File::all();
    }

    public function upload()
    {
        $validatedData = $this->validate([
            'newFile' => 'required|file|max:2048',
        ]);

        $path = $this->newFile->store('', 's3');

        $file = File::create([
            'name' => $this->newFile->getClientOriginalName(),
            'path' => $path,
        ]);

        Storage::disk('s3')->setVisibility($path, 'public');

        $this->files->prepend($file);
        $this->newFile = null;
    }

    public function delete(File $file)
    {
        Storage::disk('s3')->delete($file->path);
        $file->delete();

        $this->files = File::all();
    }

    public function render()
    {
        return view('livewire.file-manager')->layout('components.layouts.app');
    }
}
