@extends('admin.layouts.base')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Новости</li>
        </ol>
        <h2 class="page-header mb-3 d-flex flex-row align-items-center">
            <div>Новости</div>
            <a href="{{ route('admin.news.create') }}" class="ml-auto btn btn-success btn-sm float-right">
                +
            </a>
        </h2>
    </div>
@endsection