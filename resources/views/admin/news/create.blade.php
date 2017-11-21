@extends('admin.layouts.base')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">Новости</a></li>
            <li class="breadcrumb-item active">Создать</li>
        </ol>

        <h2 class="page-header mb-3">
            Создать новость
        </h2>

        <form action="{{ route('admin.news.store') }}" class="form" id="new_form">
            <div class="card">
                <div class="card-block">
                    @include('admin.news._fields')
                </div>
            </div>
        </form>
    </div>
@endsection