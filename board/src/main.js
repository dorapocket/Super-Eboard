import Vue from 'vue'
import './plugins/axios'
import App from './App.vue'
import router from './router'
import './registerServiceWorker'
import vuetify from './plugins/vuetify'
import store from './store/index'

axios.defaults.baseURL = 'https://wx.lgyserver.top';
axios.defaults.headers.post['Content-Type'] = 'application/json';
Vue.config.productionTip = false;
Vue.directive('focus', {
  // 当被绑定的元素插入到 DOM 中时……
  inserted: function (el) {
  // 聚焦元素
  el.focus()
  }
});

new Vue({
  store,
  router,
  vuetify,
  render: h => h(App)
}).$mount('#app')
