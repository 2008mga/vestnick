<template>
    <div>
        <nav class="navbar navbar-toggleable-md navbar-light">
            <div class="container">
                <a class="navbar-brand d-flex flex-column mx-auto" href="#">
                    <h2>Vestnic</h2>
                    <div class="d-block" v-if="authCheck">
                        <b-dropdown
                            id="ddown1"
                            :text="authUser.username"
                            class="m-md-2"
                            size="sm"
                            variant="outline-success"
                        >
                            <b-dropdown-item
                                size="sm"
                                @click="SignOut()"
                            >Выход</b-dropdown-item>
                        </b-dropdown>
                    </div>
                    <div class="d-block" v-else>
                        <router-link :to="{ name: 'auth.signIn' }">
                            Войти
                        </router-link>
                    </div>
                </a>
            </div>
        </nav>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'navbar',
  computed: {
    ...mapGetters([
      'authCheck',
      'authUser'
    ])
  },
  mounted() {
    console.log(this.authCheck);
  },
  methods: {
    SignOut() {
      this.$root.$emit('auth::logout')
    }
  }
}
</script>
