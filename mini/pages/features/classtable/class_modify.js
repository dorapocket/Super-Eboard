// pages/features/classtable/class_modify.wxml.js
const app=getApp();
var normalclass = [
  {
    'time': '第一节',
    'class': null,
  },
  {
    'time': '第二节',
    'class': null,
  },
  {
    'time': '第三节',
    'class': null,
  },
  {
    'time': '第四节',
    'class': null,
  },
  {
    'time': '时段一',
    'class': null,
  },
  {
    'time': '时段二',
    'class': null,
  },
  {
    'time': '第五节',
    'class': null,
  },
  {
    'time': '第六节',
    'class': null,
  },
  {
    'time': '第七节',
    'class': null,
  },
  {
    'time': '活动与辅导',
    'class': null,
  }
];
var emptyclass = [
  {
    'time': '第一节',
    'class': null,
  },
  {
    'time': '第二节',
    'class': null,
  },
  {
    'time': '第三节',
    'class': null,
  },
  {
    'time': '第四节',
    'class': null,
  },
  {
    'time': '时段一',
    'class': null,
  },
  {
    'time': '时段二',
    'class': null,
  },
  {
    'time': '第五节',
    'class': null,
  },
  {
    'time': '第六节',
    'class': null,
  },
  {
    'time': '第七节',
    'class': null,
  },
  {
    'time': '活动与辅导',
    'class': null,
  }
];
Page({

  /**
   * 页面的初始数据
   */
  data: {
    weekgo:false,
    picker: ['无'],
    weekList: ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'],
    weekIndex:null,
    classList:[]
  },
  submit(){
    let that=this;
    wx.request({
      url: 'https://wx.lgyserver.top/classtable/modifyClassTable.php',
      data:{
        week:that.data.weekIndex,
        classID:app.globalData.classID,
        classtable:that.data.classList,
        appsecret:app.globalData.appsecret
      },
      success:(res)=>{
        console.log(res.data);
        if(res.data.code==200){
          wx.showToast({
            title: '课表设置成功',
            icon: 'success',
            duration: 2000,
            mask: true,
          })
        }else{
          wx.showToast({
            title: "设置失败！错误原因："+res.data.msg,
            icon: 'none',
            duration: 2000,
            mask: true,
          })
        }
      }
    })
  },
  PickerChange(e) {

    console.log(this.data.classList);
    var now = parseInt(e.currentTarget.id);
    var templist=this.data.classList;
    templist[now]['class'] = this.data.picker[e.detail.value];
    this.setData({
      classList:templist
    })
  },
  WeekChange(e){
    this.setData({
      weekIndex: e.detail.value,
      weekgo:true
    })
    let that = this;
    wx.request({
      url: 'https://wx.lgyserver.top/classtable/getAllClass.php',
      data: {
        classID: app.globalData.classID,
        week: e.detail.value,
        appsecret:app.globalData.appsecret
      },
      success: (res) => {
        console.log(res.data);
        if(res.data.code==200){
          that.setData({
            classList: res.data.data
          })
        }else{
          that.setData({
            classList: emptyclass
          });
          wx.showToast({
            title: '今天还没有设置过课程~开始你的第一次设置吧！',
            icon: 'none',
            duration: 3000,
          })
        }
      }
    })
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    let that=this;
    wx.request({
      url: 'https://wx.lgyserver.top/classtable/getAllClassType.php',
      success:(res)=>{
        if(res.data.code==200){
          that.setData({
            picker:res.data.data
          });
        }else{
          wx.showToast({
            title: '还没有添加课程种类，请联系管理员添加！',
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

  }
})