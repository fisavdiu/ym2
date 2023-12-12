<?php

use App\Models\Comment;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
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
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-labelledby="title-04a desc-04a" aria-live="polite" aria-busy="true" class="w-10 h-10 animate animate-spin">
                <circle cx="12" cy="12" r="10" class="stroke-slate-200" stroke-width="4" />
                <path d="M12 22C14.6522 22 17.1957 20.9464 19.0711 19.0711C20.9464 17.1957 22 14.6522 22 12C22 9.34784 20.9464 6.8043 19.0711 4.92893C17.1957 3.05357 14.6522 2 12 2" class="stroke-teal-500" stroke-width="4" />
            </svg>
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
    <ul aria-label="User feed" role="feed" class="relative flex flex-col gap-12 py-8 px-8 ">
{{--        {{ var_dump($comments)  }}--}}
        @foreach($comments as $comment)
            <livewire:comments.card  :$comment wire:key="comment-{{ $comment->id }}"/>
        @endforeach


        @if(auth()->user())
            <livewire:comments.create :post="$post" />
        @endif
    </ul>
</div>
</div>
