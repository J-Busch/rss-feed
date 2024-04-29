<x-layout>
    <div class="bg-gray-800 px-8 pt-6 pb-6 mb-10 card">
        <h1 class="text-3xl text-white mb-5 font-bold">Your Aggregate Feed</h1>
        @foreach ($feeds as $feed)
            @foreach($feed->channel->item as $item)
                @if ($loop->index < 5) 
                    <div class="flex flex-col md:flex-row items-center justify-start p-3 mb-5 text-white card bg-gray-700">
                        <div class="mr-5 mb-5 md:mb-0">
                            <a href="{{ $item->link }}" target="_blank"><img style="height: 100px" src="{{ $item->attributes()->img }}" /></a>
                        </div>
                        <div>
                            <h2 class="text-xl text-white hover:text-gray-200 mb-2 font-bold underline"><a target="_blank" href="{{ $item->link }}">{{ $item->title }}</a></h2>
                            <p class="mb-2">{{ \Carbon\Carbon::parse($item->pubDate)->format('m/d/Y h:i') }}</p>
                            <p>{{ $item->description }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>
</x-layout>