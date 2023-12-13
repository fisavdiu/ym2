<?php

use App\Models\Comment;
use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;

new class extends Component {


    public Post $post;

    public Comment $comment;

    public bool $editing = false;

    #[Rule('required|min:5')]
    public ?string $body;

    public function mount(Comment $comment): void
    {
        $this->post = $comment->post;
        $this->body = $comment->body;
    }

}; ?>

<div>
    <div role="article" class="relative pl-8 ">
        <div class="flex flex-col flex-1 gap-4">
            <a href="#"
               class="absolute z-10 inline-flex items-center justify-center w-8 h-8 text-white rounded-full -left-4 ring-2 ring-white">
                <!-- Component: Rounded full base sized basic icon avatar -->
                <div href="#"
                     class="relative inline-flex items-center justify-center w-8 h-8 text-white rounded-full bg-teal-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="1.5" aria-labelledby="title description"
                         role="graphics-symbol">
                        <title id="title">User Icon</title>
                        <desc id="description">User icon associated with a particular user account</desc>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <!-- End Rounded base sized basic icon avatar -->
            </a>
            <h4 class="flex flex-col justify-between text-lg font-medium leading-8 lg:items-center md:flex-row text-slate-700">
                <span class="flex-1">{{ $comment->author->name }}<span
                        class="text-base font-normal text-slate-500"> commented</span></span>
                <div
                    class="ml-auto text-sm font-normal text-slate-400">    {{ $comment->created_at->diffForHumans() }}</div>
            </h4>
            <p class=" text-slate-500"> {{$comment->body}} </p>
        </div>
    </div>
</div>
