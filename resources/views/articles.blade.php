<x-layout>
    <div class="bg-gray-800 px-8 pt-6 pb-6 mb-10 card">
        <div class="flex flex-col md:flex-row items-center justify-between mb-6">
            <h1 class="text-3xl mb-3 md:mb-0 text-white text-center md:text-left font-bold">Your Aggregate Feed</h1>
            <form method="GET" action="/articles">
                <div class="flex flex-col md:flex-row items-center">
                    <select id="sortby" name="sortby" type="select" class="bg-gray-50 border border-gray-300 text-gray-900 w-60 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 mb-3 md:mb-0 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="pub_date" <?= $sortby == 'pub_date' ? 'selected' : '' ?>>Date Published</option>
                        <option value="title" <?= $sortby == 'title' ? 'selected' : '' ?>>Title</option>
                    </select>
                    <select id="sortorder" name="sortorder" type="select" class="bg-gray-50 border border-gray-300 text-gray-900 w-60 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 mb-3 md:ml-3 md:mb-0 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="asc" <?= $sortorder == 'asc' ? 'selected' : '' ?>>Ascending</option>
                        <option value="desc" <?= $sortorder == 'desc' ? 'selected' : '' ?>>Descending</option>
                    </select>
                    <button class="bg-orange-500 hover:bg-orange-700 text-white font-bold w-full md:ml-3 mb-3 md:mb-0 py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Sort
                    </button>
                </div>
            </form>
        </div>

        @foreach($articles as $item)
        <div class="flex flex-col md:flex-row items-center justify-start p-3 mb-5 text-white card bg-gray-700">
            <div class="mr-5 mb-5 md:mb-0">
                <a href="{{ $item->link }}" target="_blank"><img style="height: 100px" src="{{ $item->image }}" /></a>
            </div>
            <div>
                <h2 class="text-xl text-white hover:text-gray-200 mb-2 font-bold underline"><a target="_blank" href="{{ $item->link }}">{{ $item->title }}</a></h2>
                <p class="mb-2">{{ \Carbon\Carbon::parse($item->pub_date)->format('m/d/Y g:i A') }}</p>
                <p>{{ $item->description }}</p>
            </div>
        </div>
        @endforeach

        @if ($articles->isEmpty())
        <h1 class="text-2xl text-white text-center font-bold">No articles available. <a class="underline" href="/feed">Try adding a feed.</a></h1>
        @endif

        <div>
            {{ $articles->links() }}
        </div>
    </div>
</x-layout>