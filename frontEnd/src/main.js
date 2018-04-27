// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import t_router from './router/index'
import wx from 'weixin-js-sdk'
import api from './api'
import axios from 'axios'
import util from './util'

Vue.config.productionTip = false;

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: {
    App
  },
  template: '<App/>'
})

//判断用户有没有关注,但是这个不生效啊！不知道是几个意思，等待后期维护
t_router.beforeEach((to, from, next) => {
  // util.check_if_follow();
  console.log('进入路由守卫')
  util.to_wx_config();
  next();
})