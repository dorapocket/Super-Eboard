<template>
    <div class="hola-columns-item" style="margin-top:30px;">
      <div class="hola-card" style="padding:3vw!important;">
        <h2 class="hola-card-title" style="color:var(--hola-primary-color);!important;">
          <div class="icon-wrapper" style="background:var(--hola-primary-color);!important;">
            <span class="icon">
              <i class="fa fa-th-large" style="font-size:2.8vw;color:white!important;"></i>
            </span>
          </div>学习 Study
        </h2>
        <v-container style="margin-top:0px!important;">
          <v-row align-content="center" align="center" style="padding-left:3vw">
            <Leave />
            <ClassTableAll />
          </v-row>
          <v-row align-content="center" align="center" style="padding-left:3vw">
            <CheckOut />
            <HomeWork />
          </v-row>
          <v-row align-content="center" align="center" style="padding-left:3vw">
            <ExamSchedule />
          </v-row>
        </v-container>
      </div>
    </div>
</template>
<style>
.feature-icon-study{
  display: inline-block;
  margin-left: 3vw !important;
  font-size: 5vw !important;
  color: var(--hola-primary-color) !important;
}

</style>
<script>
import Leave from "./Leave";
import ClassTableAll from "./ClassTableAll";
import CheckOut from "./CheckOut";
import HomeWork from "./HomeWork";
import ExamSchedule from "./ExamSchedule";
export default {
  components: {
    Leave,
    ClassTableAll,
    CheckOut,
    HomeWork,
    ExamSchedule
  },
}
</script>