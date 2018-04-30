<template>
  <div class="signup">
    <el-form :model='form' label-width='80px'>
      <el-form-item label='用户名'>
        <el-input v-model='form.username'></el-input>
      </el-form-item>
      <el-form-item label='密码'>
        <el-input v-model='form.password'></el-input>
      </el-form-item>
      <el-form-item label='邮箱'>
        <el-input v-model='form.email'></el-input>
      </el-form-item>
      <el-form-item label='手机号'>
        <el-input v-model='form.mobile'></el-input>
      </el-form-item>
      <el-form-item label='注册码'>
        <el-input v-model='form.register_code'></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="onSubmit">注册</el-button>
        <el-button>取消</el-button>
      </el-form-item>
    </el-form>
    <div>{{ signupResponse }}</div>
  </div>
</template>

<script>
export default {
  name: 'ManageSignup',
  components:{},
  data () {
    return {
      form: {
        username:"",
        password :"",
        email : "",
        mobile : "",
        register_code :"", // 注册码
      },
      signupResponse:'',
    }
  },
  methods: {
    onSubmit() {
      axios.post('/manage/admin/signup',this.form).then(
        (response)=>{
          console.log(response.data);
          if (response.data['errcode']!=0){
            this.signupResponse=response.data['errmsg'];
          } else {
            this.signupResponse=response.data['data'];
            this.$router.push({path:'/manage/login'});
          }
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
.signup {
  color: #42b983;
  width: 20em;
  margin:0 auto;
  margin-top: 8em;
}
</style>
