<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;

new class extends Component {
    public ?Post $post;

    #[Rule('required|min:5')]
    public string $title;

    #[Rule('required|min:10')]
    public string $body;

    #[Rule('required')]
    public string $category_id;

    public function categories(): Collection
    {
        return Category::all();
    }

    public function save()
    {
        $post = (new Post())->fill($this->validate());
        $post->author_id = auth()->user()->id;
        $post->save();
        return redirect()->to('/');
    }

    public function with(): array
    {
        return [
            'categories' => $this->categories()
        ];
    }
}; ?>

<div>
    <div class="flex w-full p-20 shadow-sm rounded bg-white md:p-2">

        <form class="w-full p-8" wire:submit="save">
            <!-- Component: Rounded input with helper text -->
            <div class="relative my-8">
                <input wire:model="title" type="text" placeholder="Title" class="relative w-full h-10 px-4 text-sm placeholder-transparent transition-all border rounded outline-none focus-visible:outline-none peer border-slate-200 text-slate-500 autofill:bg-white invalid:border-pink-500 invalid:text-pink-500 focus:border-brand-500 focus:outline-none invalid:focus:border-pink-500 disabled:cursor-not-allowed disabled:bg-slate-50 disabled:text-slate-400" />
                <label for="id-b03" class="cursor-text peer-focus:cursor-default peer-autofill:-top-2 absolute left-2 -top-2 z-[1] px-2 text-xs text-slate-400 transition-all before:absolute before:top-0 before:left-0 before:z-[-1] before:block before:h-full before:w-full before:bg-white before:transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-required:after:text-pink-500 peer-required:after:content-['\00a0*'] peer-invalid:text-pink-500 peer-focus:-top-2 peer-focus:text-xs peer-focus:text-brand-500 peer-invalid:peer-focus:text-pink-500 peer-disabled:cursor-not-allowed peer-disabled:text-slate-400 peer-disabled:before:bg-transparent">
                    Title
                </label><small class="absolute flex justify-between w-full px-4 py-1 text-xs transition text-slate-400 peer-invalid:text-pink-500">
                    @error('title') <span class="error">{{ $message }}</span> @enderror
                </small>
            </div>
            <!-- End Rounded input with helper text -->

            <!-- Component: Rounded base select with helper text -->
            <div class="relative my-8 md:w-60">
                <select wire:model="category_id" id="id-05" name="id-05" required class="relative w-full h-10 px-4 text-sm transition-all bg-white border rounded outline-none appearance-none focus-visible:outline-none peer border-slate-200 text-slate-500 autofill:bg-white focus:border-brand-500 focus:focus-visible:outline-none disabled:cursor-not-allowed disabled:bg-slate-50 disabled:text-slate-400">
                    <option selected></option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                <label for="id-05" class="pointer-events-none absolute top-2.5 left-2 z-[1] px-2 text-sm text-slate-400 transition-all before:absolute before:top-0 before:left-0 before:z-[-1] before:block before:h-full before:w-full before:bg-white before:transition-all peer-required:after:text-pink-500 peer-required:after:content-['\00a0*'] peer-valid:-top-2 peer-valid:text-xs peer-focus:-top-2 peer-focus:text-xs peer-focus:text-brand-500 peer-disabled:cursor-not-allowed peer-disabled:text-slate-400 peer-disabled:before:bg-transparent">
                    Select a category
                </label>
                <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none absolute top-2.5 right-2 h-5 w-5 fill-slate-400 transition-all peer-focus:fill-brand-500 peer-disabled:cursor-not-allowed" viewBox="0 0 20 20" fill="currentColor" aria-labelledby="title-05 description-05" role="graphics-symbol">
                    <title id="title-05">Arrow Icon</title>
                    <desc id="description-05">Arrow icon of the select list.</desc>
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                <small class="absolute flex justify-between w-full px-4 py-1 text-xs transition text-slate-400">
                    @error('category_id') <span class="error">{{ $message }}</span> @enderror
                </small>
            </div>
            <!-- End Rounded base select with helper text -->


            <!-- Component: Rounded base size textarea with helper text -->
            <div class="relative my-8">
                <textarea wire:model="body" id="id-b03" type="text" name="id-b03" rows="3" placeholder="Write your message" class="relative w-full px-4 py-2 text-sm placeholder-transparent transition-all border rounded outline-none focus-visible:outline-none peer border-slate-200 text-slate-500 autofill:bg-white invalid:border-pink-500 invalid:text-pink-500 focus:border-brand-500 focus:outline-none invalid:focus:border-pink-500 disabled:cursor-not-allowed disabled:bg-slate-50 disabled:text-slate-400"></textarea>
                <label for="id-b03" class="cursor-text peer-focus:cursor-default absolute left-2 -top-2 z-[1] px-2 text-xs text-slate-400 transition-all before:absolute before:top-0 before:left-0 before:z-[-1] before:block before:h-full before:w-full before:bg-white before:transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-required:after:text-pink-500 peer-required:after:content-['\00a0*'] peer-invalid:text-pink-500 peer-focus:-top-2 peer-focus:text-xs peer-focus:text-brand-500 peer-invalid:peer-focus:text-pink-500 peer-disabled:cursor-not-allowed peer-disabled:text-slate-400 peer-disabled:before:bg-transparent">
                    Write your post
                </label>
                <small class="absolute flex justify-between w-full px-4 py-1 text-xs transition text-slate-400 peer-invalid:text-pink-500">
                    @error('body') <span class="error">{{ $message }}</span> @enderror
                </small>
            </div>
            <!-- End Rounded base size textarea with helper text -->

            <!-- Component: Large primary basic button -->
            <div class="relative ml-auto">
            <button type="submit" class="inline-flex items-center justify-center h-12 gap-2 px-6 text-sm font-medium tracking-wide text-white transition duration-300 rounded focus-visible:outline-none whitespace-nowrap bg-brand-500 hover:bg-brand-600 focus:bg-brand-700 disabled:cursor-not-allowed disabled:border-brand-300 disabled:bg-brand-300 disabled:shadow-none">
                <span>Submit</span>
            </button>
            </div>
            <!-- End Large primary basic button -->

        </form>
    </div>
</div>
