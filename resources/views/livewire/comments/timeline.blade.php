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
    @if($comments->count() >= 1)
        <!-- Component: User feed -->
        <div class="flex items-center justify-start w-full mt-0 shadow-sm rounded bg-white md:p-2">
            <div class="relative flex flex-col gap-12 py-8 px-8 ">
                @foreach($comments as $comment)
                    <livewire:comments.card :$comment wire:key="comment-{{ $comment->id }}"/>
                @endforeach
            </div>
        </div>
    @endif
    @if(Auth::user() && Auth::user()->hasVerifiedEmail())
        <livewire:comments.create :post="$post"/>
    @endif

    {{-- LOGIN--}}
    @if (!Auth::user())
        <div class="pt-6">
            <a href="/login?redirect_url=/posts/{{ $post->id }}" wire:navigate
            <span class="inline-flex items-center justify-center h-12 gap-2 px-6 text-sm font-medium
        tracking-wide text-white transition duration-300 rounded focus-visible:outline-none whitespace-nowrap
        bg-teal-500 hover:bg-teal-600 focus:bg-teal-700 disabled:cursor-not-allowed disabled:border-teal-300
        disabled:bg-teal-300 disabled:shadow-none"></span>Log in to reply</a>
        </div>
    @endif

    @if (Auth::user() && !Auth::user()->hasVerifiedEmail())
        <div class="pt-6">
            <a href="/verify-email" wire:navigate
            <span class="inline-flex items-center justify-center h-12 gap-2 px-6 text-sm font-medium
        tracking-wide text-white transition duration-300 rounded focus-visible:outline-none whitespace-nowrap
        bg-teal-500 hover:bg-teal-600 focus:bg-teal-700 disabled:cursor-not-allowed disabled:border-teal-300
        disabled:bg-teal-300 disabled:shadow-none"></span>Verify your email to comment</a>
        </div>
    @endif
</div>
