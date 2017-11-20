@extends('admin.layouts.base')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Пользователи</li>
        </ol>
        <h2 class="page-header mb-3 d-flex flex-row align-items-center">
            <div>Пользователи</div>
            <a href="{{ route('admin.users.create') }}" class="ml-auto btn btn-success btn-sm float-right">
                +
            </a>
        </h2>
        <div class="card">
            <div class="card-block">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Имя</th>
                                <th>E-mail</th>
                                <th>Роли</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-left align-middle">
                                        <img height="40px" class="rounded-circle" src="{{ asset($user->avatar) }}" alt="{{ $user->name }}">
                                    </td>
                                    <td class="align-middle">{{ $user->name }}</td>
                                    <td class="align-middle">{{ $user->email }}</td>
                                    <td class="align-middle">
                                        {{ $user->roles->implode('name', ',') }}
                                    </td>
                                    <td class="text-right align-middle">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">Редактировать</a>

                                        <form
                                            method="post"
                                            action="{{ route('admin.users.destroy', $user->id) }}"
                                            class="d-inline-block"
                                            onsubmit="return confirm('Точно удалить пользователя: {{ $user->email }}')"
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