{!! form_bind(isset($news) ? $news : null) !!}

<div class="form-group form-group-sm mt-3 new-ezdz">
    <input
        type="file"
        name="image"
        data-value="{{ asset(form_old('image') ? form_old('image') : config('app.default_avatar')) }}"
        width="100px"
        height="250px"
    >
    <small class="d-block text-center mt-2 mb-2">Для обновления / добавления нажмите или перетащите на изображение. Размер : 200x500</small>
</div>
<div class="form-group">
    <label>Короткое название</label>
    <input
        type="text"
        name="short_name"
        class="form-control"
        value="{{ form_old('short_name') }}"
    />
</div>

<div class="form-group">
    <label>Полное название</label>
    <input
        type="text"
        name="full_name"
        class="form-control"
        value="{{ form_old('full_name') }}"
    />
</div>

<div class="form-group">
    <label>Описание</label>
    <input
            type="text"
            name="description"
            class="form-control"
            value="{{ form_old('description') }}"
    />
</div>


{{--
    TODO: add tags
--}}

<div class="form-group">
    <label>Теги</label>

    <select class="selectized" name="tags[]" multiple>
        @foreach(\App\Tag::all() as $key => $tag)
            <option value="{{ $tag->id }}" {{ (form_old('tags.' . $key)) ? 'selected' : ''  }}>{{ $tag->name }}</option>
        @endforeach
    </select>
</div>

<hr>

<div class="row">
    <div class="col-12 col-md-6 text-center">
        <div class="form-group mb-md-0">
            <label>Показывать автора</label>
            <div>
                <input
                    type="checkbox"
                    name="display_author"
                    class="js-switch"
                    {{ isset($news) && form_old('display_author') ? 'checked' : ((!isset($news)) ? 'checked' : '') }}>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 text-center">
        <div class="form-group mb-md-0">
            <label>Приватная новость</label>
            <div>
                <input
                    type="checkbox"
                    name="is_private"
                    class="js-switch"
                    {{ form_old('is_private') ? 'checked' : '' }}
                >
            </div>
        </div>
    </div>
</div>

<hr>

<div class="form-group">
    <textarea id="new_content" name="text" class="tiny">
        {!! form_old('text') !!}
    </textarea>
</div>

<div class="form-group">
    <button class="btn btn-primary btn-sm" type="submit">
        Сохранить <small></small>
    </button>
</div>

{!! form_unbind() !!}