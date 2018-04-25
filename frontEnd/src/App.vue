<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'App',
  data(){
    return {
      fullHeight: document.documentElement.clientHeight
    }
  },
  mounted(){
    const _this = this;

  }
}
</script>

<style lang="less">
@import '~vux/src/styles/reset.less';

body{
  background-color: #fbf9fe; 
  height:100vh;
}
#app{
  height: 100%;
}
</style>
