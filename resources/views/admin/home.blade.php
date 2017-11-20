@extends('admin.layouts.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-4">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">
                        Пользователи
                    </h4>
                    <dl class="row mb-0">
                        <dt class="col-sm-3 col-3">Всего</dt>
                        <dd class="col-sm-9 col-9 text-right">
                            <span class="badge badge-pill badge-warning">
                            {{ App\User::query()->count() }}
                            </span>
                        </dd>
                        <dt class="col-sm-3 col-3">Ролей</dt>
                        <dd class="col-sm-9 col-9 text-right">
                            <span class="badge badge-pill badge-warning">
                                {{ App\Role::query()->count() }}
                            </span>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection