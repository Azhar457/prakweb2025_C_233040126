<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Daftar Posts</title>
</head>
<body>
    <h1>Daftar Posts</h1>
    
    @foreach ($posts as $posts)
        <article>
            <h2><a href="/posts/{{ $posts->slug }}">{{ $posts->title }}</a></h2>
            <p>{{ $posts->excerpt }}</p>
        </article>
        
    @endforeach
</body>
</html>