{{-- ヘッダー --}}
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>COACHETECH</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    @yield('css')
</head>

<body>
    <header>
        <a href="/" >
            <img src="{{ asset('storage/logo.svg') }}" alt="coachtech" class="header-logo">
        </a>
        <form action="{{ route('products.index') }}" method="get">
            <input type="text" name="query" placeholder="なにをお探しですか？"  value="{{ request('query') }}" class="search_form"/>
            <input type="hidden" name="tab" value="{{ request('tab', 'recommended') }}">
        </form>
        <ul class="header-link">
            @if (Auth::check())
                <li class="header-link-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <input class="logout-btn" type="submit" value="ログアウト">
                    </form>
                </li>
                <li class="header-link-item">
                    <a href="{{ route('showMypage') }}" class="mypage-btn">マイページ</a>
                </li>
                <li class="header-link-item">
                    <a href="/sell" class="sell-btn">出品</a>
                </li>
            @else
                <!-- 未認証ユーザー -->
                <li class="header-link-item">
                    <a href="/login" class="header-login-btn">ログイン</a>
                </li>
                <li class="header-link-item">
                    <a href="/login" class="mypage-btn">マイページ</a>
                </li>
                <li class="header-link-item">
                    <a href="/login" class="sell-btn">出品</a>
                </li>
            @endif
        </ul>
    </header>
    <main>
        @yield('content')
    </main>
</body>

</html>
