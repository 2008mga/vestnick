<template>
    <nav class="navbar navbar-toggleable-md navbar-light">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <router-link
                class="navbar-brand"
                href="#"
                :to="{ name: 'home' }"
            >Вестник</router-link>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <router-link
                        tag="li"
                        active-class="active"
                        :to="{ name: 'auth.signIn' }"
                        v-if="!$root.authCheck"
                        class="nav-item"
                    >
                        <a class="nav-link">Войти</a>
                    </router-link>
                    <router-link
                        tag="li"
                        active-class="active"
                        :to="{ name: 'auth.signUp' }"
                        v-if="!$root.authCheck"
                        class="nav-item"
                    >
                        <a class="nav-link btn btn-sm btn-outline-success">
                            Создать
                        </a>
                    </router-link>
                    <li class="nav-item" v-if="$root.authCheck">
                        <b-dropdown
                            text="Left align"
                            variant="default"
                            size="sm"
                            class="m-2"
                            right
                        >
                            <template slot="button-content">
                                {{ $root.authUser.username }}
                            </template>
                            <b-dropdown-item
                                @click="SignOut()"
                                href="#"
                            >Выход</b-dropdown-item>
                        </b-dropdown>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
  name: 'navbar',
  mounted() {
    console.log(this.$root.authCheck, 'isAuth');
  },
  methods: {
    SignOut() {
      this.$root.$emit('auth::logout', this.$root.$cookie.get('auth.accessToken'))
    }
  }
}
</script>
