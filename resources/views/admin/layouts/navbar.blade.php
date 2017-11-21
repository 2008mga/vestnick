<div class="mb-3">
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ route('admin.home') }}">
                {{ env('APP_NAME') . ' | ' }}
                <small>Admin panel</small>
           </a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{ \Route::currentRouteName() === 'admin.home' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.home') }}">Главная</a>
                    </li>
                    <li class="nav-item {{ \Request::is('admin/users*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">Пользователи</a>
                    </li>
                    <li class="nav-item {{ \Request::is('admin/news*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.news.index') }}">Новости</a>
                    </li>
                    <li class="nav-item {{ \Request::is('admin/tags*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.tags.index') }}">Теги</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Настройки</a>
                    </li>
                </ul>

                <ul class="navbar-nav navbar-right">
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <img class="user-avatar mini rounded-circle" src="{{ asset(\Auth::user()->avatar) }}" alt="">
                            {{ \Auth::user()->name }} &#8628;
                       </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @if(\Session::has('success'))
        <div class="alert-success p-3">
            <div class="container">
                {{ \Session::get('success') }}
            </div>
        </div>
    @endif

    @if(\Session::has('danger'))
        <div class="alert-danger p-3">
            <div class="container">
                {{ \Session::get('danger') }}
            </div>
        </div>
    @endif

    @if($errors->has(null))
        <div class="bg-danger p-3">
            <div class="container">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
    @endif
</div>