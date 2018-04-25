<template><div class="background">
  <div class="act-name">{{act.name}}</div>
  <div class="act-detail">{{act.act_detail}}</div>
  <div class="img-background"><img :src="act.url" class="img"></div>
  <div class="column"><div class="blue-circle"></div>
  <div class="act-valid-date">截止至： {{act.valid_date}}</div></div>
  <div class="column"><div class="blue-circle"></div>
  <div class="act-type">活动类型： {{act.type}}</div></div>
  <div class="column"><div class="blue-circle"></div>
  <div class="act-location">活动地点：  {{act.location}}</div></div>
  <div class="column"><div class="blue-circle"></div>
  <div class="act-apply-way">参与方式：{{act.apply_way}}</div></div>
  <div class="column"><div class="blue-circle"></div>
  <div class="act-school">活动所属学校：  {{act.school}}</div></div>
  <x-button type="primary" link="/demo" class="button">分享一下！</x-button>
</div></template>

<script>
import { XButton } from 'vux'
import api from "../api.js";
import axios from "axios";
export default {
  components: {
    XButton
  },
  props: {
    id: {
      type:Number,
     // require: true,
      default: 0
    }
  },
  // name: "tab",
  data() {
    return {
      value: "今天",
      act_id:0,
      act: {
        id: 1,
        type: "讲座",
        name: "这是页面初始模拟数据",
        valid_date: "2019-09-09",
        apply_way: "这是参与方式的模拟数据",
        school: "华南理工大学",
        taglist: "有趣,无聊,妹子多",
        url: "http://www.scut.edu.cn",
        litimg_url: "http://www.scut.edu.cn",
        pic_url: "http://www.scut.edu.cn",
        location: "华南理工大学",
        act_detail: "ActsBoard是一家五百强企业，融资400个亿..."
      }
    };
  },
  methods: {
    onChange() {
      // todo
    },
    get_activity_by_id(id) {
      var _this = this;
      axios
        .get(api.get_activity_by_id(id))
        .then(function(response) {
          console.log(response.data);

          // _this.activities = JSON.parse(response.data).data;
          //console.log(_this.act);
          _this.act = response.data.data;
          //console.log(_this.act);
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  },
  mounted: function() {
    // console(api.get_activity_by_id(id))
    // console.log(this);
    console.log("这是已经跳转到活动详情组件的id号码" + this.$route.params.act_id);
    this.act_id = this.$route.params.act_id;
    this.get_activity_by_id(this.act_id);
  }
};
</script>
<style scoped>
.act-name{
  font-size: 1.5rem;
  font-weight: bolder;
  margin-left: 2rem;
  margin-top: 1rem;
  margin-bottom: 1rem;
  margin-right: 2rem;
}
.act-detail{
  font-size: 0.8rem;
  margin-left: 2rem;
  margin-top: 1rem;
  margin-bottom: 2rem;
  margin-right: 2rem;
}
.img-background{
  display: -webkit-flex; /* Safari */
  display: flex;
  justify-content:center;
}
.img{
  border-radius:1rem;
  height: 40vh;
  width:70vw;
}
.blue-circle{
  margin-right: 1rem;
  width: 1.4rem;
  height: 1.4rem;
  background-color: #2298E1;
  border-radius:1rem;
}
.column{
  margin-left: 20%;
  margin-top: 1rem;
  display: flex;
  justify-content: flex-start;
}
.button{
  margin-top: 1.3rem;
}
</style>
