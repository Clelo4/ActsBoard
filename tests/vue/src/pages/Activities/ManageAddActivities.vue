<template>
  <div class="manageaddact">
    <el-form id='el_form_manageaddact' :model='form' label-width='100px'>
      <el-form-item label='活动名称'>
        <el-input v-model='form.name'></el-input>
      </el-form-item>
      <el-form-item label='活动类型'>
        <el-input v-model='form.type'></el-input>
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
      <el-form-item label='活动地点'>
        <el-input v-model='form.location'></el-input>
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
      <el-upload
        class="upload-demo"
        ref="upload"
        action="https://jsonplaceholder.typicode.com/posts/"
        :on-preview="handlePreview"
        :on-remove="handleRemove"
        :on-success="handleUploadSuccess"
        :on-error="handleUploadError"
        :on-progress="loadingUploadFile"
        :before-remove="beforeRemove"
        :limit="1"
        :on-exceed="handleExceed"
        :file-list="fileList"
        :auto-upload="false">
        <el-button slot="trigger" size="small" type="primary">选取图片</el-button>
        <el-button style="margin-left: 10px;" size="small" type="success" @click="submitUpload">确定上传</el-button>
        <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过5MB</div>
      </el-upload>
      <br>
      <h1>Ajax Put 上传</h1>
      <div>最低兼容到 ie10，支持 onprogress</div>

      <input id="fileSelector" type="file">
      <input id="submitBtn" type="submit">

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
        type :"",
        valid_date : "",
        school : "",
        taglist :[], // 
        location :'',
        act_detail:''
      },
      signupResponse:'',
      loadingfullscreen:false,
      fileList:[]
    }
  },
  methods: {
    onSubmit() {
      this.loadingfullscreen=true;
      axios.post('/manage/activities/publish',this.form).then(
        (response)=>{
          console.log(response.status);
          if (response.data['errcode']!=0){
              this.$message(response.data['errmsg']);
              this.loadingfullscreen=false;
            } else {
              this.$message(response.data['data']);
              this.form.name="";
              this.form.type ="";
              this.form.valid_date = "";
              this.form.school = "";
              this.form.taglist =[]; // 
              this.form.location ='';
              this.form.act_detail='';
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
    loadingUploadFile(){
      this.loadingfullscreen=true;
    },
    submitUpload() {
        this.$refs.upload.submit();
      },
    handleRemove(file, fileList) {
        console.log(file, fileList);
      },
    handlePreview(file) {
        console.log(file);
      },
    handleExceed(files, fileList) {
        this.$message.warning(`当前限制选择 1 个文件，本次选择了 ${files.length} 个文件，请移除旧文件`);
      },
    handleUploadSuccess(response, file, fileList){
        this.loadingfullscreen=false;
        this.$message('图片上传成功');
    },
    handleUploadError(error, file, fileList){
        this.loadingfullscreen=false;
        this.$message('图片上传失败，请重新上传');
    }
  }
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
