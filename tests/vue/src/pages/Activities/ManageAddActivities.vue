<template>
  <div class="manageaddact">
    <el-form id='el_form_manageaddact' :model='form' label-width='100px'>
      <el-form-item label='活动名称'>
        <el-input v-model='form.name'></el-input>
      </el-form-item>
      <el-form-item label='信息时间'>
        <el-date-picker
        v-model="form.valid_date"
        label="活动信息有效期的截止时间"
        type="date"
        placeholder="活动信息有效期的截止时间"
        value-format="yyyy-MM-dd"
        >
        </el-date-picker>
      </el-form-item>
      <el-form-item label='学校'>
        <el-input v-model='form.school'></el-input>
      </el-form-item>
      <el-form-item label='活动标签'>
        <el-checkbox-group v-model="form.taglist"  :min="1" :max="3" >
          <el-checkbox-button  v-for="tag in tags" :label="tag" :key="tag">{{tag}}</el-checkbox-button>
        </el-checkbox-group>
      </el-form-item>
      <el-form-item label='活动内容'>
        <el-input
        v-model='form.act_detail'
        autosize
        placeholder="请输入内容"
        type="textarea"
        :rows="2">
        </el-input>
      </el-form-item>
      <br>
      <span class="">
        <span>上传图片</span>
        <img v-bind:src="lmodel">
        <input type="file" @change="tirggerFile($event)">
      </span>
      <div id="msg"></div>
      <br>
      <el-form-item>
        <el-button
        type="primary"
        @click="onSubmit"
        v-loading.fullscreen.lock="loadingfullscreen"
        >提交</el-button>
        <el-button @click="goToHome">取消</el-button>
      </el-form-item>
    </el-form>

  </div>
</template>

<script>

export default {
  name: 'ManageAddActivities',
  components:{},
  data () {
    return {
      form: {
        name:"",
        valid_date : "",
        school : "",
        taglist :[], // 
        act_detail:'',
        pic_url:'',
        litimg_url:'',
      },
      signupResponse:'',
      loadingfullscreen:false,
      fileList:[],
      lmodel:'',
      fileUploadResult:false,
      fileUploadState:0, // -1正在上传 0没有 1为成功上传
      tags:[]
    }
  },
  created:function(){
    this.tags=["比赛","文娱","公益","运动","社团招新","讲座","企业宣讲","其他"]; // 活动标签
  },
  methods: {
    
    onSubmit() {
      if(this.fileUploadState==-1){
        console.log('this.fileUploadState:',this.fileUploadState);
        this.$message('图片正在上传，请重新点击提交按钮!');
        return ;
      }
      if(this.form.taglist.length==0 || this.form.taglist.length > 3){
        this.$message('标签数量1~3');
        return ;
      }
      this.loadingfullscreen=true; // 全屏loading
      console.log('pic_url:',this.form.pic_url);
      axios.post('http://web.iamxuyuan.com/manage/activities/publish',this.form).then(
        (response)=>{
          console.log(response.status);
          if (response.data['errcode']!=0){
              this.$message(response.data['errmsg']);
              this.loadingfullscreen=false;
            } else {
              this.$message(response.data['data']);
              this.form.name="";
              this.form.valid_date = "";
              this.form.school = "";
              this.form.taglist =[]; // 
              this.form.act_detail='';
              this.form.pic_url='';
              this.loadingfullscreen=false;
            }
        }).catch((error) => {
          this.$message('添加失败');
          this.loadingfullscreen=false;
        });
      console.log('submit!');
    },

    goToHome(){
      this.$router.push({path:'/'});
    },

    // 移除上传文件
    beforeRemove(file, fileList) {
        return this.$confirm(`确定移除 ${ file.name }？`);
    },

    // --------------上文件到腾讯云cos------------------------------
    
    // 获取签名
    getAuthorization(options,callback){
      var method = (options.Method || 'get').toLowerCase(); // 获取
      var Key = options.Key || '';
      console.log('in getAuthorization');
      var xhr = new XMLHttpRequest();
      var data = {
          method: method,
          pathname: Key,
        };
      xhr.open('POST', window.cosAuthUrl, true);
      xhr.setRequestHeader('content-type', 'application/json');
      xhr.onload = function (e) {
          if (e.target.responseText === 'action deny') {
              alert('action deny');
          } else {
              callback(e.target.responseText);
          }
      };
      xhr.send(JSON.stringify(data));
    },
  
      // 上传文件
    uploadFile(file,callback){
            var Key = '/'+window.cosFilePath+'/' + window.cosFileName;
            console.log('here');  
            var _this = this;

            this.getAuthorization({Method: window.cosMethod, Key: Key}, function (auth) {
                console.log('getAuthorization');
                var url = window.cosUrl+'/'+window.cosFilePath+'/' + window.cosFileName; // 文件的绝对保存路径
                var xhr = new XMLHttpRequest();
                xhr.open(window.cosMethod, url, true);
                xhr.setRequestHeader('Authorization', auth);
                xhr.onload = function () {
                    if (xhr.status === 200 || xhr.status === 206) {
                      _this.fileUploadResult=true;
                      _this.fileUploadState=1; // 图片上传的标志
                      var ETag = xhr.getResponseHeader('etag');
                      _this.form.pic_url = window.cosUrl+'/'+window.cosFilePath+'/' + window.cosFileName;
                      alert(_this.form.pic_url);
                      callback(null, {url: url, ETag: ETag});
                    } else {
                        callback('文件 ' + Key + ' 上传失败，状态码：' + xhr.status);
                    }
                };
                xhr.onerror = function () {
                    callback('文件 ' + Key + ' 上传失败，请检查是否没配置 CORS 跨域规则');
                };
                xhr.send(file);
            });
        },
    tirggerFile:function(event){
      var file = event.target.files[0]; // 获取要上传文件
      window.cosMethod = 'PUT'; // 必须大写
      window.cosFilePath = 'act_pic'; // cos文件夹名
      window.cosUrl = "http://actsboard-1253442303.cos.ap-guangzhou.myqcloud.com"; // cos Bucket桶域名
      window.cosFileName = this.randomString(3,"HD")+"."+file.name.split('.')[1]; // 新文件的文件名
      window.cosAuthUrl = "http://web.iamxuyuan.com/cos/auth.php"; // 获取签名的接口
      // 使用window对象保存复制文件，用于全局操作
      window.newFile = new File([file],window.cosFileName,{type:file.type});
      this.fileUploadState=-1;
      this.uploadFile(window.newFile,function(err,data){
        console.log('4:',err);
        console.log('5:',data);
        });
    },
    // 生成随机字符串，
    randomString:function(len,type='') {
    　　len = len || 32;
    　　var $chars = 'DEFGHIJKLNOPQRSdefhijkmnprswxyz';
    　　var maxPos = $chars.length;
    　　var pwd = '';
        var i=0;
    　　for (i = 0; i < len; i++) {
    　　　　pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
    　　}
        var timestamp1 = new Date().getTime() // 当前时间戳
    　　return 'ACT_'+pwd+"_"+type+timestamp1;
    }


    // --------------------------------------------

  },

}





</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.manageaddact {
  color: #42b983;
  width: 40em;
  margin: 0 auto;
  margin-top: 3em;
}

#el_form_manageaddact{
  margin-left: 10px;
}
</style>
