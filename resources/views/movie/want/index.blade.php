<x-app-layout>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-5 mx-auto">
            <div class="flex flex-wrap w-full">
                <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">Bucket</h1>
                    <div class="h-1 w-20 bg-blue-500 rounded"></div>
                </div>
            </div>
        </div>
        <div class="mb-5">
            <a href="{{ route('want.movie.add') }} ">投稿</a>
        </div>
    </section>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">

            <div class="flex flex-wrap -m-4">
                @foreach ($wantMovies as $wantMovie)
                    <div class="p-4 md:w-1/6">
                        <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                            <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{ $wantMovie->image }}"
                                alt="none">
                            <div class="px-6 py-3">
                                <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">MOVIE
                                </h2>
                                <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $wantMovie->title }}
                                </h1>
                                <p class="leading-relaxed mb-3 h-10">{{ $wantMovie->memo }}</p>
                                <div class="flex">
                                    <div>
                                        <a class="text-blue-500 inline-flex items-center mr-2 md:mb-2 lg:mb-0"
                                            href="{{ route('want.movie.update.index', ['movieId' => $wantMovie->id]) }} ">編集
                                            {{-- <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M5 12h14"></path>
                                            <path d="M12 5l7 7-7 7"></path>
                                        </svg> --}}
                                        </a>
                                    </div>
                                    <form action="{{ route('want.movie.delete', ['movieId' => $wantMovie->id]) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit">削除</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>
