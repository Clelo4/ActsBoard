<template>
<div>
    <tabbar>
      <!-- 提供show-dot，selected link属性，badge属性 -->
      <tabbar-item selected link="/component/activities">
        <img slot="icon" src="../assets/demo/icon_nav_msg.png">
        <span slot="label">活动大厅</span>
      </tabbar-item>
      <tabbar-item selected link="/component/choice">
        <img slot="icon" src="../assets/demo/icon_nav_article.png">
        <span slot="label">精选活动</span>
      </tabbar-item>
      <tabbar-item selected link="/component/publishAndSetting">
        <img slot="icon" src="../assets/demo/icon_nav_cell.png">
        <span slot="label">其他</span>
      </tabbar-item>
    </tabbar>
  </div>
</template>

<script>
import { Tabbar, TabbarItem, Group, Cell } from 'vux'
export default {
  components: {
    Tabbar,
    TabbarItem,
    Group,
    Cell
  },
  name: 'tab',
  data () {
    return {
      // some data
    }
  },
  methods:{
    //todo
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>