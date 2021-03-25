<template>
  <div class="hola-columns-item">
    <div class="hola-card" style="padding:3vw!important;">
      <h2 class="hola-card-title" style="color:var(--hola-primary-color);!important;">
        <div class="icon-wrapper" style="background:var(--hola-primary-color);!important;">
          <span class="icon">
            <i class="fa fa-th-large" style="font-size:2.8vw;color:white!important;"></i>
          </span>
        </div>功能 Features
      </h2>
      <v-container style="margin-top:0px!important;">
        <v-row align-content="center" align="center" style="padding-left:3vw">
          <leave />
          <v-col>
            <div class="feature-icon-quick">
              <i class="fa fa-trash"></i>
            </div>
            <div class="feature-name">卫生</div>
          </v-col>
        </v-row>
        <v-row align-content="center" align="center" style="padding-left:3vw">
          <v-col>
            <div class="feature-icon-quick">
              <i class="fa fa-check"></i>
            </div>
            <div class="feature-name">签到</div>
          </v-col>
          <v-col>
            <div class="feature-icon-quick">
              <i class="fa fa-ellipsis-h"></i>
            </div>
            <div class="feature-name">更多</div>
          </v-col>
        </v-row>
      </v-container>
    </div>
  </div>
</template>
<style>
.feature-icon-quick {
  display: inline-block;
  margin-left: 3vw !important;
  font-size: 5vw !important;
  color: var(--hola-primary-color) !important;
}
.feature-name {
  display: inline-block;
  margin-left: 2.5vw !important;
  font-size: 2.8vw !important;
  font-weight: 600;
  color: rgba(0, 0, 0, 0.6);
}
</style>
<script>
import Leave from "./Leave";
export default {
  components: {
    Leave
  }
};
</script>