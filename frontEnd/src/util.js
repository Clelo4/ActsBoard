import api from "./api"
import axios from 'axios'
// import wx from 'weixin-js-sdk'
export default {
  getCode: () => {
    const AppId = 'wxb569d7a3f448c503';
    // console.log(this.a);
    // const code = getUrlParam("code"); //这个getUrlParam需要自己实现
    let code;
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象  
    var r = window.location.search.substr(1).match(reg); //匹配目标参数  
    if (r != null)
      code = unescape(r[2]);
    const local = window.location.href; //拿到当前的url
    const redirect_uri = "http://web.iamxuyuan.com";
    //检查有没有openid
    console.log('code=' +code);
    let if_open_id = document.cookie.indexOf("openId");
    console.log('此时的openid的位置是' + if_open_id);
    // 没有openid的情况下
    if (if_open_id < 0) {
      if (code == null || code === "") {
        // axios.post(api.post_code, {
        //     code: this.code //这样写不知道对不对~
        //   })
        //   .then(function (response) {
        //     console.log(response);
        //     console.log('post code成功')
        //   })
        //   .catch(function (error) {
        //     console.log(error);
        //   });
        console.log('请求后端-完成')
         window.location.href = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" + AppId + "&redirect_uri=" + redirect_uri + "&response_type=code&scope=snsapi_userinfo&connect_redirect=1#wechat_redirect"; //这是要调用的微信官方接口,拿到回调的url，相当于重新刷新了页面
      } else {
        //页面重新刷新，由于没有openid，所以还是会来到这一层逻辑，这里就是拿到的回调的url，里面含有code这个字段了
        // 这时候把code 发送到后端
        console.log('请求后端')
        axios.post(api.post_code, {
            code: this.code //这样写不知道对不对~
          })
          .then(function (response) {
            console.log(response);
            console.log('post code成功')
          })
          .catch(function (error) {
            console.log(error);
          });
        console.log('请求后端-完成')
      }
    }
  },
  //解析url获取特定字段的
  getUrlParam: (name) => {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象  
    var r = window.location.search.substr(1).match(reg); //匹配目标参数  
    if (r != null) return unescape(r[2]);
    return null; //返回参数值  
  },

  //微信分享功能
  to_share() {

  }
}
