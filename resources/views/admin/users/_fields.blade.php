{{ form_bind(isset($user) ? $user : null) }}
<div class="col-12 col-md-6 form-group form-group-sm">
    <label>
        E-mail
    </label>
    <input
        type="email"
        name="email"
        class="form-control"
        placeholder="test@example.com"
        value="{{ form_old('email') }}"
    />
</div>

<div class="col col-md-6 form-group form-group-sm">
    <label>Имя</label>
    <input
        type="text"
        name="name"
        class="form-control"
        placeholder="Jony"
        value="{{ form_old('name') }}"
    />
</div>

<div class="col-12 col-md-12 form-group form-group-sm mt-3">
    <input type="file" name="avatar" data-value="{{ asset(form_old('avatar') ? form_old('avatar') : config('app.default_avatar')) }}">
    <small class="d-block text-center mt-2 mb-2">Для обновления / добавления нажмите или перетащите на изображение ваш аватар</small>
</div>

<div class="col-12 col-md-12 form-group form-group-sm">
    <label>Пароль</label>
    <input type="password" name="password" class="form-control" placeholder="12345" />
</div>

<div class="col-12 col-md-12 form-group-sm form-group">
    <label>Роли</label>
    <select name="roles[]" multiple>
        @foreach($roles as $key => $role)
            <option
                {{ (isset($user) && $user->isRole($role->name)) ? 'selected' : '' }}
                value="{{ $role->id }}"
                {{ (form_old('roles.' . $key)) ? 'selected' : '' }}
            >{{ $role->name }}</option>
        @endforeach
    </select>
    <small class="text-muted d-block mt-0">Для предоставления всех превилегий достаточно выбрать admin</small>
</div>

<div class="col-12 col-md-12 form-group form-group-sm">
    <label>Пол</label>
    <select name="sex" name="sex">
        <option value="man" {{ form_old('sex') == 'man' ? 'selected' : '' }}>Мужчина</option>
        <option value="woman" {{ form_old('sex') == 'woman' ? 'selected' : '' }}>Женщина</option>
    </select>
</div>

<div class="col-12 col-md-12 form-group form-group-sm">
    <label>О себе</label>
    <textarea name="about" class="form-control" placeholder="Напиши немного о себе">{{ form_old('about') }}</textarea>
</div>

<div class="col-12 col-md-12 form-group form-group-sm mb-0">
    <button
            type="submit"
            class="btn btn-sm float-right btn-primary"
    >
        Сохранить
    </button>
</div>

{{ form_unbind() }}