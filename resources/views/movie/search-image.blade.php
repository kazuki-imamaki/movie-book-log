<x-app-layout>
    @foreach ($results as $result)
        <div class="flex">
            @if (is_null($id))
                <form method="GET" action="{{ route('want.movie.add') }}">
                @else
                    <form method="GET" action="{{ route('want.movie.update.index', ['movieId' => $id]) }} ">
            @endif
            <input type="image" src="{{ $result['poster_path'] }}">
            <p>{{ $result['title'] }}</p>
            <input type="hidden" name="title" value="{{ $result['title'] }}">
            <input type="hidden" name="poster_path" value="{{ $result['poster_path'] }}">
            </form>
        </div>
    @endforeach
</x-app-layout>
