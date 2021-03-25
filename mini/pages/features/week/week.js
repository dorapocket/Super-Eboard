// pages/features/week/week.js
const app=getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    allScore:0,
    scoreList:[]
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    let that=this;
    wx.request({
      url: 'https://wx.lgyserver.top/clean/queryCleanInf.php',
      data:{
        classID:app.globalData.classID,
        appsecret:app.globalData.appsecret
      },
      success:(res)=>{
        console.log(res.data);
        if(res.data.code==200){
        that.setData({
          scoreList:res.data.data,
          allScore:res.data.allscore
        });}else{
          if(res.data.code==201){
            wx.showToast({
              title: '还没有扣过分哦！继续保持！',
              icon: 'none',
              duration: 2000,
              complete: function(res) {
                setTimeout(function () {
                  wx.navigateBack({

                  });
                }, 2000)
              },
            })
          }else{
            wx.showToast({
              title: '数据请求错误！信息：'+res.data.msg+"对您带来的不便敬请谅解！",
              icon: 'none',
              duration: 2000,
            })
          }
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