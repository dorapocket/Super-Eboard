// pages/features/leave/leave.js
const app=getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    undeal:0,
    today_leave:0,
    undealList:[]
  },
  agree(e){
    var that = this;
    console.log(e);
    wx.request({
      url: 'https://wx.lgyserver.top/leave/leave_deal.php',
      data: {
        id: e.currentTarget.id,
        result: "agree",
        teacherID:app.globalData.teacher_id,
        appsecret: app.globalData.appsecret
      },
      success: (res) => {
        console.log(res.data);
        if (res.data.code==200)
          wx.showToast({
            title: '审批成功',
            icon: 'success',
            duration: 2000
          });

        wx.request({
          url: 'https://wx.lgyserver.top/leave/leave_query.php',
          data: {
            teacherID: app.globalData.teacher_id,
            appsecret: app.globalData.appsecret
          },
          success: (res) => {
            var inf = res.data;
            console.log(inf);
            that.setData({
              undeal: inf.cnt,
              undealList: inf.data
            });
          }
        })
      }
    })

  },
  disagree(e) {
    var that = this;
    console.log(e);
    wx.request({
      url: 'https://wx.lgyserver.top/leave/leave_deal.php',
      data: {
        id: e.currentTarget.id,
        result: "disagree",
        teacherID: app.globalData.teacher_id,
        appsecret: app.globalData.appsecret
      },
      success: (res) => {
        console.log(res.data);
        if (res.data.code == 200)
          wx.showToast({
            title: '审批成功',
            icon: 'success',
            duration: 2000
          });

        wx.request({
          url: 'https://wx.lgyserver.top/leave/leave_query.php',
          data: {
            teacherID: app.globalData.teacher_id,
            appsecret: app.globalData.appsecret
          },
          success: (res) => {
            var inf = res.data;
            console.log(inf);
            that.setData({
              undeal: inf.cnt,
              undealList: inf.data
            });
          }
        })
      }
    })

  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that=this;
    wx.request({
      url: 'https://wx.lgyserver.top/leave/leave_query.php',
      data:{
        teacherID: app.globalData.teacher_id,
        appsecret: app.globalData.appsecret
      },
      success:(res)=>{
        var inf=res.data;
        console.log(inf);
        that.setData({
          undeal:inf.cnt,
          undealList:inf.data
        });
        if(res.data.code!=200){
          wx.showToast({
            title: res.data.msg,
            icon: 'none',
            duration: 2000,
          })
        }
      }
    })
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})