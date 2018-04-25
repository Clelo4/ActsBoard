const domain_name = 'http://web.iamxuyuan.com';
export default {
  get_acts: domain_name + "/activities/getacts",
  get_activity_by_id: function (id) {
    return domain_name + "/activities/getinfo?id=" + id;
  },
  get_activity_after_select: function (time, type) {
    return domain_name + "/activities/getacts?time=" + time + "?type" + type;
  },
  get_recommend_activity: domain_name + '/activities/getacts?recommend=yes',
  get_user_init_setting: "...",
  set_user_setting: domain_name + '/user/setrule',
  post_code: "..."
}
