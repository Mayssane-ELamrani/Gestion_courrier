<button {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md shadow-sm hover:bg-gray-300']) }}>
    {{ $slot }}
</button>
