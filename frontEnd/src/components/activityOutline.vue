<template>
  <div class="background">
 
    <flexbox class="caixukun">
      <flexbox-item :span="4" class="photo">
        <div class="type-color">
          <div class="type-name">
              {{activity.type}}
          </div>
        <div class="type-time">
              {{activity.valid_date}}
        </div>
      </div>
      </flexbox-item>
      <flexbox-item>   
      <div class="content">
        <div class="activity-name">{{activity.name}}</div>  
        <div class="activity-detail">{{activity.act_detail}}</div>
      </div>
</flexbox-item>

    </flexbox>



      <!-- 这里怎么用到动态绑定去实现这个 title的绑定啊
     <card :header="{title: (activity.id + activity.name)}" :footer="{title:'查看更多',link:'/component/activityDetail'}">
      <p slot="content" class="card-padding">地点：{{activity.apply_location}}</p>
      <p slot="content" class="card-padding">时间：{{activity.act_start_time}}</p> -->

    <!-- <panel :footer="footer" :list="list" :type="type" @on-img-error="onImgError"></panel> -->
    <!-- </card> -->
  </div>
    
</template>

<script>
import { Divider, Card } from "vux";
import { Flexbox, FlexboxItem } from "vux";
import api from "../api.js";
// import axios from "axios";
export default {
  components: {
    Card,
    Divider,
    Flexbox,
    FlexboxItem
  },
  props: {
    //     {
    //     "errcode":0,
    //     "data":[
    //         {
    //         "id":1,
    //         "type":"讲座",                // 活动类别
    //         "name":"ActsBoard讲座",           // 活动名称
    //         "valid_date":"2019-09-09",     // 该信息的有效日期，截止到那天23:59
    //         "school":"华南理工大学",                    // 学校
    //         "taglist":"有趣,无聊,妹子多",               // 活动标签
    //         "litimg_url":"http://www.scut.edu.cn",     // 活动缩略图
    //         "pic_url":"http://www.scut.edu.cn",    // 活动图片原图
    //         "location":"华南理工大学"               // 活动地点
    //         "act_detail":"ActsBoard是一家五百强企业，融资400个亿..."   // 活动内容
    //     },
    //         {},
    //         {},
    //     ],
    //     "errmsg":""
    // }
    activity: {
      type: Object,
      require: true
    }
  },
  name: "tab",
  data() {
    return {
      content: "这是活动内容"
    };
  },
  methods: {},
  mounted: function() {
    //拿到后台数据
  }
};
</script>

<style scoped lang="less">
@import "~vux/src/styles/1px.less";
.activity-detail {
  text-overflow: ellipsis;
  overflow: hidden;
  -webkit-line-clamp: 3;
  display: -webkit-box;
  -webkit-box-orient: vertical;
}
.activity-name {
  font-size: 16pt;
  font-weight: bolder;
  text-overflow: ellipsis;
  overflow: hidden;
  white-space: nowrap;
}
.background {
  background-color: #FFFFFF;
  border-radius: 1rem;
  margin-top: 1rem;
  margin-left: 2rem;
  margin-right: 2rem;
  margin-bottom: 1rem;
  height: 7rem;
}
.card-demo-flex {
  display: flex;
}
.card-demo-content01 {
  padding: 10px 0;
}
.card-padding {
  padding: 15px;
}
.card-demo-flex > div {
  flex: 1;
  text-align: center;
  font-size: 12px;
}
.card-demo-flex span {
  color: #f74c31;
}
.type-color {
  -moz-border-radius: 1em;
  -webkit-border-radius: 1em;
  border-radius: 1em;
  width: 90%;
  height: 79%;
  background-color: #ecf8ff;
  display: flex;
  margin-top: 12%;
  margin-left: 10%;
  flex-direction: column;
  justify-content: center;
}
.caixukun {
  height: 100%;
  // display: flex;
  // flex-direction: row
}
.photo {
  height: 100%;
}
.type-name {
  font-size: 10pt;
  font-family: "PingFang-SC-Heavy";
  text-align: center;
}
.type-time {
  font-size: 12pt;
  margin-top: 1rem;
  font-family: "PingFang-SC-Heavy";
  text-align: center;
}
</style>