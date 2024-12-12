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
        $this->resetInputs();
        $this->fetchPosts();
    }

    public function edit($id)
    {
        $this->isEditing = true;
        $post = Post::find($id);

        if (!$post) {
            session()->flash('error', 'Post not found.');
            return;
        }

        $this->postId = $post->id; // Assign the post's ID to $postId
        $this->title = $post->title;
        $this->content = $post->content;
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

        if (!$post) {
            session()->flash('error', 'Post not found for deletion.');
            return;
        }

        $post->delete();

        session()->flash('success', 'Post deleted successfully.');
        $this->fetchPosts();
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
