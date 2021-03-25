<template>
  <v-col v-on:click="showLeave">
    <div class="feature-icon">
      <i class="fa fa-hospital"></i>
    </div>
    <div class="feature-name">请假</div>
    <v-dialog
      v-model="leave_dialog"
      max-width="80vw"
      max-height="80vh"
      class="hola-card-message-commander"
    >
      <div class="hola-card hola-card-message-commander" style="margin-bottom:0;" v-if="leave_dialog">
        <v-container style="background-color:#9c27b0;" v-on:click="showLeave">
          <v-row align="center" align-content="center">
            <v-col
              align-self="center"
              style="text-align:center!important; margin-top:5vh;margin-bottom:3vh;"
            >
              <i class="fa fa-hospital" style="font-size:12vw;color:white!important;"></i>
            </v-col>
          </v-row>
          <v-row align="center" align-content="center">
            <v-col align-self="center" style="text-align:center!important;margin-bottom:4vh;">
              <h2 class="hola-card-title" style="font-size:5vw;color:white;">请假</h2>
            </v-col>
          </v-row>
        </v-container>
        <v-progress-circular v-if="loading" :size="70" :width="7" color="purple" indeterminate></v-progress-circular>
        <div
          style="padding:50px;text-align:center!important;color:gray!important;"
          v-if="step1"
          v-on:click="showLeave"
        >
        <!--
          <div style="color:gray!important;font-size:4vw;margin:3vh 0 4vh 0;">请刷您的校园卡</div>
          <i class="fa fa-id-card" style="font-size:15vw;margin-bottom:4vh;"></i>-->

          <div style="color:gray!important;font-size:4vw;margin:3vh 0 4vh 0;">人脸识别系统已启用</div>
          <face style="font-size:15vw;margin-bottom:4vh;display:inline-block;" @childFn="getfaceinf"/>
          <!--<div style="color:gray!important;font-size:4vw;margin:1vh 0 4vh 0;">你好，李国宇 :) </div>-->
          
          <div v-if="error" style="color:gray!important;font-size:3vw;margin:1vh 0 4vh 0;">卡号不存在:(</div>
          <input type="text" style="opacity:0;display:block;" v-on:input="cardnum" id="cardNumber" />
        </div>
        <div style="padding:50px;text-align:center!important;color:gray!important;" v-if="step2">
          <div style="color:gray!important;font-size:3rem;margin:1vh 0 2vh 0;">你好！{{studentname}}同学！</div>
          <v-select
            v-model="select"
            :items="items"
            :rules="[v => !!v || 'Item is required']"
            label="请假类型"
            color="#9c27b0"
            required
          ></v-select>
          <v-checkbox v-model="iscall" label="已通知家长" required></v-checkbox>
          <div style="font-size:2rem;color:gray;">请假开始日期</div>
          <v-row justify="center" style="margin-top:5vh;margin-bottom:7vh;">
            <v-date-picker
              v-model="beginpicker"
              landscape
              style="transform:scale(1.6);"
              color="#9c27b0"
            ></v-date-picker>
          </v-row>
          <div style="font-size:2rem;color:gray;">请假开始时间</div>
          <v-row justify="center" style="margin-top:5vh;margin-bottom:7vh;">
            <v-time-picker
              v-model="begintimepicker"
              landscape
              style="transform:scale(1.6);"
              color="#9c27b0"
            ></v-time-picker>
          </v-row>
          <div style="font-size:2rem;color:gray;">请假结束日期</div>
          <v-row justify="center" style="margin-top:5vh;margin-bottom:7vh;">
            <v-date-picker
              v-model="endpicker"
              landscape
              style="transform:scale(1.6);"
              color="#9c27b0"
            ></v-date-picker>
          </v-row>
          <div style="font-size:2rem;color:gray;">请假结束时间</div>
          <v-row justify="center" style="margin-top:5vh;margin-bottom:7vh;">
            <v-time-picker
              v-model="endtimepicker"
              landscape
              style="transform:scale(1.6);"
              color="#9c27b0"
            ></v-time-picker>
          </v-row>
          <v-row justify="center" style="margin-top:8vh;margin-bottom:3vh;">
            <v-col>
              <v-icon
                style="font-size:8rem!important;"
                color="green"
                v-on:click="submitLeave"
              >mdi-checkbox-marked-circle</v-icon>
              <div style="font-size:2rem;font-weight:600;" v-on:click="submitLeave">提交</div>
            </v-col>
          </v-row>
        </div>
        <div style="padding:50px;text-align:center!important;color:gray!important;" v-if="step3" v-on:click="showLeave">
        <div style="color:gray!important;font-size:3rem;margin:3vh 0 2vh 0;" >{{message}}</div>
        <v-icon v-if="step3_success"
                style="font-size:10rem!important;margin-bottom:3vh;"
                color="green"
                v-on:click="submitLeave"
              >mdi-checkbox-marked-circle</v-icon>
                <v-icon v-if="step3_error"
                style="font-size:10rem!important;"
                color="red"
                v-on:click="submitLeave"
              >mdi-alert</v-icon>
      </div>
      </div>
    </v-dialog>
  </v-col>
</template>
<style>
.v-input--selection-controls__input {
  transform: scale(1.5);
  margin-bottom: 2.5rem;
  margin-right: 1.5rem;
}
.v-btn__content {
}
.v-select__selection {
  font-size: 2rem !important;
}
.v-select__selections {
  line-height: 3rem !important;
}
.v-list-item__title {
  font-size: 2rem !important;
  line-height: 3.5rem !important;
}
.v-label {
  font-size: 2rem !important;
  height: 5rem !important;
  line-height: 2.5rem !important;
  top: -20px !important;
}
</style>
<script>
import face from "./face";
export default {
  components:{
    face
  },
  data: () => ({
    beginpicker: new Date().toISOString().substr(0, 10),
    begintimepicker: null,
    endpicker: new Date().toISOString().substr(0, 10),
    endtimepicker: null,
    iscall:false,
    leave_dialog: false,
    step1:true,
    step2:false,
    step3:false,
    step3_success:true,
    step3_error:false,
    message:"申请已提交",
    error:false,
    loading:false,
    studentid:"",
    studentname:"",
    classid:"",
    classname:"",
    stuteacherid:"",
    select: null,
    items: [
        '病假',
        '事假',
        '晚自习请假',
        '其他（向老师说明）',
      ],
  }),
  created(){
      let that=this;
      this.step1=true;
      this.step2=false;
      this.step3=false;
      this.error=false;
      this.loading=false;

  },
  mounted() {

  },
methods:{
    getfaceinf:function(inf){
      console.log("parent:"+inf);
      this.loading=true;
        let that=this;
        var stuid=inf;
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
            that.step3=false;
        }else{
            setTimeout(function(){
            document.getElementById("cardNumber").focus();
            document.getElementById("cardNumber").value="";
            that.step1=true;
            that.step2=false;
            that.error=true;
            that.step3=false;
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
            that.step3=false;
        }else{
            setTimeout(function(){
            document.getElementById("cardNumber").focus();
            document.getElementById("cardNumber").value="";
            that.step1=true;
            that.step2=false;
            that.error=true;
            that.step3=false;
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
    showLeave:function(){
            this.error=false;
            this.step1=true;
            this.step2=false;
            this.loading=false;
            this.step3=false;
            this.step3_success=true;
            this.step3_error=true;
        this.leave_dialog=true;
        setTimeout(function(){
            document.getElementById("cardNumber").focus();
            document.getElementById("cardNumber").value="";

        },500);
    },
    submitLeave(){
      let that=this;
      if(this.select&&this.begintimepicker&&this.endtimepicker){
         axios
      .get(`/eboard/leave_add.php`, {
        params: {
          teacher_id:that.stuteacherid,
          stu_id: that.studentid,
          type:that.select,
          reason:that.select,
          iscontact:that.iscall?1:0,
          time_begin:that.beginpicker+" "+that.begintimepicker,
          time_end:that.endpicker+" "+that.endtimepicker,

        }
      })
      .then(function(response) {
        that.loading=false
        if(response.data.code==200){
          that.step2=false;
          that.step3=true;
          that.step3_success=true;
          that.step3_error=false;
          that.message="您的申请已提交！";
        }else{
          that.step2=false;
          that.step3=true;
          that.step3_success=false;
          that.step3_error=true;
          that.message="有什么地方出错了:(";
        }
        console.log(response.data);
      })
      .catch(function(error) {
        that.loading=false
        alert(error);
        console.log(error);
      });
      }
    }
}
}
</script>