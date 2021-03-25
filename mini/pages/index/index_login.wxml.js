// pages/index/index_login.wxml.js
const app=getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {

  },

  /**
   * 生命周期函数--监听页面加载
   */

  onLoad: function (options) {
    wx.showLoading({
      title: '正在登录',
      mask: true,
    })
    wx.login({
      success(res) {
        if (res.code) {
          console.log(res.code);
          //发起网络请求
          wx.request({
            url: 'https://wx.lgyserver.top/login/wxlogin.php',
            data: {
              code: res.code
            },
            success: (res) => {
              wx.hideLoading();
              console.log(res.data);
              var a=res.data;
              if (res.data.code == 300) {
                wx.showToast({
                  title: "欢迎使用SmartXS!这是您第一次登陆，几秒后将会转到学校验证页面！",
                  icon: 'none',
                  image: '',
                  duration: 4000,
                  mask: true,
                  success: function (res) {
                    setTimeout(function () {
                      wx.navigateTo({
                        url: '/pages/index/index_schoolauth?openid=' + a.data.openid,
                      })
                    }, 4000)
                  },
                })
              }
              if (res.data.code == 200) {
                app.globalData.classID = res.data.data.classID;
                app.globalData.isClassAdmin = res.data.data.isClassAdmin;
                app.globalData.teacher_id = res.data.data.teacher_id;
                app.globalData.teacher_name = res.data.data.teacher_name;
                app.globalData.appsecret = res.data.data.appsecret;
                wx.redirectTo({
                  url: '/pages/index/index',
                })
              }
            }
          })
        } else {
          wx.showToast({
            title: '登陆失败，请检查授权后重试！',
            icon: 'none',
            duration: 2000,
            mask: true,
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

  },
  auth(e) {
    wx.showLoading({
      title: '正在登录',
      mask: true,
    })
    wx.login({
      success(res) {
        if (res.code) {
          console.log(res.code);
          //发起网络请求
          wx.request({
            url: 'https://wx.lgyserver.top/login/wxlogin.php',
            data: {
              code: res.code
            },
            success: (res) => {
              wx.hideLoading();
              console.log(res.data);
              var a = res.data;
              if (res.data.code == 300) {
                wx.showToast({
                  title: "欢迎使用SmartXS!这是您第一次登陆，几秒后将会转到学校验证页面！",
                  icon: 'none',
                  image: '',
                  duration: 4000,
                  mask: true,
                  success: function (res) {
                    setTimeout(function () {
                      wx.navigateTo({
                        url: '/pages/index/index_schoolauth?openid=' + a.data.openid,
                      })
                    }, 4000)
                  },
                })
              }
              if (res.data.code == 200) {
                app.globalData.classID = res.data.data.classID;
                app.globalData.isClassAdmin = res.data.data.isClassAdmin;
                app.globalData.teacher_id = res.data.data.teacher_id;
                app.globalData.teacher_name = res.data.data.teacher_name;
                app.globalData.appsecret = res.data.data.appsecret;
                wx.redirectTo({
                  url: '/pages/index/index',
                })
              }
            }
          })
        } else {
          wx.showToast({
            title: '登陆失败，请检查授权后重试！',
            icon: 'none',
            duration: 2000,
            mask: true,
          })
        }
      }
    })
  }
})