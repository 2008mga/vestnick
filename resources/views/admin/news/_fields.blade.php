{!! form_bind(isset($news) ? $news : null) !!}
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

{{--
    TODO: add tags
--}}

{{--<div class="form-group">--}}
    {{--<label>Теги</label>--}}

    {{--<select class="selectized" name="tags[]" multiple>--}}
        {{--<option value="1">test</option>--}}
        {{--<option value="2">test</option>--}}
        {{--<option value="3">test</option>--}}
    {{--</select>--}}
{{--</div>--}}

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