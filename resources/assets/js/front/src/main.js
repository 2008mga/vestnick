// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import '%/app.scss'
import { Nav, Navbar, Button, Form, FormInput, Media } from 'bootstrap-vue/es/components';
import VueProgressiveImage from 'vue-progressive-image'

Vue.use(VueProgressiveImage)


Vue.use(Nav);
Vue.use(Navbar);
Vue.use(Button);
Vue.use(Form);
Vue.use(FormInput);
Vue.use(Media);


Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
