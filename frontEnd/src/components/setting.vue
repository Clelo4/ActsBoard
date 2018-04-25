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
import util from '../util'

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
  methods: {
    get_user_init_setting() {
      axios
        .get(api.get_user_init_setting)
        .then(function(response) {
          console.log(response.data);

          // _this.activities = JSON.parse(response.data).data;
          //_this.activities = response.data.data;
          // console.log(_this.activities);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    set_user_setting() {
      axios
        .post(api.set_user_setting, {
          school: this.school[0],
          frequency: this.frequency[0],
          type:this.type[0]
        })
        .then(function(response) {
          console.log(response);
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  },
  mounted: function() {
    get_user_init_setting();
  },
  created:function(){
    util.getCode();
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


