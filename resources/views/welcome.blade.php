<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css" />

</head>

<body>
    <main class="container">
        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="file_name" placeholder="File Name" aria-label="Text" />
            <input type="file" name="file" />
            <input type="submit" />
        </form>
    </main>
</body>

</html>
