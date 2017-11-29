import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

export const store = new Vuex.Store({
  state: {
    auth: {
      isLoggedIn: false,
      username: null,
      avatar: null,
      name: null
    },
    pending: false
  },
  getters: {
    authCheck: (state) => {
      return state.auth.isLoggedIn;
    },
    authUser: (state) => {
      return {
        'username': state.auth.username,
        'avatar': state.auth.avatar,
        'name': state.auth.name
      }
    }
  },
  mutations: {
    makeSignIn (state, credentials) {
      this._vm.$cookie.set('auth.accessToken', credentials.access_token);
      Vue.set(state.auth, 'isLoggedIn', true);
    },
    makeSignOut (state) {
      this._vm.$cookie.delete('auth.accessToken');
      Vue.set(state.auth, 'isLoggedIn', false);
    },
    userData (state, data) {
      Vue.set(state.auth, 'username', data.email);
      Vue.set(state.auth, 'avatar', data.avatar);
      Vue.set(state.auth, 'name', data.name);
    }
  }
});