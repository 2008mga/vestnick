<template>
    <div class="container mt-2">
        <div class="row">
            <div class="auth-form col-12 col-md-6 offset-md-3">
                <h3 class="header">Регистрация</h3>

                <hr>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password_repeat">Повторите пароль</label>
                    <input type="password" id="password_repeat" name="password_repeat" class="form-control">
                </div>
                <div class="form-group">
                    <label for="about">О нас</label>
                    <textarea name="about" id="about" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">
                        Создать
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
      name: 'register-form'
    }
</script>