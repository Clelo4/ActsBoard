<template>
  <div class="login">
    <el-form :model='form' label-width='80px'>
      <el-form-item label='用户名'>
        <el-input v-model='form.username'></el-input>
      </el-form-item>
      <el-form-item label='密码'>
        <el-input v-model='form.password'></el-input>
      </el-form-item>
      <el-form-item label='验证码'>
        <el-input v-model='form.verifyCode'></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="onSubmit">登录</el-button>
        <el-button>取消</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
export default {
  name: 'ManageLogin',
  components:{},
  data () {
    return {
      form: {
        username: '',
        password: '',
        verifyCode: '',
      },
      loginResponse:'',
    }
  },
  methods: {
    onSubmit() {
      axios.post('/manage/admin/login',this.form).then(
        (response)=>{
          console.log(response.data);
          if (response.data['errcode']!=0){
            this.loginResponse=response.data['errmsg'];
          } else {
            this.loginResponse=response.data['data'];
            this.$router.push({path:'/manage/main'});
          }
        }).catch((error)=>{
        $this.$message('网络错误,请重试');
      });
      console.log('submit!');
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
.login {
  color: #42b983;
  width: 20em;
  margin:0 auto;
  margin-top: 8em;
}
</style>
