<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
            {{--<span class="navbar-toggler-icon"></span>--}}
        {{--</button>--}}
        <div>
            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item">
                        <a href="{{ route('my_page_index') }}">
                            <img src="{{ Auth::user()->avatar }}" class="rounded-circle twitter-avatar-size-small"/>
                        </a>
                    </li>
                @endauth
                @guest
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="{{ route('my_page_create') }}">クイズ作成</a>--}}
                    {{--</li>--}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth_twitter') }}">ログイン</a>
                    </li>
                @endguest

                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link" href="#">ログイン</a>--}}
                {{--</li>--}}
            </ul>
        </div>
    </div>
</nav>