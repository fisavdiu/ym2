<?php

use App\Models\Post;
use Livewire\Attributes\Renderless;
use Livewire\Volt\Component;

new class extends Component {

    public Post $post;

    public function delete(): void
    {
        $this->post->update(['is_deleted' => true]);
        $this->warning('Post deleted.');
    }

}; ?>
<div class="py-4">

        <div class="flex items-center justify-start w-full p-8 shadow-sm rounded bg-white md:p-2 mb-10">
            <div class="px-6 pt-4 pb-6">
                <div class="max-h-40 text-xs text-gray-500">
                    <button
                        class="inline-flex items-center justify-center h-6 gap-2 px-4 text-xs font-medium tracking-wide transition duration-300 rounded-full focus-visible:outline-none justify-self-center whitespace-nowrap bg-teal-50 text-teal-500 hover:bg-teal-100 hover:text-teal-600 focus:bg-teal-200 focus:text-teal-700 disabled:cursor-not-allowed disabled:border-teal-300 disabled:bg-teal-100 disabled:text-teal-400 disabled:shadow-none">
                        <span>{{ $post->category->name }}</span>
                    </button>
                    <span
                        class="px-1">•</span><span>Posted by {{ $post->author->name }}</span><span
                        class="px-1">•</span>
                    {{ $post->created_at->diffForHumans() }}
                </div>
                <header class="mb-1">
                    <h3 class="text-xl font-medium text-slate-700">{{$post->title}}</h3>
                </header>
                <p> {{$post->body }} </p>
            </div>

        </div>
        <livewire:comments.timeline  :post="$post" lazy wire:key="comments-{{  $post->updated_at }}" />
</div>

