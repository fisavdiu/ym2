<?php

use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Volt\Component;
use Livewire\Attributes\Url;

new class extends Component {
    public ?User $user;

    #[Url]
    public string $selectedTab = 'posts-tab';

    public function mount(): void
    {
        $this->user = auth()->user();
    }

    public function posts(): Collection
    {
        return $this->user
            ->posts()
            ->withCount('comments')
            ->take(10)
            ->latest()
            ->get();
    }

    public function comments(): Collection
    {
        return $this->user
            ->comments()
            ->with('post.author')
            ->take(10)
            ->latest()
            ->get();
    }

    public function with(): array
    {
        return [
            'posts' => $this->posts(),
            'comments' => $this->comments(),
        ];
    }
}; ?>
<div>

<div class=" w-full p-8 shadow-sm rounded bg-white md:p-2">

    <div class="flex items-center gap-2">
        <div class="avatar">
            <a href="#" class="relative inline-flex items-center justify-center w-20 h-20 text-lg text-white rounded-full bg-teal-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-labelledby="title description" role="graphics-symbol">
                    <title id="title">User Icon</title>
                    <desc id="description">User icon associated with a particular user account</desc>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </a>
        </div>
        <div class="font-semibold font-lg text-2xl !font-black pl-2">{{$user->name}}</div>
    </div>
    <!-- Component: Basic lg sized tab with leading icon -->
    <section class="max-w-full" aria-multiselectable="false">
        <ul class="flex items-center border-b border-slate-200" role="tablist">
            <li role="presentation">
                <button class="inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none whitespace-nowrap border-teal-500 hover:border-teal-600 focus:border-teal-700 text-teal-500 hover:text-teal-600 focus:text-teal-700 hover:bg-teal-50 focus:bg-teal-50 disabled:cursor-not-allowed disabled:border-slate-500 stroke-teal-500 hover:stroke-teal-600 focus:stroke-teal-700" id="tab-label-1ai" role="tab" aria-setsize="3" aria-posinset="1" tabindex="0" aria-controls="tab-panel-1ai" aria-selected="true">
                    <span class="order-2 ">Posts</span>
                    <span class="relative only:-mx-6">
          <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512" class="fill-teal-500"> <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path
                  d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
        </span>
                </button>
            </li>
            <li role="presentation">
                <button class="inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 border-transparent rounded-t focus-visible:outline-none justify-self-center hover:border-teal-500 focus:border-teal-600 whitespace-nowrap text-slate-700 stroke-slate-700 hover:bg-teal-50 hover:text-teal-500 focus:stroke-teal-600 focus:bg-teal-50 focus:text-teal-600 hover:stroke-teal-600 disabled:cursor-not-allowed disabled:text-slate-500" id="tab-label-2ai" role="tab" aria-setsize="3" aria-posinset="2" tabindex="-1" aria-controls="tab-panel-2ai" aria-selected="false">
                    <span class="order-2 ">Comments</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                </button>
            </li>
        </ul>
        <div>
            <div class="px-6 py-4" id="tab-panel-1ai" aria-hidden="false" role="tabpanel" aria-labelledby="tab-label-1ai" tabindex="-1">
                @foreach($posts as $post)
                    <div class="py-1">
                        <a href="/posts/{{ $post->id }}">
                            <div class="flex items-center justify-start w-full p-8 shadow-sm rounded bg-white hover:bg-teal-50 md:p-2">
                                <div class="px-2 pt-2 pb-0">
                                    <div class="max-h-40 text-xs text-gray-500">
                                        <button
                                            class="inline-flex items-center justify-center h-6 gap-2 px-4 text-xs font-medium tracking-wide transition duration-300 rounded-full focus-visible:outline-none justify-self-center whitespace-nowrap bg-teal-50 text-teal-500 hover:bg-teal-100 hover:text-teal-600 focus:bg-teal-200 focus:text-teal-700 disabled:cursor-not-allowed disabled:border-teal-300 disabled:bg-teal-100 disabled:text-teal-400 disabled:shadow-none">
                                            <span>{{ $post->category->name }}</span>
                                        </button>
                                        <span
                                            class="px-1">•</span>
                                        {{ $post->created_at->diffForHumans() }}
                                    </div>
                                    <div class="justify-end">
                                    <header class="mb-1">
                                        <h3 class="text-xl font-medium text-slate-700">{{$post->title}}</h3>
                                    </header>
                                    <div class="w-fit flex items-center gap-2 py-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="h-4 w-4">
                                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                        {{$post->comments->count()}} Comments</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="hidden px-6 py-4" id="tab-panel-2ai" aria-hidden="true" role="tabpanel" aria-labelledby="tab-label-2ai" tabindex="-1">
                <p>
                    One must be entirely sensitive to the structure of the material that one is handling. One must yield to it in tiny details of execution, perhaps the handling of the surface or grain, and one must master it as a whole.
                </p>

            </div>
            <div class="hidden px-6 py-4" id="tab-panel-3ai" aria-hidden="true" role="tabpanel" aria-labelledby="tab-label-3ai" tabindex="-1">
                <p>
                    Even though there is no certainty that the expected results of our work will manifest, we have to remain committed to our work and duties; because, even if the results are slated to arrive, they cannot do so without the performance of work.
                </p>
            </div>
        </div>
    </section>
{{--    @livewireScripts--}}
    <!-- End Basic lg sized tab with leading icon -->
</div>
</div>
