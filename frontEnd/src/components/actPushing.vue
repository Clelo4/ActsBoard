<template>
  <div>
    <div class="bar-background">
        <flexbox>
      <flexbox-item @click.native="to_activities">
         <div class="more-act">查看更多活动</div>
      </flexbox-item>
      <flexbox-item  @click.native="to_setting">
        <div class="to-setting">推送不满意?</div>
      </flexbox-item>
    </flexbox>
    </div>
     <activityOutline :activity="activity" v-for="activity in activities" :key="activity.id" @click.native="to_act_detail(activity.id,activity.name)">

     </activityOutline>
     <!-- <tab></tab> -->
  </div>
</template>

<script>
import activityOutline from "./activityOutline";
import axios from "axios";
import api from "../api";
import util from "../util";
import { Flexbox, FlexboxItem } from "vux";

// import tab from './tab'
export default {
  components: {
    activityOutline,
    // tab
    Flexbox,
    FlexboxItem
  },
  name: "tab",
  data() {
    return {
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
      ]
    };
  },
  methods: {
    get_activities_t() {
      // console.log(api.get_acts);
      // alert('朕要开始做爱了')
      var _this = this;
      axios
        .get(api.get_recommend_activity) //这个api没换成推荐的API
        .then(function(response) {
          console.log(response.data);
          // for(let i = 0;i < response.data.data.length;i++){
          //   response.data.data[i].valid_date = response.data.data[i].valid_date.split(" ")[0];
          // }
          // _this.activities = JSON.parse(response.data).data;
          _this.activities = response.data.data;
          // console.log(_this.activities);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    to_activities() {
      this.$router.push({ path: "/" });
    },
    to_setting() {
      this.$router.push({ path: "/setting" });
    },
    to_act_detail(id,name) {
      console.log("即将跳转的活动id是" + id);
      // this.to_id = id;
      this.$router.push({
        name: "activityDetail",
        params: {
          actid: id,
          actname:name
        }
      });
    }
  },
  mounted: function() {
    util.wx_common_share();
  },


  created(){
    // alert('做了一次')
    var that = this;
    //console.log(document.cookie)
    util.getCode("actpushing",that.get_activities_t); // 这里居然不能加（），我也不知道为什么
    // util.check_if_follow();
  }
};
</script>

<style scoped>
flexbox {
  height: 100%;
}
.bar-background {
  margin-top: 1.5rem;
  height: 2rem;
}
.more-act {
  background-color: white;
  height: 2rem;
  margin-left: 2rem;
  text-align: center;
  border-radius: 1rem;
  color: #2298e1;
  font-weight: bold;
}
.to-setting {
  background-color: white;
  height: 2rem;
  margin-right: 2rem;
  text-align: center;
  border-radius: 1rem;
  font-weight: bold;
}
</style>