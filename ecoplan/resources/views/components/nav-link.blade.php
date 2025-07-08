<!-- resources/views/components/nav-link.blade.php -->
<a href="{{ $href }}" 
   class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ $active 
        ? 'bg-gray-50 text-green-600' 
        : 'text-gray-700 hover:text-green-600 hover:bg-gray-50' }}">
    {{ $slot }}
</a>
