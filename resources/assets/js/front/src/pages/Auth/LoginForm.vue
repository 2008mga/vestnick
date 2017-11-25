<template>
    <div class="login-form">
        <div class="container my-5">
            <div class="row">
                <div class="col-12 col-md-4 offset-md-4">
                    <h1 class="page-header d-inline-block">
                        Войти на сайт
                    </h1>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input
                            type="email"
                            id="email"
                            class="form-control-sm form-control"
                            v-model="credentials.username"
                        />
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input
                            type="password"
                            id="password"
                            class="form-control-sm form-control"
                            v-model="credentials.password"
                        />
                    </div>
                    <div class="form-group">
                        <button
                            class="btn btn-success btn-sm float-right"
                            @click="AuthAttempt()"
                        >Войти</button>
                    </div>
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
              console.log(req.data);
            })
            .catch((e) => {
              console.log(e);
            })
        }
      }
    }
</script>