<?php

if (!function_exists('form_bind')) {
    function form_bind ($model = null) {
        $data = !$model ? old() : $model;
        config()->set('__form__bind', is_array($data) ? collect($data) : collect($data->toArray()));
    }
}

if (!function_exists('form_old')) {
    function form_old ($key, $default = null) {
        if (!config('__form__bind')) {
            return $default;
        }

        if (str_contains($key, '.')) {
            $keyExp = explode('.', $key);
            $keyDot = implode('.', array_slice($keyExp, 1));
            $key = array_first($keyExp);
        }

        /** @var \Illuminate\Support\Collection $result */
        $result = config('__form__bind')->get($key, $default);

        return is_array($result) && isset($keyDot) ? data_get($result, $keyDot, $default) : $result;
    }
}

if (!function_exists('form_unbind')) {
    function form_unbind () {
        config()->set('__form__bind', null);
    }
}