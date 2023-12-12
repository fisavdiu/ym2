<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;

new class extends Component {
    public Post $post;

    #[Rule('required|min:5')]
    public string $title;

    #[Rule('required|min:10')]
    public string $body;

    #[Rule('required')]
    public string $category_id;

    public function mount(Post $post): void
    {
        $this->fill($post);
    }

    public function categories(): Collection
    {
        return Category::all();
    }

    public function save()
    {
        $this->post->update($this->validate());
        return redirect()->route('posts.show', ['post'=> $this->post->id]);
    }

    public function with(): array
    {
        return [
            'categories' => $this->categories()
        ];
    }
}; ?>

<div>
    <form wire:submit="save">
        <input type="text" wire:model="title">
        <div>
            @error('title') <span class="error">{{ $message }}</span> @enderror
        </div>
        <select wire:model="category_id">
            @foreach($categories as $category)

                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <div>
            @error('category_id') <span class="error">{{ $message }}</span> @enderror
        </div>

        <input type="text" wire:model="body">
        <div>
            @error('body') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Save</button>
    </form></div>
