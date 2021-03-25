// pages/features/home/home.js
const app=getApp();
Component({
  options: {
    addGlobalClass: true,
  },
  data: {
    isClassAdmin:false,
    features:[
      {
        'feature_name':'通知',
        'feature_icon': 'comment',
        'isShow':true,
        'classAdmin':false,
        'feature_route':'/pages/features/board/board'
      },
      {
        'feature_name': '请假',
        'feature_icon': 'profile',
        'isShow': true,
        'classAdmin': true,
        'feature_route': '/pages/features/leave/leave_route'
      },
      {
        'feature_name': '值周',
        'feature_icon': 'activity',
        'isShow': true,
        'classAdmin': true,
        'feature_route': '/pages/features/week/week_route'
      },
      {
        'feature_name': '课表',
        'feature_icon': 'sort',
        'isShow': true,
        'classAdmin': true,
        'feature_route': '/pages/features/classtable/class_modify'
      },
      {
        'feature_name': '考勤',
        'feature_icon': 'roundcheck',
        'isShow': false,
        'classAdmin': false,
        'feature_route': '/pages/features/register/register'
      },
    ]
  },
  attached: function () {
    if(app.globalData.isClassAdmin==1){
      this.setData({
        isClassAdmin:true
      });
    }else{
      this.setData({
        isClassAdmin: false
      });
    }
  }
})