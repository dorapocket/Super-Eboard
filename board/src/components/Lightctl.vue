<template>
              
  <v-col @click="light_dialog=true">
    <div class="feature-icon-intel">
                <i class="fa fa-lightbulb"></i>
              </div>
              <div class="feature-name">电灯</div>

    <v-dialog
      v-model="light_dialog"
      max-width="80vw"
      max-height="80vh"
      class="hola-card-message-commander"
    >
      <div class="hola-card hola-card-message-commander" style="margin-bottom:0;">
        <v-container style="background-color:#AB47BC;">
          <v-row align="center" align-content="center">
            <v-col
              align-self="center"
              style="text-align:center!important; margin-top:5vh;margin-bottom:3vh;"
            >
              <i class="fa fa-lightbulb" style="font-size:12vw;color:white!important;"></i>
            </v-col>
          </v-row>
          <v-row align="center" align-content="center">
            <v-col align-self="center" style="text-align:center!important;margin-bottom:4vh;">
              <h2 class="hola-card-title" style="font-size:5vw;color:white;">电灯</h2>
            </v-col>
          </v-row>
        </v-container>
        <div
          style="padding-top:50px;text-align:center!important;color:gray!important;"
          @click="switchclick"
        >
          <div class="ltext" style="font-size:4vw;margin:3vh 0 4vh 0;" >教室顶灯开关</div>
          <div v-bind:class="lighticon">
          <i id="light-top-icon" class="fa fa-power-off" style="font-size:15vw;margin-bottom:4vh;"></i>
          </div>
        </div>
        <div
          style="padding:10px;text-align:center!important;color:gray!important;"
          @click="switchclick"
        >
          <div class="ltext" style="font-size:4vw;margin:2vh 0 4vh 0;" >放学自动熄灯时间</div>
          <v-row justify="center" style="margin-bottom:4vh;margin-top:-20px">
            <v-time-picker style="transform:scale(1.1);" color="#AB47BC" v-model="picker"></v-time-picker>
          </v-row>
        </div>
      </div>
    </v-dialog>
  </v-col>
</template>
<style>
.ltext{
  color:grey;
}
.on{
  color:#2196FF!important;
}
.off{
color:grey!important;
}
</style>
<script>
export default {
  data: () => ({
    light_dialog: false,
    light_status:false,
    lighticon:"off",
    picker:null
  }),
  created() {
    let that=this;
    axios
      .get("http://192.168.43.194/status", {
        params: {
          
        }
      })
      .then(function(response) {
        if(response.data=="on"){
          that.lighticon="on";that.light_status=true;
            document.getElementById("light-top-icon").style.color="#2196FF!important";
            console.log("init:light is open");
        }else{
          that.lighticon="off";that.light_status=false;
            document.getElementById("light-top-icon").style.color="grey!important";
            console.log("init:light is off");
        }
        console.log(response.data);
      })
      .catch(function(error) {
        that.lighticon="off";
        that.light_status=false;
        document.getElementById("light-top-icon").style.color="grey!important";
        console.log(error);
      });
  },
  methods: {
    showLight: function() {
      this.light_dialog = true;
    },
    getlightstat:function(){

    },
    switchclick:function(){
        var on="http://192.168.43.194/on";
        var off="http://192.168.43.194/off";
        var coml=this.light_status?off:on;
        let that=this;
        axios
      .get(coml, {
        params: {
          
        }
      })
      .then(function(response) {
        if(response.data=="led on"){
          that.lighticon="on";that.light_status=true;
            document.getElementById("light-top-icon").style.color="#2196FF!important";
            console.log("light is open");
        }else{
          that.lighticon="off";that.light_status=false;
            document.getElementById("light-top-icon").style.color="grey!important";
            console.log("light is off");
        }
        console.log(response.data);
      })
      .catch(function(error) {
        that.lighticon="off";
        that.light_status=false;
        document.getElementById("light-top-icon").style.color="grey!important";
        console.log(error);
      });
    }
  }
};
</script>