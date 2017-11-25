// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import '%/app.scss'
import { Nav, Navbar, Button, Form, FormInput, Media } from 'bootstrap-vue/es/components';
import VueProgressiveImage from 'vue-progressive-image'
import { store } from './store';
import VueCookie from 'vue-cookie'
import { AuthResource } from './resources'

Vue.use(VueCookie);
Vue.use(VueProgressiveImage);
Vue.use(Nav);
Vue.use(Navbar);
Vue.use(Button);
Vue.use(Form);
Vue.use(FormInput);
Vue.use(Media);

Vue.config.productionTip = false;

function checkMiddleware(router, to, from, next) {
  const middlewares = {
    auth: router.app.$store.getters.authCheck && to.meta.auth,
    guest: !router.app.$store.getters.authCheck
  };

  let errors = false;

  if ('middleware' in to.meta) {
    for (let i = 0; i < to.meta.middleware.length; i++) {
      let check = to.meta.middleware[i];

      if(check in middlewares && !middlewares[check]) {
        console.log(middlewares[check], 'check');
        errors = true;
        break;
      }
    }
  }

  if (errors) {
    next('/');
  }

  next();
}

router.beforeEach((to, from, next) => {
  if (router.app.$cookie.get('auth.accessToken')) {
    const token = router.app.$cookie.get('auth.accessToken');
    const resource = new AuthResource();

    resource.Me(token)
      .then((req) => {
        router.app.$store.commit('makeSignIn', {
          access_token: router.app.$cookie.get('auth.accessToken')
        });

        router.app.$store.commit('userData', req.data);

        checkMiddleware(router, to, from, next);
      })
      .catch(() => {
        router.app.$store.commit('makeSignOut');
      });
  } else {
    checkMiddleware(router, to, from, next);
    router.app.$store.commit('makeSignOut');
  }


});


/* eslint-disable no-new */
new Vue({
  el: '#app',
  store,
  router,
  template: '<App/>',
  components: { App },
  mounted() {
    // this.$store.commit('makeSignOut');
    console.log(process.env);
    this.$on('auth::logout');
  },
  destroy() {
    this.$off('auth::logout');
  }
});
