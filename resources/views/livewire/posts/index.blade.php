<?php

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Volt\Component;
use Livewire\Attributes\Url;

new class extends Component {
    #[Url]
    public string $search = '';


    public function posts(): Collection
    {
        return Post::query()
            ->with(['category', 'author', 'latestComment'])
            ->withCount('comments')
            ->where('title', 'like', "%$this->search%")
            ->where('is_deleted', false)
            ->latest('created_at')
            ->limit(50)
            ->get();
    }

    public function with(): array
    {
        return [
            'posts' => $this->posts(),
        ];
    }
};
?>

<div>
    {{-- SEARCH BAR --}}
{{--    <livewire:components.search wire:model.live.debounce="search"/>--}}
    <input id="id-l16" type="text" wire:model.live.debounce="search" name="id-l16" placeholder="Search here"
           class="relative w-full h-12 px-4 pr-12 transition-all border rounded outline-none focus-visible:outline-none
           peer border-slate-200 text-slate-500 autofill:bg-white invalid:border-pink-500 invalid:text-pink-500
           focus:border-teal-500 focus:outline-none invalid:focus:border-pink-500 disabled:cursor-not-allowed
           disabled:bg-slate-50 disabled:text-slate-400"/>
    {{-- END SEARCH BAR--}}

    {{--POSTS --}}
    @foreach($posts as $post)
        <div class="py-4">
            <a href="/posts/{{ $post->id }}">
                <div class="flex items-center justify-start w-full p-8 shadow-sm rounded bg-white hover:bg-teal-50 md:p-2">
                    <div class="px-6 pt-4 pb-0">
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
                        <div class="w-fit flex items-center gap-2 py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="h-4 w-4">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                            {{$post->comments->count()}} Comments</div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
    {{-- END POSTS--}}
</div>
