<template>
  <div>
    <flexbox>
      <flexbox-item :span="5">
        <div class="flex-demo short">
          <group >
            <!-- <select v-model='value_time'>
            <option v-for='one in timeList' :key='one' :value='value_time'>{{one}}</option>
        </select> -->
      <!-- <selector placeholder="请选择时间" v-model="value_time" :options="timeList"></selector> -->
      <popup-picker :data="timeList" v-model="value_time" :placeholder="value_time[0]" @on-change="onChange"></popup-picker>
          </group>
        </div>
      </flexbox-item>
      <flexbox-item>
        <div class="flex-demo temp">
          <group >
            <!-- <select v-model='value_type'>
            <option v-for='one in plainList' :key='one' :value='value_type'>{{one}}</option>
        </select> -->
         <popup-picker :data="typeList" v-model="value_type" :placeholder="value_type[0]"  @on-change="onChange"></popup-picker>
          </group>
        </div>
      </flexbox-item>
    </flexbox>
  </div>
</template>

<script>
import { Selector, Group, PopupPicker, Picker } from "vux";
import { Flexbox, FlexboxItem } from "vux";

export default {
  components: {
    PopupPicker,
    Picker,
    Group,
    Selector,
    Flexbox,
    FlexboxItem
  },
  data() {
    return {
      value_time: ["所有"],
      value_type: ["全部类别"],
      // 这个格式好迷噢
      timeList: [["所有", "未来三天", "未来七天"]],
      typeList: [
        [
          "全部类别",
          "社团招新",
          "企业宣讲",
          "公益",
          "讲座",
          "比赛",
          "运动",
          "其他"
        ]
      ]
    };
  },
  methods: {
    onChange() {
      // todo
      console.log("select 组件提交")
     // console.log(this.value_type[0])
      if (this.value_time[0] == "所有")
        this.$emit("select", 0, this.value_type[0]);
      if (this.value_time[0] == "未来三天")
        this.$emit("select", 3, this.value_type[0]);
      if (this.value_time[0] == "未来七天")
        this.$emit("select", 7, this.value_type[0]);
    }
  }
};
</script>

<style lang="less">
@import "~vux/src/styles/1px.less";
.flex-demo {
  text-align: center;
  border-radius: 4px;
  background-clip: padding-box;
}
.short {
  margin-left: 2rem;
}
.temp {
  margin-left: 1rem;
  margin-right: 2rem;
}
</style>