<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping</title>
    
    @yield('styles')
    
    <link rel="stylesheet" href="/css/mainstyles.css">
</head>
<body>
<header class="header">
    <h1 class="today_date_userinfo">
        @if(Auth::check())
        <span class="welcome_user">ようこそ" {{Auth::user()->name}} "さん</span>
        @else
        <span class="welcome_nuser"><a href="/shopping/nusers/login">ログイン</a>・<a href="/shopping/nusers/register">会員登録</a>をして買い物をしよう</span>
        @endif
        <br>
        <p class="today_date">本日は、<span id="view_today"></span>
        <script type="text/javascript">
            document.getElementById("view_today").innerHTML = getToday();

            function getToday() {
	            var now = new Date();
	            var year = now.getFullYear();
	            var mon = now.getMonth()+1; 
            	var day = now.getDate();
            	var you = now.getDay(); 
	            var youbi = new Array("日","月","火","水","木","金","土");
	            var s = year + "年" + mon + "月" + day + "日 (" + youbi[you] + ")";
	            return s;
            }
        </script>
        
        </p>
    </h1>
    <div class="products_search">
            <form action="/shopping/search_result/1" method="POST">
            @csrf
                <input class="search_text" name="keyword" placeholder="キーワードを入力" type="text">
                <input class="search_buttom" class="fas" type="submit" value="検索">
            </form>
    </div>
    <h1 class="main_title">
        <span class="main_title_text">Shopping</span>
        <div class="title">
            <span class="title_text">@yield('title')</span>
        </title>
    </h1>

    @if(Auth::check())
    <ul class="user_head">
        <li class="logout"><a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span class="logout_text">ログアウト</span></a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form></li>

        <li class="register"><a href="/shopping/users/cart"><span class="register_text">カート</class></a></li>
    </ul>
    @else
    <ul class="user_head">
        <li class="login"><a href="{{route('shopping.login')}}"><span class="login_text">ログイン</span></a></li>
        <li class="register"><a href="{{route('shopping.register')}}"><span class="register_text">会員登録</class></a></li>
    </ul>
    @endif
</header>
<main class="main">
    
        <div class="left_main">
            <h1 class="products_members"><商品について></h1>
            <ul class="products_members_info">
                <li><a href="{{route('shopping.index',['id'=> 0])}}">おすすめ</a></li>
                <li><a href="{{route('shopping.index',['id'=> 1])}}">男性向け</a></li>
                <li><a href="{{route('shopping.index',['id'=> 2])}}">女性向け</a></li>
                <li><a href="{{route('shopping.index',['id'=> 3])}}">ギフト</a></li>
            </ul>
            @if(Auth::check())
            <h1 class="products_members"><会員情報></h1>
            <ul class="products_members_info">
                <li><a href="/shopping/users/userinfo">登録情報</a></li>
                <li><a href="/shopping/users/cash">支払い方法</a></li>
                <li><a href="/shopping/users/cart">カートを見る</a></li>
                <li><a onclick="document.getElementById('logout-form').submit();">ログアウト</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                </form></li>
            </ul>
            @else
            <h1 class="products_members"><会員について></h1>
            <ul class="products_members_info">
                <li><a href="/shopping/nusers/member">会員とは</a></li>
                <li><a href="{{route('shopping.register')}}">会員登録</a></li>
                <li><a href="{{route('shopping.login')}}">ログイン</a></li>
            </ul>
            @endif
        </div>
        <div class="center_main">
            <span class="subtitle_text">@yield('subtitle')</span>
            @yield('content')
        </div>

</main>

</body>
</html>
