<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MovieBookLog</title>
</head>

<body>
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
</body>

</html>
