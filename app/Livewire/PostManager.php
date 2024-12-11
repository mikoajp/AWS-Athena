<?php
namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostManager extends Component
{
    public $posts;
    public $title;
    public $content;
    public $postId;

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required',
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
        $this->resetInputs();
        $this->fetchPosts();
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->postId = $post->id;
        $this->title = $post->title;
        $this->content = $post->content;
    }

    public function update()
    {
        $this->validate();
        $post = Post::findOrFail($this->postId);
        $post->update([
            'title' => $this->title,
            'content' => $this->content,
        ]);
        $this->resetInputs();
        $this->fetchPosts();
    }

    public function delete($id)
    {
        Post::destroy($id);
        $this->fetchPosts();
    }

    public function resetInputs()
    {
        $this->title = '';
        $this->content = '';
        $this->postId = null;
    }

    public function render()
    {
        return view('livewire.post-manager');
    }
}
