<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'ml-2 mt-1 text-white inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150',
    'style' => 'background-color: #f82249; border-radius: 10px;']) }}>
    {{ $slot }}
</button>
