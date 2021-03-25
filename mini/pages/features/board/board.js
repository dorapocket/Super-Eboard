// pages/features/board/board.js
const app=getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    imgList: [],
    imgListUpload:[],
    textareaBValue: '',
    modalName: null,
    index:null,
    isupload:false,
    title:"",
    picker: ['不紧急', '正常', '紧急'],
    campus:null,
    grade:null,
    classlist:null,
    multiArray: [
      ['请选择'],
      ['请选择'],
      ['请选择']
    ],
    multiIndex: [0, 0, 0],
  },
  submit(){
    if(this.data.isupload){
      return;
    }
    var that=this;
    wx.showLoading({
      title: '正在提交',
    })
    wx.request({
      url: 'https://wx.lgyserver.top/message/message_add.php',
      data:{
        "classID": that.data.classlist[that.data.multiIndex[2]]['classid'],
        "emergency": that.data.picker[that.data.index],
        "title": that.data.title,
        "message": that.data.textareaBValue,
        "images": JSON.stringify(that.data.imgListUpload), 
        "appsecret":app.globalData.appsecret,
        "teacherID": app.globalData.teacher_id
      },
      success(res) {
        console.log(that.data.classlist[that.data.multiIndex[2]]['classid']);
        console.log(res.data);
        wx.hideLoading();
        if(res.data.code==200){

          wx.showToast({
            title: '发布成功',
            icon: 'success',
            duration: 2000
          });
          setTimeout(function () {
            wx.navigateBack({

            });
          }, 2000)
        }else{
          wx.showToast({
            title: res.data.msg,
            icon: 'none',
            duration: 2000
          });
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
      url: 'https://wx.lgyserver.top/message/initPickList.php?method=campus',
      success:(res)=>{
        console.log(res.data.data.display);
        var temp=that.data.multiArray;
        temp[0] = res.data.data.display;
        that.setData({
          multiArray: temp,
          campus: res.data.data
        });
      }
    })
    wx.request({
      url: 'https://wx.lgyserver.top/message/initPickList.php',
      data: {
        'method': "grade",
        'campusid': 0
      },
      success: (res) => {
        var temp = that.data.multiArray;
        temp[1] = res.data.data.display;
        that.setData({
          multiArray: temp,
          grade: res.data.data
        });
      }
    })
    wx.request({
      url: 'https://wx.lgyserver.top/message/initPickList.php',
      data: {
        'method': "class",
        'campusid':0,
        'gradeid': 0
      },
      success: (res) => {
        var temp = that.data.multiArray;
        temp[2] = res.data.data.display;
        that.setData({
          multiArray: temp,
          classlist: res.data.data
        });
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

  MultiChange(e) {
    this.setData({
      multiIndex: e.detail.value
    })
  },
  MultiColumnChange(e) {
    let that=this;
    let data = {
      multiArray: this.data.multiArray,
      multiIndex: this.data.multiIndex
    };
    data.multiIndex[e.detail.column] = e.detail.value;
    switch (e.detail.column) {
      case 0:
        wx.request({
          url: 'https://wx.lgyserver.top/message/initPickList.php',
          data:{
            'method':"grade",
            'campusid': that.data.campus[that.data.multiIndex[0]]['campusid']
          },
          success: (res) => {
            console.log(res.data.data.display);
            //console.log(that.data.campus[that.data.multiIndex[0]]['campusid']);
            var temp = that.data.multiArray;
            temp[1] = res.data.data.display;
            that.setData({
              multiArray: temp,
              grade: res.data.data
            });
          }
        })
        data.multiIndex[1] = 0;
        data.multiIndex[2] = 0;
        break;
      case 1:
        wx.request({
          url: 'https://wx.lgyserver.top/message/initPickList.php',
          data: {
            'method': "class",
            'campusid': that.data.campus[that.data.multiIndex[0]]['campusid'],
            'gradeid': that.data.grade[that.data.multiIndex[1]]['gradeid']
          },
          success: (res) => {
            console.log(that.data.grade[that.data.multiIndex[1]]['gradeid']);
            console.log(res.data);
            console.log(res.data.data.display);
            //console.log(that.data.campus[that.data.multiIndex[0]]['campusid']);
            var temp = that.data.multiArray;
            temp[2] = res.data.data.display;
            that.setData({
              multiArray: temp,
              classlist: res.data.data
            });
          }
        })
        data.multiIndex[2] = 0;
        break;
    }
    this.setData(data);
  },
  PickerChange(e) {
    console.log(e);
    this.setData({
      index: e.detail.value
    })
  },
  textareaBInput(e) {
    this.setData({
      textareaBValue: e.detail.value
    })
  },
  ChooseImage() {
    wx.chooseImage({
      count: 4, //默认9
      sizeType: ['original', 'compressed'], //可以指定是原图还是压缩图，默认二者都有
      sourceType: ['album','camera'], //从相册选择
      success: (res) => {
        var that=this;
        var cnt=0;
        var all = res.tempFilePaths.length;
        wx.showLoading({
          title: '正在上传',
        })
        this.data.isupload=true;
        res.tempFilePaths.forEach(value=>{
          console.log(value);
          wx.uploadFile({
            url: 'https://wx.lgyserver.top/message/message_add_image.php',
            filePath: value,
            name: 'image',
            header: { "content-type": "application/json" },
            success: res => {
              var json = JSON.parse(res['data']);
              if (this.data.imgListUpload.length != 0) {
                that.setData({
                  imgListUpload: that.data.imgListUpload.concat([json['url']])
                })
              } else {
                that.setData({
                  imgListUpload: [json['url']]
                })
              }
              console.log(this.data.imgListUpload);
              cnt++;
              if (cnt == all){
                wx.hideLoading();
                this.data.isupload=false;
                wx.showToast({
                  title: '上传成功',
                  icon: 'success',
                  duration: 2000
                })
              }
            },
            fail:(res)=>{
              wx.hideLoading();
              this.data.isupload = false;
              wx.showToast({
                title: '上传失败，请检查网络',
                icon: 'none',
                duration: 2000
              })
            }
          })
          if (this.data.imgList.length != 0) {
            this.setData({
              imgList: this.data.imgList.concat([value])
            })
          } else {
            this.setData({
              imgList: [value]
            })
          }
        });
      }
    });
  },
  ViewImage(e) {
    wx.previewImage({
      urls: this.data.imgList,
      current: e.currentTarget.dataset.url
    });
  },
  DelImg(e) {
    wx.showModal({
      title: '删除',
      content: '确定要删除这张照片吗？',
      cancelText: '再看看',
      confirmText: '删了吧',
      success: res => {
        if (res.confirm) {
          this.data.imgList.splice(e.currentTarget.dataset.index, 1);
          this.setData({
            imgList: this.data.imgList
          })
        }
      }
    })
  },
  titleinput(e){
    this.setData({
      title:e.detail.value
    })
  }
})