@extends('admin.layouts.base')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Пользователи</a></li>
            <li class="breadcrumb-item active">Создать</li>
        </ol>
        <div class="row">
            <div class="col col-md-8 offset-md-2">
                <h2 class="page-header mb-3">Создать пользователя</h2>
                <div class="card">
                    <div class="card-block">
                        <form enctype="multipart/form-data" action="{{ route('admin.users.store') }}" method="post" class="form">
                            {!! csrf_field() !!}
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