import Vue from 'vue'
import Router from 'vue-router'
import activities from '@/components/activities'
import activityDetail from '@/components/activityDetail'
import setting from '@/components/setting'
import selectSchool from '@/components/selectSchool'
import actPushing from '@/components/actPushing'
Vue.use(Router)

export default new Router({
  routes: [
    {
      // 这个逻辑以后可能会有坑，因为以后如果要做成朋友圈转发活动的话，如何将活动id传进来会比较麻烦
      path: '/activityDetail',
      name: 'activityDetail',
      component: activityDetail
    },
    {
      path: '/',
      name: 'activities',
      component: activities
    },
    {
      path:'/setting',
      name:'setting',
      component:setting
    },
    {
      path:'/selectSchool',
      name:'selectSchool',
      component:selectSchool
    },
    {
      path:'/actPushing',
      name:'actPushing',
      component:actPushing
    }
  ]
})
