<template>
  <v-col v-on:click="showCheck">
    <div class="feature-icon">
      <i class="fa fa-check"></i>
    </div>
    <div class="feature-name">签到</div>
    <v-dialog
      v-model="check_dialog"
      max-width="80vw"
      max-height="80vh"
      class="hola-card-message-commander"
    >
      <div class="hola-card hola-card-message-commander" style="margin-bottom:0;">
        <v-container style="background-color:#4CAF50;">
          <v-row align="center" align-content="center">
            <v-col
              align-self="center"
              style="text-align:center!important; margin-top:5vh;margin-bottom:3vh;"
            >
              <i class="fa fa-check" style="font-size:12vw;color:white!important;"></i>
            </v-col>
          </v-row>
          <v-row align="center" align-content="center">
            <v-col align-self="center" style="text-align:center!important;margin-bottom:4vh;">
              <h2 class="hola-card-title" style="font-size:5vw;color:white;">签到</h2>
            </v-col>
          </v-row>
        </v-container>
        <v-progress-circular v-if="loading" :size="70" :width="7" color="purple" indeterminate></v-progress-circular>
        <div
          style="padding:50px;text-align:center!important;color:gray!important;"
          v-if="step1"
          v-on:click="showCheck"
        >
          <div style="color:gray!important;font-size:4vw;margin:3vh 0 4vh 0;">刷卡以完成签到</div>
          <i class="fa fa-id-card" style="font-size:15vw;margin-bottom:4vh;"></i>
          <div v-if="error" style="color:gray!important;font-size:3vw;margin:1vh 0 4vh 0;">卡号不存在:(</div>
          <div v-if="step2" style="color:gray!important;font-size:3vw;margin:1vh 0 4vh 0;">{{studentname}}，签到成功！</div>
          <input type="text" style="opacity:0;display:block;" v-on:input="cardnum" id="cardNumber" />
        </div>
      </div>
    </v-dialog>
  </v-col>
</template>
<style>
</style>
<script>
export default {
     data: () => ({
         loading:false,
         error:false,
         step1:true,
         step2:false,
         check_dialog:false,
         studentid:"",
         studentname:"",
         classid:"",
         stuteacherid:"",
     }),
     created(){
      let that=this;
      this.step1=true;
      this.step2=false;
      this.error=false;
      this.loading=false;

  },
     methods:{
         cardnum:function(){
        this.loading=true;
        let that=this;
        var stuid=document.getElementById("cardNumber").value;
         axios
      .get(`/eboard/getStudentInformation.php`, {
        params: {
          studentID: stuid
        }
      })
      .then(function(response) {
        that.loading=false
        if(response.data.code==200){
            that.studentid=stuid;
            that.studentname=response.data.data.student_name;
            that.classid=response.data.data.class_id;
            that.stuteacherid=response.data.data.teacher_id;
            that.step1=false;
            that.step2=true;
            //that.step3=false;
        }else{
            setTimeout(function(){
            document.getElementById("cardNumber").focus();
            document.getElementById("cardNumber").value="";
            that.step1=true;
            that.step2=false;
            that.error=true;
            //that.step3=false;
        },500);
        }
        console.log(response.data);
      })
      .catch(function(error) {
        that.loading=false
        alert(error);
        console.log(error);
      });
    },
         showCheck:function(){
             this.check_dialog=true;
         }
     }
};
</script>