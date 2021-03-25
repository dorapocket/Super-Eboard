
<template>
  <div class="webrtc_face_detector">
   
    <v-row justify="center" align="center">
      <div class="text-center ma-12">
        <p>{{msg}}</p>
        <v-progress-circular rotate="-90" size="350" :value="value" width="8" color="light-blue" style="margin-top:50px;">
          
          <div class="see">
            
            <video
              id="myVideo"
              muted
              loop
              playsinline
              @loadedmetadata="fnRun"
              style="border-radius:50%;"
            ></video>
            <canvas id="myCanvas" style="display:none" />

          </div>
        </v-progress-circular>
      </div>
    </v-row>
  </div>
</template>

<script>
import * as faceapi from "face-api.js";
import Qs from 'qs';
export default {
  name: "WebRTCFaceDetector",
  data() {
    return {
      msg:"请稍后...",
      value: 0,
      axiosbusy:false,
      nets: "ssdMobilenetv1", // 模型
      options: null, // 模型参数
      detectFace: "detectSingleFace", // 单or多人脸
      videoEl: null,
      canvasEl: null,
      tempcanvasEL:null,
      timeout: 0,
      ctimeout:0,
      recflag:false,
      // 视频媒体参数配置
      constraints: {
        audio: false,
        video: {
          // ideal（应用最理想的）
          width: {
            min: 320,
            ideal: 320,
            max: 1920
          },
          height: {
            min: 240,
            ideal: 320,
            max: 1080
          },
          // frameRate受限带宽传输时，低帧率可能更适宜
          frameRate: {
            min: 15,
            ideal: 30,
            max: 60
          },
          // 显示模式前置后置
          facingMode: "environment"
        }
      }
    };
  },
  watch: {
    nets(val) {
      this.nets = val;
      this.fnInit();
    }
  },
  mounted() {
    this.$nextTick(() => {
      this.fnInit();
      this.fnOpen();
    });
  },
  methods: {
    getfaceto64() {
      var c = document.createElement("canvas");
      var v = this.videoEl;
      var height = v.videoHeight;
      var width = v.videoWidth;
      var ctx = c.getContext("2d");
      c.height = height;
      c.width = width;
      ctx.drawImage(v, 0, 0, width, height);
      var url = c.toDataURL("image/jpeg", 1);
      //console.log(url);
      return url;
    },
    // 初始化模型加载
    async fnInit() {
      await faceapi.nets[this.nets].loadFromUri("/models");
      // 根据模型参数识别调整结果
      switch (this.nets) {
        case "ssdMobilenetv1":
          this.options = new faceapi.SsdMobilenetv1Options({
            minConfidence: 0.5 // 0.1 ~ 0.9
          });
          break;
      }
      // 节点属性化
      this.videoEl = document.getElementById("myVideo");
      this.canvasEl = document.getElementById("myCanvas");
      

    },
    // 节点对象执行递归识别绘制
    async fnRun() {
      console.log("Run");
      // 识别绘制人脸信息
      const result = await faceapi[this.detectFace](this.videoEl, this.options);
      if (result && !this.videoEl.paused&&!this.recflag) {
        this.value=60;
        this.brz=true;
        this.msg="努力辨认中...";
        //console.log("bianrenzhong!!");
        var img=this.getfaceto64();
        //console.log(img);
        this.getface(img);
        //const dims = faceapi.matchDimensions(this.canvasEl, this.videoEl, true);
        //const resizeResults = faceapi.resizeResults(result, dims);
        //faceapi.draw.drawDetections(this.canvasEl, resizeResults);
        
      } else {
        this.canvasEl
          .getContext("2d")
          .clearRect(0, 0, this.canvasEl.width, this.canvasEl.height);
      }
      //this.value=40;
      if(!this.brz){
        this.msg="对着镜头笑一个吧！";
        clearTimeout(this.timeout);
        this.timeout = setTimeout(() => this.fnRun());
      }
    },
    // 启动摄像头视频媒体
    fnOpen() {
      if (typeof window.stream === "object") return;
      clearTimeout(this.timeout);
      this.timeout = setTimeout(() => {
        clearTimeout(this.timeout);
        navigator.mediaDevices
          .getUserMedia(this.constraints)
          .then(this.fnSuccess)
          .catch(this.fnError);
      }, 300);
     
    },
    // 成功启动视频媒体流
    fnSuccess(stream) {
      window.stream = stream; // 使流对浏览器控制台可用
      this.videoEl.srcObject = stream;
      this.videoEl.play();
      
    },
    // 失败启动视频媒体流
    fnError(error) {
      console.log(error);
      this.msg="获取摄像头权限出错";
      //alert("视频媒体流获取错误" + error);
    },
    // 结束摄像头视频媒体
    fnClose() {
      this.canvasEl
        .getContext("2d")
        .clearRect(0, 0, this.canvasEl.width, this.canvasEl.height);
      this.videoEl.pause();
      clearTimeout(this.timeout);
      if (typeof window.stream === "object") {
        window.stream.getTracks().forEach(track => track.stop());
        window.stream = "";
        this.videoEl.srcObject = null;
      }
    },
    getface(img){
      let that=this;
      let data={
        "image":img.replace(/^data:image\/\w+;base64,/, "")
      }
      if(!this.axiosbusy){
      this.axiosbusy=true;
      axios.post(`/face/eboard/recognize.php`,Qs.stringify(data),{
          headers:{'Content-Type':'application/x-www-form-urlencoded'}
        })
        .then(function (response) {
            if(response.data.error_code==0&&response.data.result.user_list[0]){
              let id=response.data.result.user_list[0].user_id;
              console.log(id);
              that.msg="欢迎，"+id;
              that.value=100;
              that.recflag=true;
              setTimeout(function(){
              that.$emit('childFn',id);
              that.axiosbusy=false;
              that.fnClose();
              }, 1000);
              
            }
            if(response.data.error_code==222207){
              clearTimeout(that.timeout);
              that.value=0;
              that.msg="我不认识你哦，请重试！";
              console.log("wrong user");
              that.timeout = setTimeout(function(){
                that.brz=false;
                that.axiosbusy=false;
                that.recflag=false;
                that.fnRun();
                },2000);
            }
            //this.$emit('childFn', this.message);
        })
        .catch(function (error) {
          //clearTimeout(this.timeout);
          that.value=20;
          that.msg="网络连接有误，请稍后重试吧！";
          that.axiosbusy=true;
          console.log("face-err:"+error);
        });
      }

    }
  },
  beforeDestroy() {
    this.fnClose();
  }
};
</script>

<style scoped>
p {
  padding-left:35px;
  margin-top:-50px;
  font-size:40px;
}
.see {
  position: relative;
  width: 320px;
  height: 320px;
  border-radius: 50%;
}
.see canvas {
  position: absolute;
  top: 0;
  left: 0;
}
</style>
