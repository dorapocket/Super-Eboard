// pages/features/register/register_new.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    time: '12:01',
    modalName:null,
    multiArray: [
      ['全部', '东部校区', '白杨校区'],
      ['全部', '高一', '高二', '高三'],
      ['全部', '一班', '二班', '三班', '四班', '五班', '六班', '七班', '八班', '九班', '十班', '十一班', '十二班']
    ],
    multiIndex: [0, 0, 0],
  },
  goback(){
    wx.navigateBack({
      
    })
  },
  TimeChange(e) {
    this.setData({
      time: e.detail.value
    })
  },
  MultiChange(e) {
    this.setData({
      multiIndex: e.detail.value
    })
  },
  MultiColumnChange(e) {
    let data = {
      multiArray: this.data.multiArray,
      multiIndex: this.data.multiIndex
    };
    data.multiIndex[e.detail.column] = e.detail.value;
    switch (e.detail.column) {
      case 0:
        switch (data.multiIndex[0]) {
          case 0:
            break;
          case 1:
            break;
        }
        data.multiIndex[1] = 0;
        data.multiIndex[2] = 0;
        break;
      case 1:
        switch (data.multiIndex[0]) {
          case 0:
            switch (data.multiIndex[1]) {
              case 0:

                break;
              case 1:

                break;
              case 2:

                break;
              case 3:

                break;
              case 4:

                break;
            }
            break;
          case 1:
            switch (data.multiIndex[1]) {
              case 0:

                break;
              case 1:

                break;
              case 2:

                break;
            }
            break;
        }
        data.multiIndex[2] = 0;
        break;
    }
    this.setData(data);
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