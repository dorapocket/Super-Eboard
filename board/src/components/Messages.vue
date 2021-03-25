<template>
  <div class="hola-columns-item">
    <div class="hola-card" style="padding:3vw!important;">
      <h2 class="hola-card-title" style="color:#E57373!important;">
        <div class="icon-wrapper" style="background:#E57373!important;">
          <span class="icon">
            <i class="fa fa-comment" style="font-size:2.8vw;color:white!important;"></i>
          </span>
        </div>通知 Notice
      </h2>
      <ul class="hola-vmenu" style="width:100%!important;margin-right:0px!important;">
        <h4 v-if="!messagelist" style="font-size:3.5vw;color:gray;">暂无通知</h4>
        <li
          class="hola-vmenu-item"
          style="font-size:2.3vw!important;"
          v-bind:id="item.id"
          v-on:click="showMessage"
          v-bind:key="item.id"
          v-for="item in messagelist"
        >{{item.title}}</li>
      </ul>
    </div>
    
    <v-dialog v-model="dialog" max-width="80vw" max-height="80vh" class="hola-card-message">
      <div class="hola-card hola-card-message" style="margin-bottom:0;">
        <h2 class="hola-card-title hola-card-title-changed" style="font-size:4.5vw;">{{dialog_title}}</h2>
        <div style="padding:50px;">
        <div class="dialog-context">
          {{dialog_context}}
        </div>
        <v-img v-bind:key="index" v-for="(item, index) in dialog_images"
        v-bind:src="item"
        >
        </v-img>
        </div>
      </div>
    </v-dialog>

  </div>
</template>
<style>
.hola-card-message{
  padding:0!important;
  box-shadow: 0 0 25px rgb(229, 115, 115);
}
.dialog-context{
  font-size: 3vw!important;
  margin-bottom:2vh;
}
.hola-card-title-changed{
  color: white;
  padding-top:8vh;
  padding-bottom:2vh;
  padding-left:2vh;
  background-color: #E57373;
}
</style>
<script>
import { getUrlParam } from "../GetUrlParam";
let cid=1;//getUrlParam("ClassID");
export default {
  data: () => ({
    dialog: false,
    messagelist: [],
    dialog_title:"",
    dialog_context:"",
    dialog_images:[]
  }),
  methods: {
    showMessage: function(e) {
      let that=this;
      var msgid = e.target.id;
      axios
      .get(`/eboard/getClassMessageByID.php`, {
        params: {
          messageID: msgid
        }
      })
      .then(function(response) {
        that.dialog_title=response.data.data.title;
        that.dialog_context=response.data.data.message;
        that.dialog_images=response.data.data.images;
        that.dialog=true;
        console.log(response.data);
      })
      .catch(function(error) {
        console.log(error);
      });
  }
  },
  created() {
    let that = this;
    window.InitSetInterval = setInterval(() => {
      axios
        .get(`/eboard/getClassMessage.php`, {
          params: {
            classID: cid
          }
        })
        .then(function(response) {
          that.messagelist = response.data.data;
          console.log(response.data);
        })
        .catch(function(error) {
          console.log(error);
        });
    }, 10000);
    axios
      .get(`/eboard/getClassMessage.php`, {
        params: {
          classID: cid
        }
      })
      .then(function(response) {
        that.messagelist = response.data.data;
        console.log(response.data);
      })
      .catch(function(error) {
        console.log(error);
      });
  }
};
</script>