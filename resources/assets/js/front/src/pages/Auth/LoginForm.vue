<template>
    <div class="login-form container auth-form">
        <div class="row">
            <div class="auth-form col-12 col-md-6 offset-md-3">
                <h3 class="header">Войти на сайт</h3>
                <hr>
                <div v-if="errors" class="p-3 alert-danger mb-2" @click="errors = false">
                    {{ errors.message }}
                    <span class="close">&times;</span>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input
                        type="email"
                        id="email"
                        class="form-control"
                        v-model="credentials.username"
                    />
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input
                        type="password"
                        id="password"
                        class="form-control"
                        v-model="credentials.password"
                    />
                </div>
                <div class="form-group">
                    <button
                        class="btn btn-outline-success float-right"
                        @click="AuthAttempt()"
                    >Войти</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { AuthResource } from '@/resources'

    export default {
      name: 'loginForm',
      data() {
        return {
          resource: new AuthResource(),
          credentials: {
            grant_type: 'password',
            username: null,
            password: null,
            client_id: process.env.CLIENT_ID,
            client_secret: process.env.CLIENT_SECRET,
            scope: ''
          },
          errors: false
        }
      },
      methods: {
        AuthAttempt() {
          this.resource
            .signIn(this.credentials)
            .then((req) => {
              this.$store.commit('makeSignIn', req.data);
              this.$router.replace({ name: 'home' });
            })
            .catch((e) => {
                this.$set(this, 'errors', e.response.data);
            })
        }
      }
    }
</script>