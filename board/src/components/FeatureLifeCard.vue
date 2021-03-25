<template>
    <!-- 模块2-->
    <div class="hola-columns-item" style="margin-top:30px;">
      <div class="hola-card" style="padding:3vw!important;">
        <h2 class="hola-card-title" style="color:#4CAF50;!important;">
          <div class="icon-wrapper" style="background:#4CAF50;!important;">
            <span class="icon">
              <i class="fa fa-th-large" style="font-size:2.8vw;color:white!important;"></i>
            </span>
          </div>生活 Life
        </h2>
        <v-container style="margin-top:0px!important;">
          <v-row align-content="center" align="center" style="padding-left:3vw">
            <v-col>
              <div class="feature-icon-life">
                <i class="fa fa-trash"></i>
              </div>
              <div class="feature-name">卫生</div>
            </v-col>
           
           <WeatherPlus />
          </v-row>
          <v-row align-content="center" align="center" style="padding-left:3vw">
            <v-col>
              <div class="feature-icon-life">
                <i class="fa fa-search"></i>
              </div>
              <div class="feature-name">寻物启事</div>
            </v-col>
            <MyCard />
            
          </v-row>
          <v-row align-content="center" align="center" style="padding-left:3vw">
            <v-col>
              <div class="feature-icon-life">
                <i class="fa fa-camera"></i>
              </div>
              <div class="feature-name">相册</div>
            </v-col>
          </v-row>
        </v-container>
      </div>
    </div>
</template>
<style>
.feature-icon-life{
  display: inline-block;
  margin-left: 3vw !important;
  font-size: 5vw !important;
  color: #4CAF50 !important;
}

</style>
<script>
import WeatherPlus from "./WeatherPlus";
import MyCard from "./MyCard";
export default {
    components:{
      WeatherPlus,
      MyCard
    }
}
</script>