// pages/profile/home/home.js
const app = getApp()
Component({
  options: {
    addGlobalClass: true,
  },
  data: {
    name:"",
    starCount: 0,
    forksCount: 0,
    visitTotal: 0,
    userInfo: {},
    hasUserInfo: false,
    canIUse: wx.canIUse('button.open-type.getUserInfo')
  },


  attached() {
    this.setData({
      name:app.globalData.teacher_name
    });

    var unread_cnt;
    let that = this;
    wx.request({
      url: 'https://wx.lgyserver.top/unread/unread_teacher.php',
      data:{
        teacherID:app.globalData.teacher_id,
        appsecret:app.globalData.appsecret
      },
      success:(res)=>{
        if (res.data.code == 200 || res.data.code ==201){
          unread_cnt = res.data.cnt;
        }else{
          wx.showToast({
            title: '信息加载失败，请检查网络',
            icon: 'none',
            duration: 2000,
          })
        }
      }
    })
    wx.getSetting({
      success(res) {
        if (!res.authSetting['scope.userInfo']) {
          // 已经授权，可以直接调用 getUserInfo 获取头像昵称
          wx.authorize({
            scope: 'scope.userInfo',
            success() {
              // 用户已经同意小程序使用录音功能，后续调用 wx.startRecord 接口不会弹窗询问
            }
          })
        }
      }
    })
    console.log("success")
    wx.showLoading({
      title: '数据加载中',
      mask: true,
    })
    let i = 0;
    numDH();
    function numDH() {
      if (i < 20) {
        setTimeout(function () {
          that.setData({
            starCount: i,
            forksCount: i,
            visitTotal: i
          })
          i++
          numDH();
        }, 20)
      } else {
        that.setData({
          forksCount: that.coutNum(0),
          visitTotal: that.coutNum(unread_cnt)
        })
      }
    }
    wx.hideLoading()
  },
  methods: {
    coutNum(e) {
      if (e > 1000 && e < 10000) {
        e = (e / 1000).toFixed(1) + 'k'
      }
      if (e > 10000) {
        e = (e / 10000).toFixed(1) + 'W'
      }
      return e
    },
    showModal(e) {
      this.setData({
        modalName: e.currentTarget.dataset.target
      })
    },
    hideModal(e) {
      this.setData({
        modalName: null
      })
    },
  }
})