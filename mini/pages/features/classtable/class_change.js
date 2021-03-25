// pages/features/classtable/class_change.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    type:['临时换课','永久换课'],
    week: ['星期一', '星期二', '星期三', '星期四', '星期五'],
    week1:null,
    week2:null,
    date1: '2019-09-08',
    date2: '2019-09-08',
    typeindex:null,
    index1:null,
    index2: null,
    classnum: ['第一节', '第二节', '第三节', '第四节', '第五节', '第六节', '第七节', '第八节', '第九节'],
  },
  WeekChange1(e) {
    this.setData({
      week1: e.detail.value
    })
  },
  WeekChange2(e) {
    this.setData({
      week2: e.detail.value
    })
  },
  DateChange1(e) {
    this.setData({
      date1: e.detail.value
    })
  },
  DateChange2(e) {
    this.setData({
      date2: e.detail.value
    })
  }, 
  TypeChange(e) {
    console.log(e);
    this.setData({
      typeindex: e.detail.value
    })
  },
  PickerChange1(e) {
    console.log(e);
    this.setData({
      index1: e.detail.value
    })
  },
  PickerChange2(e) {
    console.log(e);
    this.setData({
      index2: e.detail.value
    })
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {

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