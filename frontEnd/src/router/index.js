import Vue from 'vue'
import Router from 'vue-router'
import activities from '@/components/activities'
import activityDetail from '@/components/activityDetail'
import setting from '@/components/setting'
import selectSchool from '@/components/selectSchool'
import actPushing from '@/components/actPushing'
Vue.use(Router)

export default new Router({
  // mode:'history',
  routes: [
    {
      
      path: '/activityDetail/:actid',
      name: 'activityDetail',
      component: activityDetail
    },
    {
      path: '/',
      // name:'setting',
      // component:setting
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
      path:'/actpushing',
      name:'actpushing',
      component:actPushing
    }
  ]
})
