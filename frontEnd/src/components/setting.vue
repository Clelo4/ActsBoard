<template>
<div>
  <alert v-model="alert_show" :title="share_title">设置成功！</alert>
     <group></group>
       <group><popup-picker :title="school_title" :data="school_list" v-model="school"></popup-picker></group>
       <group></group>
       <group><popup-picker :title="frequency_title" :data="frequency_list" v-model="frequency"></popup-picker></group>
       <group></group>
       <group>
         <!-- <popup-picker :title="type_title" :data="type_list" v-model="type"></popup-picker> -->
         <cell :title="type_title" :value="type_computed" @click.native="change_picker_state" :is-link="is_link">
         </cell>
         
          <popup v-model="show">
            
            <div class="popup0">

                <popup-header title="最多pick三个标签噢"></popup-header>
                <checklist :options="type_list" v-model="type"></checklist>

            </div>
          </popup>                                                                                                                                                                                                                                                                                                                                                                                                                                           
         </group>
       <x-button type="primary" class="button" @click.native="set_user_setting">完成修改</x-button>
       
</div>

</template>
<script>
import {
  PopupPicker,
  Group,
  XButton,
  Cell,
  Popup,
  Checklist,
  PopupHeader,
  Alert
} from "vux";
import axios from "axios";
import api from "../api";
import util from "../util";

export default {
  components: {
    PopupPicker,
    Group,
    XButton,
    Cell,
    Popup,
    Checklist,
    PopupHeader,
    Alert
  },
  data() {
    return {
      school: ["华南理工大学"],
      school_title: "活动圈子",
      school_list: [["","华南理工大学"]], //这他妈要怎么实现这个不可选
      frequency: ["每日一次"],
      frequency_title: "推送频率",
      frequency_list: [["每日一次", "每三日一次", "每周一次"]],
      type: [],
      type_title: "推送类别",
      type_list: [
        "文娱",
        "公益",
        "运动",
        "比赛",
        "社团招新",
        "讲座",
        "企业宣讲",
        "其他"
      ],
      show: false,
      if_required: true,
      position: "left",
      is_link: true,
      max_num: 3,
      alert_show:false
    };
  },
  computed: {
    type_computed: function() {
      return this.type.join(",");
    }
  },
  //推送频率这里，后台传给我的是数字，可是我前台看到的是中文。这里是在AJAX里做转换，但是我觉得后期看下能不能用computed属性，现在这样写不优雅。
  methods: {
    get_user_init_setting() {
      let _this = this;
      axios
        .get(api.get_user_init_setting)
        .then(function(response) {
          console.log(response.data);
          if (response.data.data.school == null) {
            _this.school = [""]
            
          }else{
            _this.school = [response.data.data.school];
          }

          // this.frequency = response.data.data.frequency;
          if(!response.data.data.frequency){
            _this.frequency == ["未设置"]
          }
          if (response.data.data.frequency == 1) {
            console.log("此时此刻的_this.frequency[0]" + _this.frequency[0]);
            console.log("是设置成每日一次");
            _this.frequency = ["每日一次"];
          }
          if (response.data.data.frequency == 3) {
            console.log("此时此刻的_this.frequency[0]" + _this.frequency[0]);
            console.log("是设置成每三日一次");
            _this.frequency = ["每三日一次"];
          }
          if (response.data.data.frequency == 7) {
            console.log("此时此刻的_this.frequency[0]" + _this.frequency[0]);
            console.log("是设置成每周一次");
            _this.frequency[0] = ["每周一次"];
          }
          _this.type = response.data.data.taglist;
          util.wx_common_share();
        })
        .catch(function(error) {
          console.log("出错了兄弟");
          console.log(error);
        });
      console.log("axios做完啦！下面是现在的this.frequency");
      console.log(this.frequency);
    },
    set_user_setting() {
      let _this = this;
      let temp_taglist = this.type;
      let temp_frequency;
      if (this.frequency[0] == "每日一次") {
        temp_frequency = 1;
      }
      if (this.frequency[0] == "每三日一次") {
        temp_frequency = 3;
      }
      if (this.frequency[0] == "每周一次") {
        temp_frequency = 7;
      }
      if(this.type == null){
        temp_taglist = [];
      }
      console.log("准备发送的type是");
      console.log(this.type);
      axios
        .post(api.set_user_setting, {
          school: _this.school[0],
          frequency: temp_frequency,
          taglist: temp_taglist
        })
        .then(function(response) {
          console.log("发送完了");
          _this.get_user_init_setting();
          console.log(response);
        })
        .catch(function(error) {
          console.log(error);
        });
      this.alert_show = true;
      setTimeout(() => {
        this.alert_show = false;
      }, 6000)
    },

    // 弹出picker
    change_picker_state() {
      console.log(this.type);
      this.show = true;
    }
    
  },
  mounted: function() {
    util.to_wx_config();
    // this.get_user_init_setting();
    let that = this
    util.getCode("setting",that.get_user_init_setting());
   // util.wx_common_share();
  },
  created() {
    
   // let that = this
    //util.getCode("setting",that.get_user_init_setting());
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


