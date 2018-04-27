<template>
  <div  class='act_info'>
        <el-form :model='actinfo' label-width='80px'>
          <el-form-item label='活动名称'>
            <el-input v-model='actinfo.name' value='actinfo.name'></el-input>
          </el-form-item>
          <el-form-item label='类别'>
            <el-input v-model='actinfo.type' value='actinfo.type'></el-input>
          </el-form-item>
          <el-form-item label='学校'>
            <el-input v-model='actinfo.school' value='actinfo.school'></el-input>
          </el-form-item>
          <el-form-item label='申请方式'>
            <el-input v-model='actinfo.apply_way' value='actinfo.apply_way'></el-input>
          </el-form-item>
          <el-form-item label='地点'>
            <el-input v-model='actinfo.location' value='actinfo.location'></el-input>
          </el-form-item>
          <el-form-item label='标签'>
            <el-input v-model='actinfo.taglist' value='actinfo.taglist'></el-input>
          </el-form-item>
          <el-form-item label='活动内容'>
            <el-input v-model='actinfo.act_detail' value='actinfo.act_detail' type="textarea" :rows="3">></el-input>
          </el-form-item>
          <el-form-item>
            <el-button type="primary" @click="dialogVisible = true">修 改</el-button>
            <el-button @click="()=>{this.$router.push({path:'/manage/getacts'});}">返 回</el-button>
          </el-form-item>
        </el-form>
          <el-dialog
            title="提示"
            :visible.sync="dialogVisible"
            width="30%"
            :before-close="handleClose">
            <span>确定修改活动？</span>
            <span slot="footer" class="dialog-footer">
              <el-button @click="dialogVisible = false">返 回</el-button>
              <el-button type="primary" @click="dialogVisible = false;onSubmit()">确 定</el-button>
            </span>
          </el-dialog>
  </div>
</template>

<script>
export default {
  name:'ManageShowActInfo',
  data() {
    return {
      actinfo:{},
      dialogVisible: false,
    }
  },
  created:function(){
    var act_id = this.$route.query['id'];
    axios.get("/manage/activities/getinfo?id="+act_id).then(
        (response)=>{
          console.log(response.status);
          if (response.data['errcode']!=0){
              this.$message("请求失败");  //response.data['errmsg']);
          } else {
              // 成功
              this.actinfo=response.data['data'];
              console.log('success');
          }
        }).catch((error) => {
          this.$message('请求失败');
        });
  },
  methods:{
    onSubmit() {
      axios.post('/manage/activities/change',this.actinfo).then(
              (response)=>{
                console.log(response.data);
                if (response.data['errcode']!=0){
                  this.$message('修改失败');
                } else {
                  this.$message('修改成功');
                }
              }).catch((error)=>{
                  this.$message('网络错误,请重试');
        });
            console.log('submit!');
    },
  }
}
</script>

<style scoped>
.act_info {
  color: #42b983;
  width: 50em;
  margin:0 auto;
  margin-top: 8em;
}
</style>
