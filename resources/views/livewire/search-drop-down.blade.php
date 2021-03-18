<div class="relative mt-3 md:mt-0" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <input wire:model.debouce.500ms="search" type="text" class="bg-gray-800 text-sm rounded-full w-64 pl-8 py-1 focus:outline-none focus:ring" placeholder="Search..." @focus="isOpen = true" @keydown="isOpen = true" @keydown.escape.window="isOpen = false" @keydown.shift.tab="isOpen = false" x-ref="search" @keydown.window="
        if (event.keyCode == 191) {
            event.preventDefault();
            $refs.search.focus();
        }
    " />

    <div class="absolute top-0 flex items-center h-full ml-2">
        <svg class="fill-current text-gray-100 w-4" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
    </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3"></div>

    @if (strlen($search) >= 2)
        <div class="z-50 absolute text-sm bg-gray-800 rounded w-64 mt-2" x-show.transition.opacity="isOpen">
            <ul>
                @forelse ($searchResults as $result)
                    <li class="border-b border-gray-700">
                        <a href="{{ route('movies.show', $result['id']) }}" class="block px-3 py-2 hover:bg-gray-700 flex items-center" @if ($loop->last) @keydown.tab="isOpen = false" @endif>
                            @if ($result['poster_path'])
                                <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="{{ $result['title'] }}" class="w-8">
                            @else
                                <img src="https://via.placeholder.com/50x75" alt="{{ $result['title'] }}" class="w-8">
                            @endif

                            <span class="ml-4">{{ $result['title'] }}</span>
                        </a>
                    </li>
                @empty
                    <li class="px-3 py-2">No results for "{{ $search }}"</li>
                @endforelse
            </ul>
        </div>
    @endif
</div>
