@extends('admin.layouts.base')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.tags.index') }}">Теги</a></li>
            <li class="breadcrumb-item active">{{ $tag->name }}</li>
            <li class="breadcrumb-item active">Редактирование</li>
        </ol>
        <h2 class="page-header mb-3">Редактировать</h2>

        <div class="row">
            <div class="col-12 col-md-4 offset-md-4">
                <div class="card">
                    <div class="card-block">
                        <form action="{{ route('admin.tags.update', $tag->id) }}" method="post">
                            {!! csrf_field() !!}
                            {!! method_field('PUT') !!}
                            @include('admin.tags._fields')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection