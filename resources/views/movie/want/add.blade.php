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
        <p>投稿フォーム</p>
        <form action="{{ route('want.movie.create') }}" method="post">
            @csrf
            <label for="tweet-content">タイトル</label>
            <textarea id="movie-title" type="text" name="title" placeholder="タイトルを入力"></textarea>
            @error('title')
                <p style="color: red;">{{ $message }}</p>
            @enderror
            <button type="submit">保存</button>
        </form>
    </div>
</body>

</html>
