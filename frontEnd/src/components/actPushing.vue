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
     <activityOutline :activity="activity" v-for="activity in activities" :key="activity.id">

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
    get_activities() {
      // console.log(api.get_acts);
      var _this = this;
      axios
        .get(api.get_acts) //这个api没换成推荐的API
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
    to_activities() {
      this.$router.push({ path: "/" });
    },
    to_setting() {
      this.$router.push({ path: "/setting" });
    }
  },
  mounted: function() {
    this.get_activities();
  },
  created: function() {
    util.getCode();
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