<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield("title")</title>

    <link href="/style/style.css" type="text/css" rel="stylesheet" />
    <link href="/style/navigation.css" type="text/css" rel="stylesheet" />

    <!-- google icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
<header>
    <nav>
        <figure>
            <img src="/images/menu.svg" alt="Menu icon" />
        </figure>

        <figure>
            <img src="/images/close.svg" alt="Close icon" />
        </figure>


        <figure>
            <a href="/{{$language}}"><img src="/images/language.svg" alt="Logo" /></a>
        </figure>

        <!--<figure>
            <img src="/images/language.svg" alt="Translate" />
            <figcaption>
                <p>
                    @if($language == "cs")
                        CS
                    @endif
                    @if($language == "en")
                        EN
                    @endif
                </p>
            </figcaption>
        </figure>-->

        @if($language == "cs")

            <ul>
                <a href="/{{$language}}"><li>Domů</li></a>
                <a href="/{{$language}}/"><li>Crowdfunding</li></a>
                <a href="/{{$language}}/"><li>E-Shop</li></a>
                <a href="/{{$language}}/"><li>O studiu</li></a>
            </ul>
        @endif
        @if($language == "en")

            <ul>
                <a href="/{{$language}}"><li>Home</li></a>
                <a href="/{{$language}}/"><li>Crowdfunding</li></a>
                <a href="/{{$language}}/"><li>E-Shop</li></a>
                <a href="/{{$language}}/"><li>About Us</li></a>
            </ul>
        @endif

        @yield("language")


        <figure>
            <a href="/{{$language}}"><img src="/images/account.svg" alt="Log in" /></a>
        </figure>

    </nav>
</header>
    @yield("content")


<script type="module" src="/script/navigation.js"></script>

</body>
</html>
