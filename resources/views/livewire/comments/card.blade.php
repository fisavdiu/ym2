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
    public function delete(Comment $comment): void
    {
        $comment->delete();
        $this->dispatch('saved');
    }

    public function save(): void
    {
        $this->comment->update($this->validate());
        $this->post->touch('updated_at');

        $this->editing = false;
    }

}; ?>

<div>

    <div role="article" class="relative pl-8 ">
        <div class="flex flex-col flex-1 gap-4">
            <a href="#"
               class="absolute inline-flex items-center justify-center w-8 h-8 text-white rounded-full -left-4 bg-brand-500 ring-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 max-w-full rounded-full" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-labelledby="title-53 desc-53"
                     role="graphics-symbol">


                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </a>
            <h4 class="flex flex-col items-start text-lg font-medium leading-8 lg:items-center md:flex-row text-slate-700">
                <span class="flex-1">{{ $comment->author->name }}<span
                        class="text-base font-normal text-slate-500"> commented </span></span><span
                    class="text-sm font-sm text-slate-400">  {{ $comment->created_at->diffForHumans() }}</span></h4>
            <p x-show="!$wire.editing" class=" text-slate-500">{{$comment->body}} </p>

            <div>
{{--                <form x-show="$wire.editing"><button>TEST</button></form>--}}
                <form class="py-6" x-show="$wire.editing" wire:submit="save">
                    <div class="relative">
                        <textarea wire:model="body" id="id-b03" type="text" name="id-b03" rows="3" placeholder="Write your message"
                                  class="relative w-full px-4 py-2 text-sm placeholder-transparent transition-all border rounded outline-none
                                  focus-visible:outline-none peer border-slate-200 text-slate-500 autofill:bg-white invalid:border-pink-500
                                  invalid:text-pink-500 focus:border-teal-500 focus:outline-none invalid:focus:border-pink-500 disabled:cursor-not-allowed
                                   disabled:bg-slate-50 disabled:text-slate-400">{!!  nl2br($comment->body) !!}</textarea>
                        <label for="id-b03"
                               class="cursor-text peer-focus:cursor-default absolute left-2 -top-2 z-[1] px-2 text-xs text-slate-400 transition-all before:absolute before:top-0 before:left-0 before:z-[-1] before:block before:h-full before:w-full before:bg-white before:transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-required:after:text-pink-500 peer-required:after:content-['\00a0*'] peer-invalid:text-pink-500 peer-focus:-top-2 peer-focus:text-xs peer-focus:text-teal-500 peer-invalid:peer-focus:text-pink-500 peer-disabled:cursor-not-allowed peer-disabled:text-slate-400 peer-disabled:before:bg-transparent">
                            Write your message
                        </label>
                        <small
                            class="absolute flex justify-between w-full px-4 py-1 text-xs transition text-slate-400 peer-invalid:text-pink-500">
                            @error('body')<span> {{ $message }}</span>@enderror
                        </small>

                    </div>
                    <div class="pt-4">
                        <button @click="$wire.editing = false" class="inline-flex items-center justify-center h-8 gap-2 px-4 text-xs font-medium tracking-wide transition duration-300 rounded focus-visible:outline-none justify-self-center whitespace-nowrap bg-brand-50 text-brand-500 hover:bg-brand-100 hover:text-brand-600 focus:bg-brand-200 focus:text-brand-700 disabled:cursor-not-allowed disabled:border-brand-300 disabled:bg-brand-100 disabled:text-brand-400 disabled:shadow-none">
                            <span>Cancel</span>
                        </button>
                        <button type="submit" class="inline-flex items-center justify-center h-8 gap-2 px-4 text-xs font-medium tracking-wide transition duration-300 rounded focus-visible:outline-none justify-self-center whitespace-nowrap bg-brand-50 text-brand-500 hover:bg-brand-100 hover:text-brand-600 focus:bg-brand-200 focus:text-brand-700 disabled:cursor-not-allowed disabled:border-brand-300 disabled:bg-brand-100 disabled:text-brand-400 disabled:shadow-none">
                            <span>Save</span>
                        </button>
                    </div>

                </form>

{{--                <p x-show="!$wire.editing" class="text-slate-500"> {{$comment->body}} </p>--}}


            @if($comment->author->isMyself())

                    <div class="row">
                        <button
                            class="inline-flex items-center justify-center h-8 gap-2 px-4 text-xs font-medium tracking-wide text-white
             transition duration-300 rounded-full focus-visible:outline-none whitespace-nowrap bg-brand-500 hover:bg-brand-600 focus:bg-brand-700"
                            @click="$wire.editing = true">Edit
                        </button>
                        <button
                            wire:confirm="Are you sure you want to delete this comment?"
                            class="inline-flex items-center justify-center h-8 gap-2 px-4 text-xs font-medium tracking-wide text-white
             transition duration-300 rounded-full focus-visible:outline-none whitespace-nowrap bg-brand-500 hover:bg-brand-600 focus:bg-brand-700"
                            wire:click="delete({{ $comment->id  }})">Delete
                        </button>
                    </div>
                @endif
            </div>

        </div>
    </div>

</div>
