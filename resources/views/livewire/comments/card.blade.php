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
                <img src="https://i.pravatar.cc/48?img=1" alt="user name" title="user name" width="48" height="48"
                     class="max-w-full rounded-full"/>
            </a>
            <h4 class="flex flex-col items-start text-lg font-medium leading-8 lg:items-center md:flex-row text-slate-700">
                <span class="flex-1">{{ $comment->author->name}}<span
                        class="text-base font-normal text-slate-500"> commented</span></span><span
                    class="text-sm font-normal text-slate-400">    {{ $comment->created_at->diffForHumans() }}</span>
            </h4>
            <p class=" text-slate-500"> {{$comment->body}} </p>
        </div>
    </div>
</div>
