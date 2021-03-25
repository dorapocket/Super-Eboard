const app=getApp();
Component({
  options: {
    addGlobalClass: true,
  },
  data: {
    balance:"待接入",
    aqi:"0",
    weathermsg:"",
    icon:"",
    week:"周一",
    hightmp:"0",
    lowtmp:"0",
    now:"0",
    month:"1",
    day:"1",
    ready:false,
    noUnread:false,
    unreadList: [],
  },
  attached: function () {
    wx.showLoading({
      title: '玩命加载中',
    })
    var that = this;
    wx.request({
      url: "https://wx.lgyserver.top/pandect.php",
      success(res) {
        var inf=res.data;
        that.setData({
          week: inf['time']['week'],
          hightmp: inf['weather']['highest'],
          lowtmp: inf['weather']['lowest'],
          now: inf['weather']['now'],
          month: inf['time']['month'],
          day: inf['time']['day'],
          weathermsg:inf['weather']['text'],
          icon:inf['weather']['icon'],
          aqi:inf['weather']['aqi'],
          ready:true,
          
        });
        wx.hideLoading();
      }
    })

    wx.request({
      url: 'https://wx.lgyserver.top/unread/unread_teacher.php',
      data:{
        teacherID:app.globalData.teacher_id,
        appsecret: app.globalData.appsecret
      },
      success:(res)=>{
        if(res.data.code==200){
          that.setData({
            unreadList: res.data.data
          });
        }else{
          if (res.data.code == 201) {
            that.setData({
              noUnread:true
            });
          }else{
            wx.showToast({
              title: '网络请求错误',
              icon:"none"
            })
          }
        }
      }
    })
  },
})