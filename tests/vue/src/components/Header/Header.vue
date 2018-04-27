<template>
  <div class='header'>
    <el-menu
      :default-active="activeIndex2"
      class="el-menu-demo"
      mode="horizontal"
      router
      @select="handleSelect"
      background-color="#545c64"
      text-color="#fff"
      active-text-color="#ffd04b"
    >
      <el-menu-item index="/">ActsBoard</el-menu-item>
      <el-menu-item index="/manage/login">登录</el-menu-item>
      <el-menu-item index="/manage/signup">注册</el-menu-item>
      <el-menu-item @click="loginout">登出</el-menu-item>
      <el-menu-item index="/manage/getacts">查看活动</el-menu-item>
      <el-menu-item index="/manage/addact">添加活动</el-menu-item>
    </el-menu>
    <div class="line"></div>  
  </div>
</template>

<script>
export default {
  name:'Header',
  data () {
    return {
      activeIndex: '2',
      activeIndex2: '1'
    }
  },
  methods: {
    handleSelect (key, keyPath) {
      // this.$router.push({ path: key })
    },
    loginout(){
      axios.post("/manage/admin/logout").then((response)=>{
        if (response.data['errcode']!=0){
          this.$message('登出失败');
        } else{
          this.$message('登出成功');
        }
      }).catch((error)=>{
        this.$message("登出失败");
      })
    }
  }
}

</script>

<style scoped>

</style>

