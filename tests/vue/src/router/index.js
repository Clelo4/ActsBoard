import Vue from 'vue'
import Router from 'vue-router'
import ManageLogin from '@/pages/Manage/ManageLogin'
import ManageSignup from '@/pages/Manage/ManageSignup'
import ManageMain from '@/pages/Manage/ManageMain'
import ManageAddActivities from '@/pages/Activities/ManageAddActivities'
import ManageShowActs from '@/pages/Activities/ManageShowActs'
import ManageShowActInfo from '@/pages/Activities/ManageShowActInfo'
import Home from '@/pages/Home/Home'
Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '/manage/login',
      name: 'ManageLogin',
      component: ManageLogin
    },
    {
      path: '/manage/signup',
      name: 'ManageSignup',
      component: ManageSignup
    },
    {
      path: '/manage/main',
      name: 'ManageMain',
      component: ManageMain
    },
    {
      path: '/manage/addact',
      name: 'ManageAddActivities',
      component: ManageAddActivities
    },
    {
      path: '/manage/getacts',
      name: 'ManageShowActs',
      component: ManageShowActs
    },
    {
      path: '/manage/getactInfo',
      name: 'ManageShowActInfo',
      component: ManageShowActInfo
    }

  ]
})
