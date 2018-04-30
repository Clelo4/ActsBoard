import api from "./api"
import axios from 'axios'
import wx from 'weixin-js-sdk'
// import wx from 'weixin-js-sdk'
export default {
  getCode: (state,callback) => {
    const AppId = 'wxb569d7a3f448c503';
    // console.log(this.a);
    // const code = getUrlParam("code"); //这个getUrlParam需要自己实现
    let code;
    var reg = new RegExp("(^|&)code=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象  
    var r = window.location.search.substr(1).match(reg); //匹配目标参数  
    if (r != null)
      code = unescape(r[2]);
    const local = window.location.href; //拿到当前的url
    console.log('这是Local' + local);
    const redirect_uri = "http://web.iamxuyuan.com/";
    //检查有没有openid
    console.log('code=' + code);
    let if_open_id = document.cookie.indexOf("openid");
    console.log('此时的openid的位置是' + if_open_id);
    // alert('code!' + code);
    if (if_open_id < 0) {
      // alert('没有open_id')
      if (code == null || code === "") {
        console.log('请求后端-完成')
        // alert('diu!这是'+state);
        window.location.href = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" + AppId + "&redirect_uri=http://web.iamxuyuan.com&response_type=code&scope=snsapi_base&state=" + state + "#wechat_redirect"; //这是要调用的微信官方接口,拿到回调的url，相当于重新刷新了页面
      } else {
        console.log('请求后端')
        axios.post(api.get_user_info, {
            code: code //这样写不知道对不对~
          })
          .then(function (response) {
            console.log(response);
            console.log('post code成功')
            // alert('!!!!!!!');
            callback()
          })
          .catch(function (error) {
            console.log(error);
          });
        console.log('请求后端-完成')
      }
    
    }
    
    
  },

  //检查用户是否关注了该公众号
  check_if_follow: () => {
    console.log('进入到检查是否关注啦！')
    
    // 检查用户有没有关注
    let if_follow
    let cookie = document.cookie.split(";");
    alert(document.cookie)
    for(let i = 0;i<cookie.length;i++){
      let cookie_item = cookie[i].split("=");
      alert(cookie_item)
      if(cookie_item[0] == "subscribe"){
        if_follow = cookie_item[1];
        alert(if_follow)
      }
    }
    console.log(if_follow);
    if (if_follow != "1") {
      alert('进入到check_if_folloow')
      const AppId = 'wxb569d7a3f448c503';
      // console.log(this.a);
      // const code = getUrlParam("code"); //这个getUrlParam需要自己实现
      let code, subscribe;
      var reg = new RegExp("(^|&)code=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象  
      var r = window.location.search.substr(1).match(reg); //匹配目标参数  
      if (r != null)
        code = unescape(r[2]);
      const local = window.location.href; //拿到当前的url
      console.log('这是Local' + local);
      const redirect_uri = "http://web.iamxuyuan.com/";
      //检查有没有openid
      console.log('code=' + code);
      // let if_open_id = document.cookie.indexOf("openid");
      // console.log('此时的openid的位置是' + if_open_id);
      //if (if_open_id < 0) {
      if (code == null || code === "") {
        //    console.log('请求后端-完成')
        window.location.href = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" + AppId + "&redirect_uri=http://web.iamxuyuan.com&response_type=code&scope=snsapi_base#wechat_redirect"; //这是要调用的微信官方接口,拿到回调的url，相当于重新刷新了页面
        //  } else {
        //    console.log('请求后端')
      } else {
        axios.post(api.get_user_info, {
            code: code //这样写不知道对不对~
          })
          .then(function (response) {
            console.log('post code成功')
            if (!response.data.data.subscribe) {
              console.log('跳转')
              //window.location.href = 'https://www.baidu.com' //这里会跳转到我们服务号的历史消息，让它关注
            }
          })
          .catch(function (error) {
            console.log(error);
          });
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

  //微信config功能
  to_wx_config: () => {
    console.log('进入到微信config功能啦')
    let t_timestamp, t_nonceStr, t_signature;
    //拿到wx.config需要的东西
    console.log(window.location.href)
    axios.post(api.get_wx_config,{
      url:window.location.href
    })
      .then(function (response) {
        console.log('这是获取微信config功能获取的信息')
        console.log(response.data.data)
        // 这里之后可以简化一下
        t_timestamp = response.data.data.timestamp;
        t_nonceStr = response.data.data.nonceStr;
        t_signature = response.data.data.signature;
        wx.config({
          debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
          appId: 'wxb569d7a3f448c503', // 必填，公众号的唯一标识
          timestamp: t_timestamp, // 必填，生成签名的时间戳
          nonceStr: t_nonceStr, // 必填，生成签名的随机串
          signature: t_signature, // 必填，签名\
          jsApiList: [ // 必填，需要使用的JS接口列表
            "onMenuShareTimeline",
            "onMenuShareAppMessage",
            "onMenuShareQQ",
            "onMenuShareWeibo",
            "onMenuShareQZone",
            "startRecord",
            "stopRecord",
            "onVoiceRecordEnd",
            "playVoice",
            "pauseVoice",
            "stopVoice",
            "onVoicePlayEnd",
            "uploadVoice",
            "downloadVoice",
            "chooseImage",
            "previewImage",
            "uploadImage",
            "downloadImage",
            "translateVoice",
            "getNetworkType",
            "openLocation",
            "getLocation",
            "hideOptionMenu",
            "showOptionMenu",
            "hideMenuItems",
            "showMenuItems",
            "hideAllNonBaseMenuItem",
            "showAllNonBaseMenuItem",
            "closeWindow",
            "scanQRCode",
            "chooseWXPay",
            "openProductSpecificView",
            "addCard",
            "chooseCard",
            "openCard"
          ],
        })
      })
      .catch(function (error) {
        console.log(error);
      });

    wx.ready(function () {
      console.log('微信config成功了')
      // config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready函数中。
    });

    wx.error(function (res) {
      console.log('微信config出错了')
      // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
    });
  },

  wx_common_share: () => {
    console.log('进入wx_common_share的函数')
    // 分享到朋友圈
    wx.onMenuShareTimeline({
      title: '无良老板压榨程序员', // 分享标题
      link: 'web.iamxuyuan.com', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
      imgUrl: '', // 分享图标
      success: function () {
        // 用户确认分享后执行的回调函数
        console.log('分享朋友圈成功')
      },
      cancel: function () {
        // 用户取消分享后执行的回调函数
        console.log('取消分享')
      }
    });

    //分享给微信好友
    wx.onMenuShareAppMessage({
      title: '无良老板压榨程序员', // 分享标题
      desc: '华工最大的同性交友平台', // 分享描述
      link: 'web.iamxuyuan.com', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
      imgUrl: '', // 分享图标
      //type: '', // 分享类型,music、video或link，不填默认为link
      //dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
      success: function () {
        // 用户确认分享后执行的回调函数
        console.log('分享给微信好友成功')
      },
      cancel: function () {
        // 用户取消分享后执行的回调函数
        console.log('取消分享')
      }
    });


    //分享到QQ
    wx.onMenuShareQQ({
      title: '无良老板压榨程序员', // 分享标题
      desc: '华工最大的同性交友平台', // 分享描述
      link: 'web.iamxuyuan.com', // 分享链接
      imgUrl: '', // 分享图标
      success: function () {
        // 用户确认分享后执行的回调函数
      },
      cancel: function () {
        // 用户取消分享后执行的回调函数
      }
    });


    //分享到QQ空间
    wx.onMenuShareQZone({
      title: '无良老板压榨程序员', // 分享标题
      desc: '华工最大的同性交友平台', // 分享描述
      link: 'web.iamxuyuan.com', // 分享链接
      imgUrl: '', // 分享图标
      success: function () {
        // 用户确认分享后执行的回调函数
      },
      cancel: function () {
        // 用户取消分享后执行的回调函数
      }
    });

    // 分享到腾讯微博
    wx.onMenuShareWeibo({
      title: '无良老板压榨程序员', // 分享标题
      desc: '华工最大的同性交友平台', // 分享描述
      link: 'web.iamxuyuan.com', // 分享链接
      imgUrl: '', // 分享图标
      success: function () {
        // 用户确认分享后执行的回调函数
      },
      cancel: function () {
        // 用户取消分享后执行的回调函数
      }
    });
  },

  //在活动详情页的分享设置
  wx_act_detail_share: (act_name, t_link) => {
    console.log('进入到wx_act_detail_share的函数啦')
    // 分享到朋友圈
    wx.onMenuShareTimeline({
      title: act_name, // 分享标题
      link: t_link, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
      imgUrl: '', // 分享图标
      success: function () {
        // 用户确认分享后执行的回调函数
      },
      cancel: function () {
        // 用户取消分享后执行的回调函数
      }
    });

    //分享给微信好友
    wx.onMenuShareAppMessage({
      title: act_name, // 分享标题
      desc: '快来参与' + act_name + '！我等你噢！', // 分享描述
      link: t_link, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
      imgUrl: '', // 分享图标
      //type: '', // 分享类型,music、video或link，不填默认为link
      //dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
      success: function () {
        // 用户确认分享后执行的回调函数
      },
      cancel: function () {
        // 用户取消分享后执行的回调函数
      }
    });


    //分享到QQ
    wx.onMenuShareQQ({
      title: act_name, // 分享标题
      desc: '快来参与' + act_name + '！我等你噢！', // 分享描述
      link: t_link, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
      imgUrl: '', // 分享图标
      success: function () {
        // 用户确认分享后执行的回调函数
      },
      cancel: function () {
        // 用户取消分享后执行的回调函数
      }
    });


    //分享到QQ空间
    wx.onMenuShareQZone({
      title: act_name, // 分享标题
      desc: '快来参与' + act_name + '！我等你噢！', // 分享描述
      link: t_link, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
      imgUrl: '', // 分享图标
      success: function () {
        // 用户确认分享后执行的回调函数
      },
      cancel: function () {
        // 用户取消分享后执行的回调函数
      }
    });

    // 分享到腾讯微博
    wx.onMenuShareWeibo({
      title: act_name, // 分享标题
      desc: '快来参与' + act_name + '！我等你噢！', // 分享描述
      link: t_link, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
      imgUrl: '', // 分享图标
      success: function () {
        // 用户确认分享后执行的回调函数
      },
      cancel: function () {
        // 用户取消分享后执行的回调函数
      }
    });
  }
}
