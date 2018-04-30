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
        <el-button>取消</el-button>
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
      prefix:'http://actsboard-1253442303.cos.ap-guangzhou.myqcloud.com/',
      lmodel:'',
      filepathTmp:'',
      fileUploadResult:false,
      fileUploadState:0, // -1正在上传 0没有 1为成功上传

    }
  },
  methods: {

    onSubmit() {
      if(this.fileUploadState==-1){
        console.log('this.fileUploadState:',this.fileUploadState);
        this.$message('图片正在上传，请重新点击提交按钮!');
        return ;
      }
      this.loadingfullscreen=true; // 全屏loading
      console.log('pic_url:',this.form.pic_url);
      axios.post('/manage/activities/publish',this.form).then(
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

    // 移除上传文件
    beforeRemove(file, fileList) {
        return this.$confirm(`确定移除 ${ file.name }？`);
    },

    // --------------------------------------------
      getAuthorization(options,callback){
        var method = (options.Method || 'get').toLowerCase();
        var key = options.Key || '';
        var pathname = key.indexOf('/') === 0 ? key : '/' + key;
  
        var url = '../cos/auth.php';
        var xhr = new XMLHttpRequest();
        var data = {
            method: method,
            pathname: pathname,
          };
        xhr.open('POST', url, true);
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
            console.log(file);
            var Key = this.filePath + file.name; // 这里指定上传目录和文件名
            console.log('here');
            this.form.pic_url=this.filepathTmp;
            var _this=this

            this.getAuthorization({Method: 'PUT', Key: Key}, function (auth) {
              
                var url = 'http://actsboard-1253442303.cos.ap-guangzhou.myqcloud.com/' + Key;
                var xhr = new XMLHttpRequest();
                xhr.open('PUT', url, true);
                xhr.setRequestHeader('Authorization', auth);
                xhr.onload = function () {
                    if (xhr.status === 200 || xhr.status === 206) {
                      _this.fileUploadResult=true;
                      _this.fileUploadState=1;
                      console.log(_this.fileUploadState);
                      console.log('okok')

                      var ETag = xhr.getResponseHeader('etag');
                      callback(null, {url: url, ETag: ETag});
                    } else {
                        callback('文件 ' + Key + ' 上传失败，状态码：' + xhr.status);
                    }
                };
                xhr.onerror = function () {
                    callback('文件 ' + Key + ' 上传失败，请检查是否没配置 CORS 跨域规则');
                };
                
                // console.log('1',file);
                xhr.send(file);
                // console.log('2',newFile);
            });
        },
    tirggerFile:function(event){
      var file = event.target.files[0];
      var Key = 'dir/' + file.name; // 这里指定上传目录和文件名
      console.log(Key);
      this.filepathTmp=this.prefix+Key;
      this.fileUploadState=-1;
      console.log('uploadFile0:',this.filepathTmp);

      this.uploadFile(file,function(err,data){
        console.log(err || data);
        console.log(data.Etag);
        });
    },
    randomString:function(len) {
    　　len = len || 32;
    　　var $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';    /****默认去掉了容易混淆的字符oOLl,9gq,Vv,Uu,I1****/
    　　var maxPos = $chars.length;
    　　var pwd = '';
        var i=0;
    　　for (i = 0; i < len; i++) {
    　　　　pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
    　　}
        var timestamp1 = Date.parse( new Date()) // 当前时间戳
    　　return pwd+timestamp1;
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
