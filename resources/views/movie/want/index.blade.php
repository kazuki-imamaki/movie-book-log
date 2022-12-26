<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MovieBookLog</title>
</head>

<body>
    <a href="{{ route('want.movie.add') }} ">投稿</a>
    @foreach ($wantMovies as $wantMovie)
        <p>{{ $wantMovie->title }}</p>
        <a href="{{ route('want.movie.update.index', ['movieId' => $wantMovie->id]) }} ">編集</a>
        <form action="{{ route('want.movie.delete', ['movieId' => $wantMovie->id]) }}" method="post">
            @method('DELETE')
            @csrf
            <button type="submit">削除</button>
        </form>
    @endforeach
</body>

</html>
