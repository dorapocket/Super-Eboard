<template>
  <div class="hola-card" style="width:100%!important;padding-top:1.5vh!important;padding-bottom:1.5vh!important;padding-left:5vw!important;">
    <v-container style="margin-top:0px!important;">
      <v-row align-content="center" align="center">
        <v-col align-self="center">
          <div style="font-size:3.2vw;">下一节课：</div>
          <div style="font-size:8vw;font-weight:600;color:var(--hola-primary-color);">{{nextclass.class}}</div>
        </v-col>
        <v-col align-self="center">
          <div style="font-size:4vw;font-family:'Montserrat';">{{month}}月{{date}}日 {{week}}</div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<style>

</style>
<script>
import { getUrlParam } from "../GetUrlParam";
export default {
 data: () => ({
    nextclass:"无",
    month:10,
    date:24,
    week:"星期"
  }),
created() {
let that=this;
let cid=1;//getUrlParam("ClassID");
  window.InitSetInterval = setInterval(()=>{
        axios.get(`/classtable/nextClass.php`,{
            params:{
                classID:cid,
                week:day
            }
        })
        .then(function (response) {
          if(response.data.code==200){
            that.nextclass=response.data.data;
            that.month=response.data.time.month;
            that.date=response.data.time.day;
            that.week=response.data.time.week;
          }else{
            that.nextclass={"time":"未设置","class":"未设置"};
            that.month=response.data.time.month;
            that.date=response.data.time.day;
            that.week=response.data.time.week;
          }
            console.log(response.data);
        })
        .catch(function (error) {
            console.log(error);
        });
  },300000);
        var date=new Date(); 
        var day=date.getDay();
  axios.get(`/classtable/nextClass.php`,{
            params:{
                classID:cid,
                week:day
            }
        })
        .then(function (response) {
          if(response.data.code==200){
            that.nextclass=response.data.data;
            that.month=response.data.time.month;
            that.date=response.data.time.day;
            that.week=response.data.time.week;
          }else{
            that.nextclass={"time":"未设置","class":"未设置"};
            that.month=response.data.time.month;
            that.date=response.data.time.day;
            that.week=response.data.time.week;
          }
            console.log(response.data);
        })
        .catch(function (error) {
            console.log(error);
        });
},
}
</script>