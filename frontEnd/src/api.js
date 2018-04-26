const domain_name = 'http://web.iamxuyuan.com';
export default {
  get_acts: domain_name + "/activities/getacts",
  get_activity_by_id: function (id) {
    return domain_name + "/activities/getinfo?id=" + id;
  },
  get_activity_after_select: function (time, type) {
    return domain_name + "/activities/getacts?days=" + time + "&type=" + type;
  },
  get_recommend_activity: domain_name + '/activities/getacts?recommend=yes',
  get_user_init_setting: domain_name+"/user/getrule",
  set_user_setting: domain_name + '/user/setrule',
  post_code: domain_name+ "/user/getuserid",
  get_timestamp: domain_name + "/weixin/gettimestamp",
  get_nonceStr: domain_name +"/weixin/getnoncestr",
  get_signature: domain_name+"/weixin/signature",
  get_wx_config: domain_name+"/weixin/getjsapi",
  check_if_follow: domain_name+"/weixin/check_if_follow"
}
