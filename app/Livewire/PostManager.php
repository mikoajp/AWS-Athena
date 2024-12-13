<?php
namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostManager extends Component
{
    public $posts;
    public $title = '';
    public $content = '';
    public $isEditing = false;
    public $postId = null; // Define $postId as a public property
    public $showCreateForm = false;
    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ];

    public function mount()
    {
        $this->fetchPosts();
    }

    public function showCreate()
    {
        $this->resetInputs(); // Reset form inputs
        $this->showCreateForm = true;
    }

    public function hideCreate()
    {
        $this->showCreateForm = false;
    }

    public function fetchPosts()
    {
        $this->posts = Post::all();
    }

    public function create()
    {
        $this->validate();

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        session()->flash('success', 'Post created successfully.');
        $this->resetCreateForm();
        $this->resetInputs();
        $this->fetchPosts();
    }

    public function resetCreateForm()
    {
        $this->title = '';
        $this->content = '';
        $this->showCreateForm = false;
    }
    public function edit($id)
    {
        $this->resetEditState();
        $this->isEditing = true;
        $post = Post::find($id);

        if (!$post) {
            session()->flash('error', 'Post not found.');
            return;
        }

        $this->postId = $post->id;
        $this->title = $post->title;
        $this->content = $post->content;
    }

    public function resetEditState()
    {
        $this->isEditing = false;
        $this->postId = null;
        $this->title = '';
        $this->content = '';
    }

    protected $listeners = ['postUpdated' => '$refresh'];

    public function update()
    {
        if (!$this->postId) {
            return;
        }

        $this->validate();

        $post = Post::find($this->postId);
        if ($post) {
            $post->update([
                'title' => $this->title,
                'content' => $this->content,
            ]);

            session()->flash('message', 'Post updated successfully.');
            $this->resetInputs();
            $this->fetchPosts();
        }
    }

    public function delete($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            session()->flash('message', 'Post deleted successfully!');
            session()->flash('type', 'bg-green-100 text-green-700');
            $this->resetEditState();
            $this->fetchPosts();
        } else {
            session()->flash('message', 'Post not found.');
            session()->flash('type', 'bg-red-100 text-red-700');
        }
    }


    public function resetInputs()
    {
        $this->title = '';
        $this->content = '';
        $this->postId = null; // Reset $postId
    }
    public function cancelEdit()
    {
        $this->resetInputs();
    }

    public function render()
    {
        return view('livewire.post-manager');
    }
}
