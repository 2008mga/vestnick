@extends('layouts.app')

@section('content')
    <div class="container-flex">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="{{ route('login') }}" class="form form-login" method="post">
                        <h2 class="page-header">{{ env('APP_NAME') }}</h2>
                        {!! csrf_field() !!}
                        <div class="form-group input-group-inputs {{ $errors->has('email') || $errors->has('password') ? 'has-error' : '' }}">
                            <input type="email" name="email" placeholder="E-mail" class="form-control" value="{{ old('email') }}" required>
                            <input type="password" name="password" placeholder="Пароль" class="form-control" required>
                            <small class="{{ $errors->has('password') ? 'text-warning' : '' }}">
                                {{ $errors->has('password') ? array_first($errors->get('password')) : '' }}
                            </small>
                            <small class="{{ $errors->has('email') ? 'text-warning' : '' }}">
                                {{ $errors->has('email') ? array_first($errors->get('email')) : '' }}
                            </small>
                        </div>
                        <div class="form-group form-group-sm text-right">
                            <button class="btn btn-primary btn-sm btn-block" type="submit">
                                Войти
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
