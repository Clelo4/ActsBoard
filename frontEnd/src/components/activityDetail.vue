<template><div id="temp">
  <div class="background">
  <alert v-model="alert_show" :title="share_title">点击右上角就可以分享啦！<br>记得关注一下我们公众号嘛~QAQ</alert>
  <div class="act-name">{{act.name}}</div>
  <div class="act-detail">{{act.act_detail}}</div>
  <div class="img-background" v-if="have_pic"><img :src="act.pic_url" class="img"></div>
  <div class="column"><div class="blue-circle"></div>
  <div class="act-valid-date">截止至： {{act.valid_date}}</div></div>
  <div class="column"><div class="blue-circle"></div>
  <div class="act-type">活动类型： {{act.type}}</div></div>
  <div class="column"><div class="blue-circle"></div>
  <div class="act-school">活动所属学校：  {{act.school}}</div></div>
  </div>
  <x-button type="primary" class="button" @click.native="to_share">分享一下！</x-button>
</div></template>

<script>
import { XButton,Alert } from "vux";
import api from "../api.js";
import axios from "axios";
import util from "../util";
export default {
  components: {
    XButton,
    Alert
  },
  props: {
    id: {
      type: Number,
      // require: true,
      default: 0
    },
    name: {
      type: String,
      // require: true,
      default: 0
    }
  },
  // name: "tab",
  data() {
    return {
      share_title:'分享一下',
      alert_show:false,
      value: "今天",
      actname: "",
      actid: 0,
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
      },
      have_pic:true
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
          if(response.data.data.pic_url.length == 0){
            console.log('改了')
            _this.have_pic = false;
          }
          //console.log(_this.act);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    to_share() {
      this.alert_show = true;
      setTimeout(() => {
        this.alert_show = false;
      }, 3000)
    }
  },
  mounted: function() {
    // console(api.get_activity_by_id(id))
    // console.log(this); 
    console.log(
      "这是已经跳转到活动详情组件的id号码" + this.$route.params.actid
    );
    this.actid = this.$route.params.actid;
    this.actname = this.$route.params.actname;
    console.log(this.actid);
    this.get_activity_by_id(this.actid);
    util.wx_act_detail_share(this.actname,window.location.href);
  },
  beforeCreate(){
    // util.check_if_follow();
  }

};
</script>
<style scoped>
.act-name {
  font-size: 1.5rem;
  font-weight: bolder;
  margin-left: 2rem;
  margin-top: 1rem;
  margin-bottom: 1rem;
  margin-right: 2rem;
}
.act-detail {
  font-size: 0.8rem;
  margin-left: 2rem;
  margin-top: 1rem;
  margin-bottom: 2rem;
  margin-right: 2rem;
}
.img-background {
  display: -webkit-flex; /* Safari */
  display: flex;
  justify-content: center;
}
.img {
  border-radius: 1rem;
  height: 40vh;
  width: 70vw;
}
.blue-circle {
  margin-right: 1rem;
  width: 1.4rem;
  height: 1.4rem;
  background-color: #2298e1;
  border-radius: 1rem;
}
.column {
  margin-left: 20%;
  margin-top: 1rem;
  display: flex;
  justify-content: flex-start;
}
.button {
  margin-top:-11vw;
}
.background{
  min-height: 100%;
  display: flex;
  flex-direction: column;
}
#temp{
  height: 100%;
}
</style>
