<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Daftar Posts</title>
</head>
<body>
    <h1>Daftar Kategori</h1>
    
    @foreach ($category as $category)
        <article>
            <h2><a href="/categories/{{ $category->name }}">{{ $category->name }}</a></h2>
        </article>
        
    @endforeach
</body>
</html>