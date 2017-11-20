@extends('admin.layouts.base')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Пользователи</a></li>
            <li class="breadcrumb-item active">{{ $user->email }}</li>
            <li class="breadcrumb-item active">Редактирование</li>
        </ol>
        <div class="row">
            <div class="col col-md-8 offset-md-2">
                <h2 class="page-header mb-3">Обновить информацию</h2>
                <p class="d-block">{{ $user->email }}</p>
                <div class="card">
                    <div class="card-block">
                        <form enctype="multipart/form-data" action="{{ route('admin.users.update', $user->id) }}" method="post" class="form">
                            {!! csrf_field() !!}
                            {!! method_field('PUT') !!}
                            <div class="row">
                                @include('admin.users._fields')
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection