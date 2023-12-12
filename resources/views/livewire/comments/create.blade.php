<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;
new class extends Component {
    public Post $post;

    #[Rule('required|min:5')]
    public ?string $body;

    public function save(): void
    {

        $comment = (new Comment())->fill($this->validate());
        $comment->author_id = auth()->user()->id;

        $this->post->comments()->save($comment);
//        $this->post->touch('');
//
        $this->reset('body');
        $this->dispatch('comment-done', $comment);
         }
}; ?>
    <!-- Component: Rounded large size basic textarea -->
<div>
{{--    <form wire:submit="save">--}}
{{--        <textarea placeholder="Reply..." wire:model="body" name="body" rows="3"--}}
{{--                  class="relative w-full p-4 placeholder-transparent transition-all border rounded--}}
{{--                  outline-none focus-visible:outline-none peer border-slate-200 text-slate-500 autofill:bg-white--}}
{{--                  invalid:border-pink-500 invalid:text-pink-500 focus:border-teal-500 focus:outline-none--}}
{{--                  invalid:focus:border-pink-500 disabled:cursor-not-allowed disabled:bg-slate-50--}}
{{--                  disabled:text-slate-400"></textarea>--}}

{{--        <div class="flex justify-end gap-3">--}}
{{--            <button type="submit" spinner="save"--}}
{{--                    class="inline-flex items-center justify-center h-12 gap-2 px-6 text-sm font-medium tracking-wide text-white transition duration-300 rounded focus-visible:outline-none whitespace-nowrap bg-teal-500 hover:bg-teal-600 focus:bg-teal-700 disabled:cursor-not-allowed disabled:border-teal-300 disabled:bg-teal-300 disabled:shadow-none">--}}
{{--                Submit--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--    @if (empty($body))--}}





    <form wire:submit="save" @keydown.meta.enter="$wire.save()">
        <textarea wire:model="body" name="body" >
        </textarea>
        <button class="btn-primary" type="submit"> Submit</button>
    </form>



{{--    @endif--}}

</div>
