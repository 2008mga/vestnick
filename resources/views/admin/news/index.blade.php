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

        <div class="card">
            <div class="card-block">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Короткое названи</th>
                                <th>Автор</th>
                                <th>Приватная</th>
                                <th>Показывать автора</th>
                                <th>Теги</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($news as $new)
                                <tr>
                                    <td>{{ $new->short_name }}</td>
                                    <td>{{ $new->user->email }}</td>
                                    <td>
                                        <span class="badge badge-pill badge-{{ $new->is_private ? 'success' : 'danger' }}">
                                            {{ $new->is_private ? 'Да' : 'Нет' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-{{ $new->display_author ? 'success' : 'danger' }}">
                                            {{ $new->display_author ? 'Да' : 'Нет' }}
                                        </span>
                                    </td>
                                    <td>
                                        @foreach($new->tags()->get() as $tag)
                                            <a href="{{ route('admin.tags.edit', $tag->id) }}" class="badge badge-default">{{ $tag->name }}</a>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.news.edit', $new->id) }}" class="btn btn-sm btn-primary">Редактировать</a>

                                        <form
                                                method="post"
                                                action="{{ route('admin.news.destroy', $new->id) }}"
                                                class="d-inline-block"
                                                onsubmit="return confirm('Точно удалить новость: {{ $new->short_name }}')"
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