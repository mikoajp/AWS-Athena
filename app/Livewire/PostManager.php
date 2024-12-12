<?php
namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostManager extends Component
{
    public $posts;
    public $title = '';
    public $content = '';
    public $postId = null; // Define $postId as a public property

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ];

    public function mount()
    {
        $this->fetchPosts();
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
            session()->flash('error', 'No post selected for update.');
            return;
        }

        $this->validate();

        $post = Post::find($this->postId);

        if (!$post) {
            session()->flash('error', 'Post not found for updating.');
            return;
        }

        $post->update([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        $this->dispatch('postUpdated'); // Zmiana z emit na dispatch
        session()->flash('success', 'Post updated successfully.');
        $this->resetInputs();
        $this->fetchPosts();
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

    public function render()
    {
        return view('livewire.post-manager');
    }
}
