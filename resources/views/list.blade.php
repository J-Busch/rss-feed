<x-layout>
    <div class="bg-gray-800 mb-10 card">
        <form method="POST" action="/feed" class="grow px-8 pt-6 pb-8 mb-4">
            @csrf
            <h1 class="text-3xl text-white mb-5 font-bold">Add an RSS Feed</h1>
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="url">
                        URL
                    </label>
                    <input name="url" id="url" type="text" placeholder="https://feeds.nbcnews.com/nbcnews/public/news" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <button class="bg-orange-500 hover:bg-orange-700 text-white font-bold w-full md:w-1/4 mt-7 py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Add
                    </button>
                </div>
                @error('url')
                <p class="px-3 mt-5 text-red-500 italic"> {{ $message }}</p>
                @enderror
            </div>
        </form>

        <div class="px-8 pt-6 pb-8 mb-4">
            @foreach ($list as $item)
            <div class="flex grow items-center justify-between p-3 mb-3 text-white card bg-gray-700">
                <p class="break-all">{{ $item['title'] }}: <br class="inline md:hidden" /> {{ $item['url'] }}</p>
                <form method="POST" action="/feed">
                    @csrf
                    @method('DELETE')

                    @error('feedId')
                    <p class="px-3 mt-5 text-red-500 italic"> {{ $message }}</p>
                    @enderror

                    <input class="hidden" name="feedId" id="feedId" type="number" value="{{ $item['id'] }}" />
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 ml-2 rounded focus:outline-none focus:shadow-outline" type="submit">Delete</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</x-layout>