<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Quiz.make') }}
        </a>
        {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
            {{--<span class="navbar-toggler-icon"></span>--}}
        {{--</button>--}}
        <div>
            <ul class="navbar-nav ml-auto">
                {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="{{ route('create_quiz') }}">クイズ作成</a>--}}
                {{--</li>--}}
                @auth
                    <li class="nav-item">
                        <a href="{{ route('my_page_index') }}">
                            <img src="{{ Auth::user()->avatar }}" class="rounded-circle twitter-avatar-size-small"/>
                        </a>
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('twitter_login') }}">ログイン</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>