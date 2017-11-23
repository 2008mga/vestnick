@extends('admin.layouts.base')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Теги</li>
        </ol>
        <h2 class="page-header mb-3 d-flex flex-row align-items-center">
            <div>Теги</div>
            <a href="{{ route('admin.tags.create') }}" class="ml-auto btn btn-success btn-sm float-right">
                +
            </a>
        </h2>

        <div class="card">
            <div class="card-block">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th>Имя</th>
                            <th>Цвет</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($tags as $tag)
                                <tr>
                                    <td>{{ $tag->name }}</td>
                                    <td>{{ $tag->additional_color }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-sm btn-primary">Редактировать</a>
                                        <form
                                                method="post"
                                                action="{{ route('admin.tags.destroy', $tag->id) }}"
                                                class="d-inline-block"
                                                onsubmit="return confirm('Точно удалить тег: {{ $tag->name }}')"
                                        >
                                            {!! method_field('DELETE') !!}
                                            {!! csrf_field() !!}
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                &times;
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection