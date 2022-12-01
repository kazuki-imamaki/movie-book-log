<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MovieBookLog</title>
</head>

<body>
    @foreach ($wantMovies as $wantMovie)
        <p>{{ $wantMovie->title }}</p>
    @endforeach
</body>

</html>
