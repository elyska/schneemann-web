<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield("title")</title>

    <link href="/style/style.css" type="text/css" rel="stylesheet" />
    <link href="/style/navigation.css" type="text/css" rel="stylesheet" />

    </head>
<body>

<header>
    <nav>
    </nav>
</header>

@yield("content")

</body>
</html>
