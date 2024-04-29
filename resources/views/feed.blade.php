<x-layout>
    <div class="bg-gray-800 px-8 pt-6 pb-6 mb-10 card">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl text-white font-bold">Your Aggregate Feed</h1>
            <form method="GET" action="/feed">
                <div class="flex flex-row items-center">
                    <select id="sortby" name="sortby" type="select" class="bg-gray-50 border border-gray-300 text-gray-900 w-60 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" <?= !$sortby ? 'selected' : '' ?>>Select an option</option>
                        <option value="pubDate" <?= $sortby == 'pubdate' ? 'selected' : '' ?>>Date Published</option>
                        <option value="title" <?= $sortby == 'title' ? 'selected' : '' ?>>Title</option>
                    </select>
                    <button class="bg-orange-500 hover:bg-orange-700 text-white font-bold w-full ml-3 py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Sort
                    </button>
                </div>
            </form>
        </div>
        @foreach($items as $item)
            @if ($loop->index < 100) 
                <div class="flex flex-col md:flex-row items-center justify-start p-3 mb-5 text-white card bg-gray-700">
                    <div class="mr-5 mb-5 md:mb-0">
                        <a href="{{ $item->link }}" target="_blank"><img style="height: 100px" src="{{ $item->attributes()->img }}" /></a>
                    </div>
                    <div>
                        <h2 class="text-xl text-white hover:text-gray-200 mb-2 font-bold underline"><a target="_blank" href="{{ $item->link }}">{{ $item->title }}</a></h2>
                        <p class="mb-2">{{ $item->pubDate }}</p>
                        <p class="mb-2">{{ \Carbon\Carbon::parse($item->pubDate)->format('m/d/Y h:i') }}</p>
                        <p>{{ $item->description }}</p>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</x-layout>