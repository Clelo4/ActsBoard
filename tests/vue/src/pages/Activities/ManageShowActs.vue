<template>
  <div calss='act_table'>
    <el-container>
      <el-table
      :data="tableD"
      border
      style="width: 100%">
      <el-table-column
        fixed='left'
        prop="valid_date"
        label="活动信息截止时间"
        align="center"
        width="180">
      </el-table-column>
      <el-table-column
        prop="name"
        label="活动名称"
        align="center"
        width="180">
      </el-table-column>
      <el-table-column
        prop="type"
        label="类别"
        align="center">
      </el-table-column>
          <el-table-column
        prop="school"
        label="学校"
        width="180"
        align="center">
      </el-table-column>
      <el-table-column
        prop="apply_way"
        label="申请方式"
        align="center"
        width="180">
      </el-table-column>
      <el-table-column
        prop="location"
        align="center"
        label="地点">
      </el-table-column>
      <el-table-column
        prop="taglist"
        label="标签"
        align="center"
        :filters="[{ text: '家', value: '家' }, { text: '公司', value: '公司' }]"
        :filter-method="filterTag">
      </el-table-column>
      <el-table-column
        fixed='right'
        label="操作"
        align="center">
        <template slot-scope="scope">
          <el-button
            @click.native.prevent="selectRow(scope.$index, tableD)"
            @click="dialogVisible = true"
            type="text"
            size="small">
            移除
          </el-button>
          <el-button
            @click.native.prevent="goToActInfo()"
            @click="selectRow(scope.$index, tableD)"
            type="text"
            size="small">
            查看
          </el-button>
        </template>
      </el-table-column>
      </el-table>
    </el-container>
    <el-dialog
      title="提示"
      :visible.sync="dialogVisible"
      width="30%"
      :before-close="handleClose">
      <span>确定删除活动？</span>
      <span slot="footer" class="dialog-footer">
        <el-button @click="dialogVisible = false">取 消</el-button>
        <el-button type="primary" @click="dialogVisible = false;deleteact()">确 定</el-button>
      </span>
    </el-dialog>
    

    <el-pagination
    background
    layout="prev, pager, next"
    :total="totalnums"
    @current-change="getActs"
    :current-page.sync='currentPage'
    >
    </el-pagination>
  </div>

</template>

<script>
export default {
  name:'ManageShowActs',
  components:{},
  data() {
    return {
      totalnums:10,
      tableD: [],
      dialogVisible: false,
      dialogFormVisible:false,
      selectActId:'',
      selectindex:'',
      currentPage:1,
    }
  },
  created:function(){
    // 获取活动的总数
    axios.get('/activities/getallnum').then(
      (response)=>{
        if(response.data.errcode != 0){
          this.$message = response.data['errmsg'];
        } else{
          this.totalnums = response.data['data'];
          console.log('ok!hh');
        }
      }
    ).catch((error)=>{
      this.$message = '请求失败,请刷新重试';
    });
    axios.get('/manage/activities/getacts?page='+this.current_change).then(
        (response)=>{
          console.log(response.status);
          if (response.data['errcode']!=0){
              this.$message("请求失败，请刷重试");  //response.data['errmsg']);
          } else {
              // 成功
              this.tableD=response.data['data']
              console.log('success');
          }
        }).catch((error) => {
          this.$message('请求数据失败');
        });
      console.log('created');
  },
  methods: {
      // 选择活动
      selectRow(index, rows) {
        this.selectActId=rows[index]['id']; // 获取要操作的活动的活动id
        this.selectindex=index;
        console.log('act_id:',this.selectActId,rows[index]['name']);
      },
      handleClick(row) {
        console.log(row);
      },
      filterTag(value, row) {
        return row.tag === value;
      },
      handleClose(done) {
        this.$confirm('确认关闭？')
          .then(_ => {
            console.log('handleClose');
            done();
          })
          .catch(_ => {});
      },

      // 删除活动
      deleteact(){
        let index;
        index = this.selectindex;
        axios.post("/manage/activities/deleteact",{'act_id':this.selectActId}).then(
          (response)=>{
          console.log(response.status);
          if (response.data['errcode']!=0){
              this.$message("删除活动失败");  //response.data['errmsg']);
          } else {
              this.$message('删除活动成功');
              this.tableD.splice(index,1);
          }
        }).catch((error) => {
          this.$message('删除活动失败');
        })
      },

      getActs(){
        axios.get('/manage/activities/getacts?page='+this.currentPage).then(
        (response)=>{
          console.log(response.status);
          if (response.data['errcode']!=0){
              this.$message("请求失败，请刷重试");  //response.data['errmsg']);
          } else {
              // 成功
              this.tableD=response.data['data']
              console.log('success');
          }
        }).catch((error) => {
          this.$message('请求数据失败');
        });
      },

      // 跳转到活动详情
      goToActInfo(){
        console.log('....',this.selectActId,'.....');
        this.$router.push({path:'/manage/getactInfo',query:{id:this.selectActId}});
      }
  }
}
</script>

<style>
.act_table{
  margin-left: 100px;
}
.el-container{
  margin-top: 2em;
  margin-left: 2em;
  margin-bottom: 0em;
  margin-right: 2em;
}
.el-table-column{

}
</style>
