<template>
  <div>
     <Select @select="get_activities_by_type"></Select>
     <activityOutline :activity="activity" v-for="activity in activities" :key="activity.id" @click.native="to_act_detail(activity.id)">

     </activityOutline>
     <!-- <tab></tab> -->
  </div>
</template>

<script>
import Select from "./select";
import activityOutline from "./activityOutline";
import axios from "axios";
import api from "../api";
// import tab from './tab'
export default {
  components: {
    Select,
    activityOutline
    // tab
  },
  name: "tab",
  data() {
    return {
      to_id:0,
      activities: [
        {
          // id: 1,
          // type: "讲座", // 活动类别
          // name: "ActsBoard讲座", // 活动名称
          // valid_date: "2019-09-09", // 该信息的有效日期，截止到那天23:59
          // school: "华南理工大学", // 学校
          // taglist: "有趣,无聊,妹子多", // 活动标签
          // litimg_url: "http://www.scut.edu.cn", // 活动缩略图
          // pic_url: "http://www.scut.edu.cn", // 活动图片原图
          // location: "华南理工大学", // 活动地点
          // act_detail: "ActsBoard是一家五百强企业，融资400个亿..." // 活动内容
        }
      ],
      time: "",
      type: ""
    };
  },
  methods: {
    get_activities() {
      // console.log(api.get_acts);
      var _this = this;
      axios
        .get(api.get_acts)
        .then(function(response) {
          console.log(response.data);

          // _this.activities = JSON.parse(response.data).data;
          _this.activities = response.data.data;
          // console.log(_this.activities);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    get_activities_by_type(time, type) {
      console.log('这是筛选过的数据' + time + type)
      var _this = this;
      axios
        .get(api.get_activity_after_select(time, type))
        .then(function(response) {
          console.log(response.data);

          // _this.activities = JSON.parse(response.data).data;
          _this.activities = response.data.data;
          // console.log(_this.activities);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    to_act_detail(id) {
      console.log("即将跳转的活动id是" + id);
      // this.to_id = id;
      this.$router.push({
        name: "activityDetail",
        params: {
          act_id: id
        }
      });
    }
  },
  mounted: function() {
    this.get_activities();
  }
};
</script>

<style scoped lang="less">

</style>