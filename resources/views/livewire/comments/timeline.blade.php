<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;

new class extends Component {

    public Post $post;
// Parent Component

    public function comments(): Collection
    {
        return Comment::query()
            ->with(['author', 'post'])
            ->whereBelongsTo($this->post)
            ->oldest()
            ->get();
    }

    #[On('comment-done')]
    public function done(): void
    {
        // None. Just refresh the list from child events when necessary
    }

    // For lazy loading
    public function placeholder(): string
    {
        return <<<'HTML'
        <div>
            <div class="loading loading-spinner"></div>
        </div>
        HTML;
    }

    public function with(): array
    {
        return [
            'comments' => $this->comments()
        ];
    }
}; ?>

<div>
    <div class="flex items-center justify-start w-full mt-0 shadow-sm rounded bg-white md:p-2">
        <!-- Component: User feed -->
        <div class="relative flex flex-col gap-12 py-8 px-8 ">
            {{--        {{ var_dump($comments)  }}--}}
            @foreach($comments as $comment)
                <livewire:comments.card :$comment wire:key="comment-{{ $comment->id }}"/>
            @endforeach
        </div>

    </div>
    @if(auth()->user())
        <livewire:comments.create :post="$post" wire:key="md5($post->id)"/>
    @endif
</div>
