<?php

use App\Models\Post;
use Livewire\Attributes\Renderless;
use Livewire\Volt\Component;

new class extends Component {

    public Post $post;

    public function mount(): void
    {
        if ($this->post->is_deleted) {
            redirect()->to('/');
        }
    }

    public function delete(): void
    {
        if ($this->post->comments()->count() > 0) {
            $this->addError(['delete'], ['Cannot be deleted']);
        }

        $this->post->update(['is_deleted' => true]);
        $this->redirect('/');
    }

}; ?>
<div>
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
                <div class="justify-content-end pt-8">
                    @if($post->author->isMyself() )
                        <div>
                            @if($post->comments->count() < 1)
                                <!-- Component: Small primary basic button -->
                                <button wire:click="delete"
                                        wire:confirm="Are you sure you want to delete this post?"
                                        class="inline-flex items-center justify-center h-8 gap-2 px-4 text-xs font-medium tracking-wide text-white transition duration-300 rounded-full focus-visible:outline-none whitespace-nowrap bg-teal-500 hover:bg-teal-600 focus:bg-teal-700 disabled:cursor-not-allowed disabled:border-teal-300 disabled:bg-teal-300 disabled:shadow-none">
                                    <span>Delete</span>
                                </button>

                            @endif
                            <button href="/posts/{{ $post->id }}/edit" wire:navigate
                                    class="inline-flex items-center justify-center h-8 gap-2 px-4 text-xs font-medium tracking-wide text-white transition duration-300 rounded-full focus-visible:outline-none whitespace-nowrap bg-teal-500 hover:bg-teal-600 focus:bg-teal-700 disabled:cursor-not-allowed disabled:border-teal-300 disabled:bg-teal-300 disabled:shadow-none">
                                <span>Edit</span>
                            </button>

                            <!-- End Small primary basic button -->
                        </div>
                        @error('delete') <span>{{$message}}</span> @enderror
                    @endif
                </div>
            </div>

        </div>


        <livewire:comments.timeline :post="$post" wire:key="comments-{{ $post->updated_at }}"/>
    </div>
</div>
