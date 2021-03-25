<template>
    <div class="hola-columns-item" style="margin-top:30px;">
      <div class="hola-card" style="padding:3vw!important;">
        <h2 class="hola-card-title" style="color:#AB47BC;!important;">
          <div class="icon-wrapper" style="background:#AB47BC;!important;">
            <span class="icon">
              <i class="fa fa-th-large" style="font-size:2.8vw;color:white!important;"></i>
            </span>
          </div>智能 Intelligence
        </h2>
        <v-container style="margin-top:0px!important;">
          <v-row align-content="center" align="center" style="padding-left:3vw">
            <Lightctl />
              <Airconctl />
          </v-row>
          <v-row align-content="center" align="center" style="padding-left:3vw">
            <v-col>
              <div class="feature-icon-intel">
                <i class="fa fa-life-ring"></i>
              </div>
              <div class="feature-name">电风扇</div>
            </v-col>
          </v-row>
        
        </v-container>
      </div>
    </div>
</template>
<style>
.feature-icon-intel{
  display: inline-block;
  margin-left: 3vw !important;
  font-size: 5vw !important;
  color: #AB47BC !important;
}
</style>
<script>
import Lightctl from "./Lightctl";
import Airconctl from "./Airconctl";
export default {
components:{
  Lightctl,
  Airconctl
}

}
</script>