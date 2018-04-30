<template>
  <div  class='act_info'>
        <el-form :model='actinfo' label-width='80px'>
          <el-form-item label='活动名称'>
            <el-input v-model='actinfo.name' value='actinfo.name'></el-input>
          </el-form-item>
          <el-form-item label='学校'>
            <el-input v-model='actinfo.school' value='actinfo.school'></el-input>
          </el-form-item>
          <el-form-item label='活动标签'>
             <el-checkbox-group v-model="taglist" >
                <el-checkbox-button v-for="tag in tags" :label="tag" :key="tag">{{tag}}</el-checkbox-button>
              </el-checkbox-group>
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
      dialogFormVisible:false,
      tags: [],
      taglist:[],
    }
  },
  created:function(){
    this.tags=["比赛","文娱","公益","运动","社团招新","讲座","企业宣讲","其他"]; // 活动标签
    var act_id = this.$route.query['id'];
    axios.get("http://web.iamxuyuan.com/util/gettaglist").then(
      (response)=>{
        console.log("获取标签成功");
        if (response.status == 200 && response.data['errcode'] == 0){
          this.tags = response.data['data'];
          console.log('this.tags:',this.tags);
        }
      }
    ).catch((error)=>{
      console.log("获取标签失败");
    });
    axios.get("http://web.iamxuyuan.com/manage/activities/getinfo?id="+act_id).then(
        (response)=>{
          console.log(response.data);
          console.log(response.data.errcode);
          if (response.data.errcode != 0){
              this.$message("请求失败11");  //response.data['errmsg']);
          } else {
              // 成功
              this.actinfo=response.data['data'];
              this.taglist=this.actinfo.taglist;
              console.log(this.actinfo['taglist']);
              console.log(this.actinfo);
              console.log('success');
          }
        }).catch((error) => {
          console.log(error);
          console.log('11');
          this.$message('请求失败');
        });
    
  },
  methods:{
    onSubmit() {
      console.log(this.taglist);
      this.actinfo.taglist = this.taglist;
      axios.post('http://web.iamxuyuan.com/manage/activities/change',this.actinfo).then(
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
