// pages/features/week/week_clean.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    weekgo: false,
    picker: ['无'],
    weekList: ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'],
    weekIndex: null,
    cleanList:[],
  },
  textchange:function(e){
    var tempList=this.data.cleanList;
    tempList[parseInt(e.target.id)]=e.detail.value;
    this.setData({
      cleanList: tempList
    })
  },
  /**
   * 生命周期函数--监听页面加载
   */
  addstu:function (){
    var temp=this.data.cleanList;
    temp.push("");
    this.setData({
      cleanList:temp
    });
  },
  WeekChange(e) {
    this.setData({
      weekIndex: e.detail.value,
      weekgo: true,
      cleanList: [],
    })
    let that = this;
  },
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