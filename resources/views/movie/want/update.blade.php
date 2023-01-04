<x-app-layout>

    {{-- <body>
        <div>
            <a href="{{ route('want.movie.index') }}">戻る</a>
            <p>投稿フォーム</p>
            @if (session('feedback.success'))
                <p style="color: green">{{ session('feedback.success') }}</p>
            @endif

            <form action="{{ route('want.movie.update.put', ['movieId' => $wantMovie->id]) }}" method="post">
                @method('PUT')
                @csrf
                <label for="tweet-content">タイトル</label>
                <textarea id="movie-title" type="text" name="title" placeholder="タイトルを入力">{{ $wantMovie->title }}</textarea>
                @error('title')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
                <button type="submit">編集</button>
            </form>
        </div>
    </body> --}}

    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-24 mx-auto">
            @if (session('feedback.success'))
                <p style="color: green">{{ session('feedback.success') }}</p>
            @endif
            <div class="flex flex-col text-center w-full mb-12">
                <a href="{{ route('want.movie.index') }}">戻る</a>
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">編集</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Whatever cardigan tote bag tumblr hexagon brooklyn
                    asymmetrical gentrify.</p>
            </div>
            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                <form method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $wantMovie['id'] }}">
                    <div class="flex flex-wrap -m-2">
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="title" class="leading-7 text-sm text-gray-600">Title</label>
                                @error('title')
                                    <p style="color: red;">{{ $message }}</p>
                                @enderror
                                <input value="{{ $wantMovie['title'] }}" type="text" id="movie-title" name="title"
                                    placeholder="タイトルを入力"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                <button type="submit" formaction="{{ route('want.movie.search') }}">検索</button>
                            </div>
                        </div>
                        <div>
                            <img src="{{ $wantMovie['image'] }}">
                            <input type="hidden" value="{{ $wantMovie['image'] }}" name="image">
                        </div>
                        <div class="p-2 w-full">
                            <div class="relative">
                                <label for="message" class="leading-7 text-sm text-gray-600">Memo</label>
                                <textarea id="movie-memo" name="memo" placeholder="メモを入力"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $wantMovie['memo'] }}</textarea>
                            </div>
                        </div>
                        <div class="p-2 w-full">
                            <button type="submit"
                                formaction="{{ route('want.movie.update.put', ['movieId' => $wantMovie['id']]) }}"
                                class="flex mx-auto text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Button</button>
                            {{-- @method('PUT') --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
