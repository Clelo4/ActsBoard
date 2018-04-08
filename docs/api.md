
__[To Client]__ *对外接口*

# __Activities__
### _Author：_ _jack_
### _Time：_ _2018-04-05_
### _Email：_ _jack0000davis@gmail.com_
### _API 文档版本：_ v1.0

---
<br>

## **API简述:**

<div id='u'>

### __用户端__
>

>**[GET] 根据活动id获取该活动的所有信息：**  _[/activities/getinfo?id={}](#u1)_

>**[GET] 根据条件筛选活动列表：**  _[/activities/getacts?{}={}](#u2)_

>**[GET] 获取默认活动列表：**   _[/activities/getacts](#u3)_

>**[GET] 根据user获取推荐的活动列表：**   _[/activities/getacts?type=recommend&user_id={}](#u4)_

>**[POST] 设定用户推送规则：** _[/user/setrule](#u5)_

>**[POST] 发布活动信息：** _[/activities/publish](#u6)_

</div>
---
<div id='a'>

### __管理端__:
>

>**[POST] 管理员登录：** _[/manage/admin/login](#a1)_

>**[GET] 获取活动列表：** _[/manage/getacts?start={}&nums={}](#a2)_

>**[GET] 获取特定类别的活动列表：** _[/manage/getacts?type={}](#a3)_

>**[POST] 用户管理：** _[/manage/admin/user](#a4)_

>**[POST] 活动管理：** _[/manage/admin/activities](#a5)_

>**[POST] 推送管理：** _[/manage/admin/recommend](#a6)_

</div>

---
<br>

## **字段说明：**

### **通用字段说明：**
| 参数名 | 类型 | 含义 | 备注 |
| --- | --- | --- | --- |
| id | string | 活动唯一id  | '20181022001' (11位) |
| type | string | 特定的类型 | 依据接口的要求为准 |
| name | string | 活动名称 | 1-255位 |
| valid_date | string| 活动信息的最后有效期 | 2018-09-09 23:59:59 |
| sort | int | 排序方式 | 1：按有效期由近及远、2：按有效期由远及近、3：按活动信息创建时间由久到近 |
| taglist | string | 标签列表 | 'tag1,tag2,ta3' |
| sex | int | 性别 | 性别：1男 2女 |
| school | string | 学校 | |
| litimg_url | string | 缩略图链接 | 1-255位字符 |
| pic_url | string | 图片链接 | 1-255位字符 |
| birthday | string | 生日 | 2018-03-06 |
| apply_way | string | 申请方式 | |
| url | string | 活动链接 | 1-255位 |
| location | string | 活动地点 | |
| content | string | 文本内容 | |
| username  |  string |  账号名  |  6-15位字符,只能包含英文字母、数字、下 划线，不含空格(不区分大小写)  |
| password  |  string  | 密码  |  6-18位字符,可包含数字，字母(区分大小写)  |
| token | string | 令牌 |  |
| user_id  | string  |  用户  |  (11位)  |
| post_id   |  int | 部门 |  |

<br>

### **请求字段说明：**
| 参数名 | 类型 | 含义 | 备注 |
| --- | --- | --- | --- |
| page | int  | 页数 | 分页获取数据时的参数 |
<br>

### **返回值字段说明：**
| 参数名 | 类型 | 含义 | 备注 |
| --- | --- | --- | --- |
| errcode | int | 返回状态 | 0为成功 |
| errmsg | string | error说明 |
| data | 各种类型 | 返回数据 |  |
---
<br>

## __返回数据格式说明：__
> 成功返回示例：
``` 
{
    'errcode':0,
    'data':(返回数据，可以json类型或其他类型),
    'errmsg':''
}
```

> 失败返回示例：
``` 
{
    'errcode':(错误代码),
    'errmsg':(错误信息说明)
}
```

---
<br>

## __API详细说明：__

<div id='u1'>

> [GET] 根据活动id获取该活动的所有信息：  _/activities/getinfo?id={}_
+ 请求参数：id (活动id)
```
// 返回实例
{
    'errcode':0,
    'data':{
        'id':1,
        'type':'讲座',                // 活动类别
        'name':'ActsBoard讲座',           // 活动名称
        'valid_date':'2019-09-09',     // 该信息的有效日期，截止到那天23:59
        'apply_way':'',                   // 申请方式
        'school':'华南理工大学',                    // 学校
        'taglist':'有趣,无聊,妹子多',               // 活动标签
        'url':'http://www.scut.edu.cn',   // 活动链接
        'litimg_url':'http://www.scut.edu.cn',     // 活动缩略图
        'pic_url':'http://www.scut.edu.cn',    // 活动图片原图
        'location':'华南理工大学'               // 活动地点
        'act_detail':'ActsBoard是一家五百强企业，融资400个亿...'   // 活动内容
    }
    'errmsg':''
}
```
[返回](#u)
</div>

<div id='u2'>

> [GET] 根据条件筛选活动列表：**  _/activities/getacts?{}={}_
+ 请求参数(自由组合)：
  + days:时间(可选)
  + type:活动类别(可选),
  + school:学校(可选)
  + sort:排序方式(可选)
  + page:页数(可选)
+ 省略的参数默认值：全部

```
// 返回实例
{
    'errcode':0,
    'data':[
        {
        'id':1,
        'type':'讲座',                // 活动类别
        'name':'ActsBoard讲座',           // 活动名称
        'valid_date':'2019-09-09',     // 该信息的有效日期，截止到那天23:59
        'school':'华南理工大学',                    // 学校
        'taglist':'有趣,无聊,妹子多',               // 活动标签
        'litimg_url':'http://www.scut.edu.cn',     // 活动缩略图
        'pic_url':'http://www.scut.edu.cn',    // 活动图片原图
        'location':'华南理工大学'               // 活动地点
        'act_detail':'ActsBoard是一家五百强企业，融资400个亿...'   // 活动内容
    },
        ...
    ],
    'errmsg':''
}
```
[返回](#u)
</div>

<div id='u3'>

> [GET] 获取默认活动列表：**   _/activities/getacts_
+ 请求参数：
  + page:页数(可选)
```
// 返回实例
{
    'errcode':0,
    'data':[
        {
        'id':1,
        'type':'讲座',                // 活动类别
        'name':'ActsBoard讲座',           // 活动名称
        'valid_date':'2019-09-09',     // 该信息的有效日期，截止到那天23:59
        'school':'华南理工大学',                    // 学校
        'taglist':'有趣,无聊,妹子多',               // 活动标签
        'litimg_url':'http://www.scut.edu.cn',     // 活动缩略图
        'pic_url':'http://www.scut.edu.cn',    // 活动图片原图
        'location':'华南理工大学'               // 活动地点
        'act_detail':'ActsBoard是一家五百强企业，融资400个亿...'   // 活动内容
    },
        {},
        {},
    ],
    'errmsg':''
}
```

[返回](#u)
</div>

<div id='u4'>

> [GET] 根据user获取推荐的活动列表：**  _/activities/getacts?type=recommend&user_id={}_
+ 请求参数：
  + user_id：用户id(必选)
  + page：页数(可选)
```
// 返回实例
{
    'errcode':0,
    'data':[
        {
        'id':1,
        'type':'讲座',                // 活动类别
        'name':'ActsBoard讲座',           // 活动名称
        'valid_date':'2019-09-09',     // 该信息的有效日期，截止到那天23:59
        'school':'华南理工大学',                    // 学校
        'taglist':'有趣,无聊,妹子多',               // 活动标签
        'litimg_url':'http://www.scut.edu.cn',     // 活动缩略图
        'pic_url':'http://www.scut.edu.cn',    // 活动图片原图
        'location':'华南理工大学'               // 活动地点
        'act_detail':'ActsBoard是一家五百强企业，融资400个亿...'   // 活动内容
        },
        {},
        {},
        ....
    ],
    'errmsg':'',
}
```
[返回](#u)
</div>

<div id='u5'>

> [POST] 设定用户推送规则：** _/user/setrule_
+ 请求参数
  + user_id:用户id(必选)
  + school:学校(必选)
  + frequency:频率(必选)
  + type:活动类型(必选)
```
// 返回实例
{
    'errcode':0,
    'data':'success',
    'errmsg':''
}
```
[返回](#u)
</div>

<div id='u6'>

> [POST] 发布活动信息：** _/activities/publish_
+ 请求参数:
  + type:活动类别
  + name:活动名称
  + valid_date:该信息的有效日期，截止到那天23:59:59
  + school:学校
  + taglist:活动标签
  + litimg_url:活动缩略图
  + pic_url:活动图片原图
  + location:活动地点
  + act_detail:活动内容

```
// 返回实例
{
    'errcode':0,
    'data':'success',
    'errmsg':''
}
```
[返回](#u)
</div>

<div id='a1'>

> [POST] 管理员登录：** _/manage/admin/login_
+ 请求参数：
  + username:用户名
  + password:密码
  + token:登录令牌Token(存在就发送)
  + key:保留关键字(暂不使用)

```
// 返回实例
{
    'errcode':0,
    'data':'success',
    'errmsg':''
}
```
[返回](#a)
</div>

<div id='a2'>

> [GET] 查询活动列表：** _/manage/getacts?start={}&nums={}_
+ 请求参数：
  + start:开始页数(必选)
  + nums:查询数目(必选)
```
请求实例:
 /manage/getcats?start=0&nums=20
 /manage/getcats?start=20&nums=20
```
[返回](#a)
</div>

<div id='a3'>

> [GET] 获取特定类别的活动列表：** _/manage/getacts?type={}&sort={}_
+ 请求参数：
  + type:活动类别
  + sort:排序方式
```
// 返回实例
{
    'errcode':0,
    'data':[
        {
        'id':1,
        'type':'讲座',                // 活动类别
        'name':'ActsBoard讲座',           // 活动名称
        'valid_date':'2019-09-09',     // 该信息的有效日期，截止到那天23:59
        'school':'华南理工大学',                    // 学校
        'taglist':'有趣,无聊,妹子多',               // 活动标签
        'litimg_url':'http://www.scut.edu.cn',     // 活动缩略图
        'pic_url':'http://www.scut.edu.cn',    // 活动图片原图
        'location':'华南理工大学'               // 活动地点
        'act_detail':'ActsBoard是一家五百强企业，融资400个亿...'   // 活动内容
        },
        {},
        {},
        ....
    ],
    'errmsg':'',
}
```
[返回](#a)
</div>

<div id='a4'>

> [POST] 用户管理：** _/manage/admin/user_
+ 请求参数：
```

```
[返回](#a)
</div>

<div id='a5'>

> [POST] 活动管理：** _/manage/admin/activities_
+ 请求参数：
```

```
[返回](#a)
</div>

<div id='a6'>

> [POST] 推送管理：** _/manage/admin/recommend_
+ 请求参数：
```

```
[返回](#a)
</div>
