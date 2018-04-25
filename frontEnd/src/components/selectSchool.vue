<template>
<div>
    <div id="title-1">链接你的高校圈子</div>
    <div id="explain-1">定位高校圈子，饱览活动信息</div>
    <div class="background">
        <div class="background-1">
            <div class="blue-circle"></div>
            <div>{{school}}</div>
        </div>
     <group label-width="5em">
      <popup-picker :popup-title="title" :data="school_list" v-model="school" :placeholder="title">
        <template slot="title" slot-scope="props"><!-- use scope="props" when vue < 2.5.0 -->
          <span :class="props.labelClass" :style="props.labelStyle" style="height:24px;">
            <span class="demo-icon demo-icon-big" style="font-size:20px;vertical-align:middle;">
              <x-icon type="ios-search-strong" size="25"></x-icon>
            </span>
            <span style="vertical-align:middle;">学校</span>
          </span>
        </template>
      </popup-picker>
    </group>
       </div>
        <x-button id="button" :gradients="['#1D62F0', '#19D5FD']">下一步</x-button>
</div>
</template>
<script>
import { Search, Group, Cell, XButton, PopupPicker } from "vux";

export default {
  components: {
    Search,
    Group,
    Cell,
    XButton,
    PopupPicker
  },
  data() {
    return {
      school: [],
      school_list: [["华南理工大学", "其他区域待开放"]],
      title: '您的学校'
    };
  },
  methods: {}
};
</script>
<style scoped>
#button {
  margin-top: 3rem;
  border-radius: 2rem;
  width: 40vw;
}
.background {
  background-color: white;
  margin-top: 2rem;
  margin-left: 2rem;
  margin-right: 2rem;
  border-radius: 1rem;
}
.background-1 {
  display: flex;
  padding-top: 2rem;
  padding-left: 1rem;
  margin-bottom: 2rem;
}
.blue-circle {
  margin-right: 1rem;
  width: 1.4rem;
  height: 1.4rem;
  background-color: #2298e1;
  border-radius: 1rem;
}
#title-1 {
  margin-top: 3rem;
  margin-left: 2rem;
  font-weight: bolder;
  font-size: 1.5rem;
}
#explain-1 {
  margin-top: 2rem;
  margin-left: 2rem;
}
</style>


