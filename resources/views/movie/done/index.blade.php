<x-app-layout>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-5 mx-auto">
            <div class="flex flex-wrap w-full">
                {{-- <div class="lg:w-1/2 w-full mb-6 lg:mb-0"> --}}
                {{-- <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">Want to</h1> --}}
                <x-nav-link :href="route('want.movie.index')" :active="request()->routeIs('want.movie.index')">
                    {{ __('Want to') }}
                </x-nav-link>
                <x-nav-link :href="route('done.movie.index')" :active="request()->routeIs('done.movie.index')">
                    {{ __('Done') }}
                </x-nav-link>
                {{-- <div class="h-1 w-20 bg-blue-500 rounded"></div> --}}
                {{-- </div> --}}
            </div>
        </div>
        <div class="mb-5">
            <a href="{{ route('done.movie.add') }} ">投稿</a>
        </div>
    </section>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">

            <div class="flex flex-wrap">
                @foreach ($doneMovies as $doneMovie)
                    <div class="p-4 md:w-1/8 sm:w-1/4 min-h-50">
                        <form action="{{ route('done.movie.update.index', ['movieId' => $doneMovie->id]) }} "
                            method="get">
                            <div class=" border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                                <input type="image" class="lg:h-700 md:h-250 w-full object-cover object-center"
                                    src="{{ $doneMovie->image }}" alt="none">
                                <div class="px-6 py-3">
                                    <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">MOVIE
                                    </h2>
                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                                        {{ $doneMovie->title }}
                                    </h1>
                                    <p class="leading-relaxed mb-3 h-10">{{ $doneMovie->memo }}</p>
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $doneMovie->star)
                                            <span class="text-yellow-300">★</span>
                                        @else
                                            <span class="text-gray-300">★</span>
                                        @endif
                                    @endfor
                                    <p>{{ $doneMovie->date }}</p>
                                    <div class="flex">
                                        {{-- <div>
                                            <a class="text-blue-500 inline-flex items-center mr-2 md:mb-2 lg:mb-0"
                                                href="{{ route('want.movie.update.index', ['movieId' => $doneMovie->id]) }} ">編集
                                            </a>
                                        </div> --}}
                                        {{-- <form action="{{ route('want.movie.delete', ['movieId' => $doneMovie->id]) }}"
                                            method="post">
                                            @method('DELETE')
                                            @csrf --}}
                                        {{-- <button type="submit"
                                            formaction="{{ route('want.movie.delete', ['movieId' => $doneMovie->id]) }}">削除</button> --}}
                                        {{-- </form> --}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>
