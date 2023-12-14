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
                <a href="#"
                   class="relative inline-flex items-center justify-center w-20 h-20 text-lg text-white rounded-full bg-brand-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="1.5" aria-labelledby="title description"
                         role="graphics-symbol">
                        <title id="title">User Icon</title>
                        <desc id="description">User icon associated with a particular user account</desc>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </a>
            </div>
            <div class="font-semibold font-lg text-2xl !font-black pl-2">{{$user->name}}</div>
            <div class="ml-auto">
                <!-- Component: Large primary button with leading icon  -->
                <a href="/edit-profile" wire:navigate
                    class="inline-flex items-center justify-center h-12 gap-2 px-6 text-sm font-medium tracking-wide text-white transition duration-300 rounded focus-visible:outline-none whitespace-nowrap bg-brand-500 hover:bg-brand-600 focus:bg-brand-700 disabled:cursor-not-allowed disabled:border-brand-300 disabled:bg-brand-300 disabled:shadow-none">
                    <span class="order-2">Edit Profile</span>
                    <span class="relative only:-mx-6">
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path
                    fill="#ffffff"
                    d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H322.8c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1H178.3zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z"/></svg>  </span>
                </a>
                <!-- End Large primary button with leading icon  -->
            </div>
        </div>
        <!-- Component: Basic lg sized tab with leading icon -->
        <section class="max-w-full" aria-multiselectable="false">
            <ul class="flex items-center border-b border-slate-200" role="tablist">
                <li role="presentation">
                    <button
                        class="inline-flex items-center justify-center w-full h-12 gap-2 px-6 -mb-px text-sm font-medium tracking-wide transition duration-300 border-b-2 rounded-t focus-visible:outline-none whitespace-nowrap border-brand-500 hover:border-brand-600 focus:border-brand-700 text-brand-500 hover:text-brand-600 focus:text-brand-700 hover:bg-brand-50 focus:bg-brand-50 disabled:cursor-not-allowed disabled:border-slate-500 stroke-brand-500 hover:stroke-brand-600 focus:stroke-brand-700"
                        id="tab-label-1ai" role="tab" aria-setsize="3" aria-posinset="1" tabindex="0"
                        aria-controls="tab-panel-1ai" aria-selected="true">
                        <span class="order-2 ">Posts</span>
                        <span class="relative only:-mx-6">
          <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512" class="fill-brand-500"> <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path
                  d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
        </span>
                    </button>
                </li>
            </ul>
            <div>
                <div class="px-6 py-4" id="tab-panel-1ai" aria-hidden="false" role="tabpanel"
                     aria-labelledby="tab-label-1ai" tabindex="-1">
                    @foreach($posts as $post)
                        <div class="py-1">
                            <a href="/posts/{{ $post->id }}">
                                <div
                                    class="flex items-center justify-start w-full p-8 shadow-sm rounded bg-white hover:bg-brand-50 md:p-2">
                                    <div class="px-2 pt-2 pb-0">
                                        <div class="max-h-40 text-xs text-gray-500">
                                            <button
                                                class="inline-flex items-center justify-center h-6 gap-2 px-4 text-xs font-medium tracking-wide transition duration-300 rounded-full focus-visible:outline-none justify-self-center whitespace-nowrap bg-brand-50 text-brand-500 hover:bg-brand-100 hover:text-brand-600 focus:bg-brand-200 focus:text-brand-700 disabled:cursor-not-allowed disabled:border-brand-300 disabled:bg-brand-100 disabled:text-brand-400 disabled:shadow-none">
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
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24"
                                                     fill="none" stroke="currentColor" stroke-width="2"
                                                     stroke-linecap="round"
                                                     stroke-linejoin="round" class="h-4 w-4">
                                                    <path
                                                        d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                                </svg>
                                                {{$post->comments->count()}} Comments
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="hidden px-6 py-4" id="tab-panel-2ai" aria-hidden="true" role="tabpanel"
                     aria-labelledby="tab-label-2ai" tabindex="-1">
                    <p>
                        One must be entirely sensitive to the structure of the material that one is handling. One must
                        yield to it in tiny details of execution, perhaps the handling of the surface or grain, and one
                        must master it as a whole.
                    </p>

                </div>
                <div class="hidden px-6 py-4" id="tab-panel-3ai" aria-hidden="true" role="tabpanel"
                     aria-labelledby="tab-label-3ai" tabindex="-1">
                    <p>
                        Even though there is no certainty that the expected results of our work will manifest, we have
                        to remain committed to our work and duties; because, even if the results are slated to arrive,
                        they cannot do so without the performance of work.
                    </p>
                </div>
            </div>
        </section>
        {{--    @livewireScripts--}}
        <!-- End Basic lg sized tab with leading icon -->
    </div>
</div>
