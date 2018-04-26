<template>
<div>
     <group></group>
       <group><popup-picker :title="school_title" :data="school_list" v-model="school"></popup-picker></group>
       <group></group>
       <group><popup-picker :title="frequency_title" :data="frequency_list" v-model="frequency"></popup-picker></group>
       <group></group>
       <group><popup-picker :title="type_title" :data="type_list" v-model="type"></popup-picker></group>
       <x-button type="primary" link="/demo" class="button" @click="set_user_setting">完成修改</x-button>
       
</div>

</template>
<script>
import { PopupPicker, Group, XButton } from "vux";
import axios from "axios";
import api from "../api";
import util from "../util"

export default {
  components: {
    PopupPicker,
    Group,
    XButton
  },
  data() {
    return {
      school: ["华南理工大学"],
      school_title: "活动圈子",
      school_list: [["华南理工大学", "其他区域待开放"]], //这他妈要怎么实现这个不可选
      frequency: ["每日一次"],
      frequency_title: "推送频率",
      frequency_list: [["每日一次", "每三日一次", "每周一次"]],
      type: ["全部"],
      type_title: "推送类别",
      type_list: [["比赛", "宣讲会", "招聘会", "运动会"]]
    };
  },
  //推送频率这里，后台传给我的是数字，可是我前台看到的是中文。这里是在AJAX里做转换，但是我觉得后期看下能不能用computed属性，现在这样写不优雅。
  methods: {
    get_user_init_setting() {
      let _this = this;
      axios
        .get(api.get_user_init_setting)
        .then(function(response) {
          console.log(response.data);
          _this.school[0] = response.data.data.school;
          // this.frequency = response.data.data.frequency;
          if(response.data.data.frequency == 1){
            console.log('此时此刻的_this.frequency[0]' + _this.frequency[0])
            console.log('是设置成每日一次')
            _this.frequency = ["每日一次"]
          }
          if(response.data.data.frequency == 3){
            console.log('此时此刻的_this.frequency[0]' + _this.frequency[0])
            console.log('是设置成每三日一次')
            _this.frequency = ["每三日一次"]
          }
          if(response.data.data.frequency == 7){
            console.log('此时此刻的_this.frequency[0]' + _this.frequency[0])
            console.log('是设置成每周一次')
            _this.frequency[0] = ["每周一次"]
          }
          _this.type[0] = response.data.data.type;
        })
        .catch(function(error) {
          console.log('出错了兄弟')
          console.log(error);
        });
      console.log('axios做完啦！下面是现在的this.frequency')
      console.log(this.frequency);
    },
    set_user_setting() {
      let temp_frequency;
      if(this.frequency[0] == '每日一次'){
        temp_frequency = 1;
      }
      if(this.frequency[0] == '每三日一次'){
        temp_frequency = 7;
      }
      if(this.frequency[0] == '每周一次'){
        temp_frequency = 7;
      }
      let _this = this;
      console.log('准备发送')
      axios
        .post(api.set_user_setting, {
          school: _thisschool[0],
          frequency: temp_frequency,
          type:_this.type[0]
        })
        .then(function(response) {
          console.log('发送完了')
          console.log(response);
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  },
  mounted: function() {
    this.get_user_init_setting();
  },
  created:function(){
    util.getCode('setting');
  }
};
</script>
<style scoped>
.button {
  position: fixed;
  bottom: 0;
  width: 70vw;
  margin-left: 15vw;
}
</style>


