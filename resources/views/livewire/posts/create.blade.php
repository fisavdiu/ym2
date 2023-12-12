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
    <div class="grid lg:grid-cols-4 gap-10">

        <form wire:submit="save">
            <input type="text" wire:model="title">
            <div>
                @error('title') <span class="error">{{ $message }}</span> @enderror
            </div>
            <select wire:model="category_id">
                @foreach($categories as $category)

                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <div>
                @error('category_id') <span class="error">{{ $message }}</span> @enderror
            </div>

            <input type="text" wire:model="body">
            <div>
                @error('body') <span class="error">{{ $message }}</span> @enderror
            </div>

            <button type="submit">Save</button>
        </form>


{{--        <form wire:submit="save" class="col-span-3">--}}
{{--            <!-- Component: Rounded invalid input -->--}}
{{--            <!-- Component: Rounded large input with helper text -->--}}
{{--            <div class="relative my-6">--}}
{{--                <input id="id-l03" type="text" wire:model="title"--}}
{{--                       class="relative w-full h-12 px-4 placeholder-transparent transition-all border rounded outline-none focus-visible:outline-none peer border-slate-200 text-slate-500 autofill:bg-white invalid:border-pink-500 invalid:text-pink-500 focus:border-teal-500 focus:outline-none invalid:focus:border-pink-500 disabled:cursor-not-allowed disabled:bg-slate-50 disabled:text-slate-400"/>--}}
{{--                <label for="id-l03"--}}
{{--                       class="cursor-text peer-focus:cursor-default peer-autofill:-top-2 absolute left-2 -top-2 z-[1] px-2 text-xs text-slate-400 transition-all before:absolute before:top-0 before:left-0 before:z-[-1] before:block before:h-full before:w-full before:bg-white before:transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-base peer-required:after:text-pink-500 peer-required:after:content-['\00a0*'] peer-invalid:text-pink-500 peer-focus:-top-2 peer-focus:text-xs peer-focus:text-teal-500 peer-invalid:peer-focus:text-pink-500 peer-disabled:cursor-not-allowed peer-disabled:text-slate-400 peer-disabled:before:bg-transparent">--}}
{{--                    Title--}}
{{--                </label>--}}
{{--                <small--}}
{{--                    class="absolute flex justify-between w-full px-4 py-1 text-xs transition text-slate-400 peer-invalid:text-pink-500">--}}
{{--                    --}}{{--                    <span>Text field with helper text</span>--}}
{{--                    --}}{{--                    <span class="text-slate-500">1/10</span>--}}
{{--                </small>--}}
{{--            </div>--}}
{{--            <!-- Component: Rounded base basic select -->--}}
{{--            <div class="relative my-6 md:w-60">--}}
{{--                <select id="id-04" name="id-04"  wire:model="category_id"--}}
{{--                        class="relative w-full h-10 px-4 text-sm transition-all bg-white border rounded outline-none appearance-none focus-visible:outline-none peer border-slate-200 text-slate-500 autofill:bg-white focus:border-teal-500 focus:focus-visible:outline-none disabled:cursor-not-allowed disabled:bg-slate-50 disabled:text-slate-400">--}}
{{--                    <option value="" disabled selected></option>--}}
{{--                    @foreach($categories as $category)--}}

{{--                        <option value="{{$category->$category_id}}">{{$category->name}}</option>--}}
{{--                    @endforeach--}}
{{--                    --}}{{--                    <option value="2">Option 2</option>--}}
{{--                    --}}{{--                    <option value="3">Option 3</option>--}}
{{--                </select>--}}
{{--                <label for="id-04"--}}
{{--                       class="pointer-events-none absolute top-2.5 left-2 z-[1] px-2 text-sm text-slate-400 transition-all before:absolute before:top-0 before:left-0 before:z-[-1] before:block before:h-full before:w-full before:bg-white before:transition-all peer-required:after:text-pink-500 peer-required:after:content-['\00a0*'] peer-valid:-top-2 peer-valid:text-xs peer-focus:-top-2 peer-focus:text-xs peer-focus:text-teal-500 peer-disabled:cursor-not-allowed peer-disabled:text-slate-400 peer-disabled:before:bg-transparent">--}}
{{--                    Select an option--}}
{{--                </label>--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                     class="pointer-events-none absolute top-2.5 right-2 h-5 w-5 fill-slate-400 transition-all peer-focus:fill-teal-500 peer-disabled:cursor-not-allowed"--}}
{{--                     viewBox="0 0 20 20" fill="currentColor" aria-labelledby="title-04 description-04"--}}
{{--                     role="graphics-symbol">--}}
{{--                    <title id="title-04">Arrow Icon</title>--}}
{{--                    <desc id="description-04">Arrow icon of the select list.</desc>--}}
{{--                    <path fill-rule="evenodd"--}}
{{--                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"--}}
{{--                          clip-rule="evenodd"/>--}}
{{--                </svg>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <div class="relative">--}}
{{--                    <textarea id="id-l01" type="text" name="id-l01" wire:model="body"  rows="3" placeholder="Write your message"--}}
{{--                  class="relative w-full p-4 placeholder-transparent transition-all border rounded outlin   e-none focus-visible:outline-none peer border-slate-200 text-slate-500 autofill:bg-white invalid:border-pink-500 invalid:text-pink-500 focus:border-teal-500 focus:outline-none invalid:focus:border-pink-500 disabled:cursor-not-allowed disabled:bg-slate-50 disabled:text-slate-400"></textarea>--}}
{{--                    <label for="id-l01"--}}
{{--                           class="cursor-text peer-focus:cursor-default  absolute left-2 -top-2 z-[1] px-2 text-xs text-slate-400 transition-all before:absolute before:top-0 before:left-0 before:z-[-1] before:block before:h-full before:w-full before:bg-white before:transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-base peer-required:after:text-pink-500 peer-required:after:content-['\00a0*'] peer-invalid:text-pink-500 peer-focus:-top-2 peer-focus:text-xs peer-focus:text-teal-500 peer-invalid:peer-focus:text-pink-500 peer-disabled:cursor-not-allowed peer-disabled:text-slate-400 peer-disabled:before:bg-transparent">--}}
{{--                        Body--}}
{{--                    </label>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--            <div class="flex justify-end gap-3">--}}
{{--                <!-- Component: Large primary basic button -->--}}
{{--                <button--}}
{{--                    class="inline-flex items-center justify-center h-12 gap-2 px-6 text-sm font-medium tracking-wide--}}
{{--                    text-white transition duration-300 rounded focus-visible:outline-none whitespace-nowrap--}}
{{--                    bg-teal-500 hover:bg-teal-600 focus:bg-teal-700 disabled:cursor-not-allowed disabled:border-teal-300--}}
{{--                    disabled:bg-teal-300 disabled:shadow-none" type="submit">--}}
{{--                    <span>Submit</span>--}}
{{--                </button>--}}
{{--                <!-- End Large primary basic button -->--}}
{{--            </div>--}}
{{--        </form>--}}
            <!-- End Rounded base basic select -->
            <!-- End Rounded large input with helper text-->
            <!-- End Rounded invalid input -->

            {{--            <x-select label="Category" wire:model="category_id" placeholder="Select a category" :options="$categories" />--}}

            {{--            <x-textarea label="Body" wire:model="body" rows="5" @keydown.meta.enter="$wire.save()" />--}}

            {{--            <x-slot:actions>--}}
            {{--                <x-button label="Cancel" link="/" />--}}
            {{--                <x-button label="Create" type="submit" icon="o-paper-airplane" class="btn-primary" spinner="save" />--}}
            {{--            </x-slot:actions>--}}


    </div>
</div>
