<template>
  <div>
    <v-dialog
      v-model="dialog_message"
      max-width="80vw"
      max-height="80vh"
      class="hola-card-message-commander"
    >
      <div class="hola-card hola-card-message-commander" style="margin-bottom:0;">
        <v-container v-bind:class="backgroundClass">
          <v-row align="center" align-content="center">
            <v-col
              align-self="center"
              style="text-align:center!important; margin-top:5vh;margin-bottom:3vh;"
            >
              <i v-bind:class="iconClass" style="font-size:10rem;color:white!important;"></i>
            </v-col>
          </v-row>
          <v-row align="center" align-content="center">
            <v-col align-self="center" style="text-align:center!important;margin-bottom:4vh;">
              <h2
                class="hola-card-title hola-card-title-changed-commander"
                style="font-size:3.5rem;"
              >{{cdialog_title}}</h2>
            </v-col>
          </v-row>
        </v-container>
        <div style="padding:50px;">
          <div class="dialog-context-commander">{{cdialog_context}}</div>
          <v-img v-bind:key="index" v-for="(item, index) in cdialog_images" v-bind:src="item"></v-img>
        </div>
      </div>
    </v-dialog>
    <v-overlay
      opacity="1"
      z-index="5"
      :value="silenceDialog"
      style=""
    >
      <div style="font-size:14vw;text-align:center;">{{nowTime[0]}} : {{nowTime[1]}}</div>
      <div style="font-size:5vw;margin:20vw 0vw 0vw 2vw;">『</div>
      <div style="font-size:5vw;margin:3vw 14vw 3vw 14vw;text-align:center;">{{hitokoto.hitokoto}}</div>
      <div style="font-size:5vw;text-align:right;margin:0vw 2vw 0vw 0vw;">』</div>
      <div style="font-size:4vw;text-align:right;margin:5vw 4vw 0vw 0vw;">-「{{hitokoto.from}}」</div>
      <div style="font-size:5vw;text-align:center;color:gray;margin-top:20vw;font-weight:600;" v-on:click="silenceDialog=!silenceDialog">退出静默</div>
    </v-overlay>
  </div>
</template>
<style>
.hola-card-message-commander {
  padding: 0 !important;
  box-shadow: 0 0 25px rgb(229, 115, 115);
}
.dialog-context-commander {
    z-index:50!important;
  font-size: 2.2rem;
}
.hola-card-title-changed-commander-warning {
  color: white;
  background-color: #f44336;
}
.hola-card-title-changed-commander-normal {
  color: white;
  background-color: #4caf50;
}
</style>
<script>
import { getUrlParam } from "../GetUrlParam";
import { setInterval } from "timers";
let cid = 1;//getUrlParam("ClassID");
export default {
  data: () => ({
    iconClass: {
      fa: true,
      "fa-exclamation-triangle": false,
      "fa-exclamation-circle": true
    },
    backgroundClass: {
      "hola-card-title-changed-commander-warning": false,
      "hola-card-title-changed-commander-normal": true
    },
    dialog_message: false,
    cdialog_title: "",
    cdialog_context: "",
    cdialog_images: [],
    classTime: [],
    nowTime: [],
    hitokoto: {},
    silenceDialog: false,
    silenceDialogPrep: false
  }),
  methods: {
    dealCommand: function(command) {
      let that = this;
      if (command.type == "messages") {
        axios
          .get(`/eboard/getClassMessageByID.php`, {
            params: {
              messageID: command.typeid
            }
          })
          .then(function(response) {
            if (response.data.data.emergency == "紧急") {
              that.cdialog_title = response.data.data.title;
              that.cdialog_context = response.data.data.message;
              that.cdialog_images = response.data.data.images;
              that.iconClass = {
                fa: true,
                "fa-exclamation-triangle": true,
                "fa-exclamation-circle": false
              };
              that.backgroundClass = {
                "hola-card-title-changed-commander-warning": true,
                "hola-card-title-changed-commander-normal": false
              };
              that.dialog_message = true;
              axios.get(`/eboard/read_class.php`, {
                params: {
                  id: command.id,
                  classID: cid
                }
              });
            } else {
              if (!that.dialog_message) {
                that.cdialog_title = response.data.data.title;
                that.cdialog_context = response.data.data.message;
                that.cdialog_images = response.data.data.images;
                that.iconClass = {
                  fa: true,
                  "fa-exclamation-triangle": false,
                  "fa-exclamation-circle": true
                };
                that.backgroundClass = {
                  "hola-card-title-changed-commander-warning": false,
                  "hola-card-title-changed-commander-normal": true
                };
                axios.get(`/eboard/read_class.php`, {
                  params: {
                    id: command.id,
                    classID: cid
                  }
                });
                that.dialog_message = true;
              }
            }
          })
          .catch(function(error) {
            console.log(error);
          });
      }
    }
  },
  //生命周期——页面创建
  created() {
    let that = this;
    axios
      .get(`/classtable/getClassTime.php`, {//获取上课时间表
        params: {}
      })
      .then(function(response) {
        that.classTime = response.data;
      })
      .catch(function(error) {
        console.log(error);
      });
    setInterval(() => { //线程判断是否在上课时间
      var date = new Date();
      var hour = date.getHours().toString().padStart(2,'0');
      var minute = date.getMinutes().toString().padStart(2,'0');
      var second = date.getSeconds().toString().padStart(2,'0');
      that.nowTime[0] = hour;
      that.nowTime[1] = minute;
      that.nowTime[2] = second;
      var nowstamp = parseInt(hour * 60 * 60) + parseInt(minute) * 60 + parseInt(second);
      var i = 0;
      var isin = false;
      for (i = 0; i < that.classTime.length; i++) {
        if (
          nowstamp > that.classTime[i].beginStamp &&
          nowstamp < that.classTime[i].endStamp
        ) {
          isin = true;
          break;
        }
      }
      if (isin) {
        if (that.silenceDialog == false && !that.silenceDialogPrep) {//进入上课时间后 延缓5分钟打开
          that.silenceDialogPrep = true;
          setTimeout(()=>{
            axios
          .get(`https://v1.hitokoto.cn/`, {
            params: {}
          })
          .then(function(response) {
            that.hitokoto = response.data;
          })
          .catch(function(error) {
            console.log(error);
          });
          that.silenceDialog = true;
          that.silenceDialogPrep = false;
          },180000);                  
        }
      } else{
        this.silenceDialog = false;
        this.silenceDialogPrep = false;
      }
      this.$forceUpdate();//强制刷新
    }, 1000);

    window.InitSetInterval = setInterval(() => {
      axios
        .get(`/eboard/unread_class.php`, {
          params: {
            classID: cid
          }
        })
        .then(function(response) {
          if (response.data.cnt > 0) {
            var i = 0;
            that.dealCommand(response.data.data[0]);
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    }, 5000);
    axios
      .get(`/eboard/unread_class.php`, {
        params: {
          classID: global.classID
        }
      })
      .then(function(response) {
        if (response.data.cnt > 0) {
          var i = 0;
          that.dealCommand(response.data.data[0]);
        }
      })
      .catch(function(error) {
        console.log(error);
      });
  }
};
</script>