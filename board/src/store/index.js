import Vue from 'vue'
import Vuex from 'vuex'
import state from './state'  //引用同目录下的state.js
import mutations from './mutations'  //引用同目录下的mutations.js

Vue.use(Vuex) //使用vuex插件

export default new Vuex.Store({
  state,
  mutations
})