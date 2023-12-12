<?php

use Livewire\Volt\Component;

new class extends Component {

}; ?>
    <!-- Component: Rounded large size basic textarea -->
<div>
    <div class="relative">
        <textarea id="id-l01" type="text" name="id-l01" rows="3" placeholder="Write your message"
                  class="relative w-full p-4 placeholder-transparent transition-all border rounded outline-none focus-visible:outline-none peer border-slate-200 text-slate-500 autofill:bg-white invalid:border-pink-500 invalid:text-pink-500 focus:border-teal-500 focus:outline-none invalid:focus:border-pink-500 disabled:cursor-not-allowed disabled:bg-slate-50 disabled:text-slate-400"></textarea>
        <label for="id-l01"
               class="cursor-text peer-focus:cursor-default  absolute left-2 -top-2 z-[1] px-2 text-xs text-slate-400 transition-all before:absolute before:top-0 before:left-0 before:z-[-1] before:block before:h-full before:w-full before:bg-white before:transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-base peer-required:after:text-pink-500 peer-required:after:content-['\00a0*'] peer-invalid:text-pink-500 peer-focus:-top-2 peer-focus:text-xs peer-focus:text-teal-500 peer-invalid:peer-focus:text-pink-500 peer-disabled:cursor-not-allowed peer-disabled:text-slate-400 peer-disabled:before:bg-transparent">
            Write your message
        </label>
    </div>
    <div class="flex justify-end gap-3">
        <!-- Component: Large primary basic button -->
        <button class="inline-flex items-center justify-center h-12 gap-2 px-6 text-sm font-medium tracking-wide text-white transition duration-300 rounded focus-visible:outline-none whitespace-nowrap bg-teal-500 hover:bg-teal-600 focus:bg-teal-700 disabled:cursor-not-allowed disabled:border-teal-300 disabled:bg-teal-300 disabled:shadow-none">
            <span>Submit</span>
        </button>
        <!-- End Large primary basic button -->
    </div>
</div>
<!-- End Rounded large size basic textarea -->
