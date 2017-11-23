{!! form_bind(isset($tag) ? $tag : null) !!}
    <div class="form-group {{ $errors->has('name') ? 'has-danger' : '' }}">
        <input
            type="text"
            name="name"
            class="form-control"
            placeholder="Название тега"
            value="{{ form_old('name') }}"
            {{ isset($tag) ? 'readonly' : '' }}
        />
    </div>
    <div class="form-group {{ $errors->has('description') ? 'has-danger' : '' }}">
        <input
                type="text"
                name="description"
                class="form-control"
                placeholder="Небольшое описание"
                value="{{ form_old('description') }}"
        />
    </div>
    <div class="form-group form-group-sm mt-3">
        <input type="file" name="image" data-value="{{ asset(form_old('image') ? form_old('image') : '') }}">
        <small class="d-block text-center mt-2 mb-2">Для обновления / добавления нажмите или перетащите на изображение </small>
    </div>
    <div class="form-group">
        <div id="cp5" class="input-group colorpicker-component" title="Using format option">
            <input
                type="text"
                class="form-control input-lg"
                value="{{ form_old('additional_color') }}"
                placeholder="Выбрать цвет ->"
                name="additional_color"
            />
            <span class="input-group-addon"><i></i></span>
        </div>
        <span class="small d-block text-center mt-2 mb-2">Оставте пустым будет использоваться цвет по-умолчанию</span>
    </div>
    <div class="form-group mb-0">
        <button class="btn btn-success btn-block">Создать</button>
    </div>
{!! form_unbind() !!}