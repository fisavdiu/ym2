<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center h-10 gap-2 px-5 text-sm font-medium tracking-wide text-white transition duration-300 rounded focus-visible:outline-none whitespace-nowrap bg-brand-500 hover:bg-brand-600 focus:bg-brand-700 disabled:cursor-not-allowed disabled:border-brand-300 disabled:bg-brand-300 disabled:shadow-none']) }}>
    {{ $slot }}
</button>
