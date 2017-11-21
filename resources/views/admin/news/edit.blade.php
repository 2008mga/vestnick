@extends('admin.layouts.base')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">Новости</a></li>
            <li class="breadcrumb-item active">{{ $news->short_name }}</li>
            <li class="breadcrumb-item active">Редактирование</li>
        </ol>
        <h2 class="page-header mb-3">Обновить информацию</h2>
        <p class="d-block">{{ $news->full_name }}</p>
        <div class="card">
            <div class="card-block">
                <form id="new_form" data-method="put" action="{{ route('admin.news.update', $news->id) }}" class="form">
                    {!! csrf_field() !!}
                    @include('admin.news._fields')
                </form>
            </div>
        </div>
    </div>
@endsection