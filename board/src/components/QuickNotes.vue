<template>
  <v-row style="height:50vh;margin-top:1vh;" class="px-3">
    <div style="height:100%;width:100%">
      <v-row style="height:50%" class="px-3 mb-2">
        <v-card style="width:49%;margin-right:2%!important;">
          <v-card-title class='card-message'><v-icon large class='card-message'>mdi-message-text</v-icon>&nbsp&nbsp通知</v-card-title>
          <v-card-text class='card-message-text' style="max-height:50%!important;display:block;max-height:20px;text-overflow: clip;">请ztj同学立刻到办公室找我！！请ztj同学立刻到办公室找我！！请ztj同学立刻到办公室找我！！请ztj同学立刻到办公室找我！！请ztj同学立刻到办公室找我！！请ztj同学立刻到办公室找我！！</v-card-text>
        </v-card>
        <v-card style="width:49%;margin-left:0%!important;margin-top:0px!important;" class="card-clean">
          <v-card-title class="card-clean"><v-icon  large class="card-clean">mdi-delete</v-icon>&nbsp&nbsp值日</v-card-title>
          <v-card-text>
            <v-list-item>
              <v-list-item-icon>
                <v-icon  class="card-clean-item">mdi-account</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title  class="card-clean-item">张三</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
            <v-list-item>
              <v-list-item-icon>
                <v-icon  class="card-clean-item">mdi-account</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title class="card-clean-item">李四</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-card-text>
        </v-card>
      </v-row>
      <v-row style="height:50%;width:100vw;margin-top:1vh;" class="px-3 justify-center">
        <v-card style="width:49%;margin-right:2%!important;">
          <v-card-title class="card-shortcut"><v-icon  large class="card-shortcut">mdi-walk</v-icon>&nbsp&nbsp快捷方式</v-card-title>
          <v-card-text style="height:80%" class="pt-6">
            <v-row style="height:50%">
              <v-col  style="width:50%;height:100%" class="text-center">
                <v-icon class="card-shortcut-item-icon pb-4" >mdi-alien</v-icon>
                <div class="card-shortcut-item">  请假</div>
              </v-col>
              <v-col style="width:50%" class="text-center">
                <v-icon class="card-shortcut-item-icon pb-4">mdi-check-all</v-icon>
                <div class="card-shortcut-item">  签到</div>
              </v-col>
            </v-row>
            <v-row style="height:50%">
              <v-col style="width:50%" class="text-center">
                <v-icon class="card-shortcut-item-icon pb-4">mdi-delete</v-icon>
                <div class="card-shortcut-item">  卫生</div>
              </v-col>
              <v-col style="width:50%" class="text-center">
                <v-icon class="card-shortcut-item-icon pb-4">mdi-account</v-icon>
                <div class="card-shortcut-item">  更多</div>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
        <v-card style="width:49%;margin-left:0%!important;margin-top:0px!important;">
          <v-card-title class="card-weather"><v-icon  large class="card-weather">mdi-cloud</v-icon>&nbsp&nbsp天气</v-card-title>
          <v-card-text style="height:80%">
            <v-row style="width:100%;height:100%">
              <v-col style="width:50%">
                <i class="wi wi-night-sleet wi-fw" style="color:#4fc3f7;font-size:8rem;margin-top:40%">
                  </i>
                  </v-col>
                  <v-col style="width:50%;margin-top:18%!important;">
                    <div style="font-size:4rem;font-weight:500;line-height: 4rem!important;">25℃</div>
                    <div  class="mt-2" style="font-size:20px;font-weight:500;font-size:2rem;line-height: 2.2rem!important;">小雨</div>
                    <div class="mt-1" style="font-size:2rem;line-height: 2.2rem!important;">东北风</div>
                    </v-col>
                    </v-row>
           
          </v-card-text>
        </v-card>
      </v-row>
    </div>
  </v-row>
</template>

<style>
.card-shortcut-item-icon{
  color: #673AB7!important;
  font-size: 3.5rem!important;
}
.card-shortcut-item{
  font-size: 2rem!important;
}
.card-clean-item{
  font-size: 2vh!important;
  color: gray;
}
.card-message-text{
  max-lines: 8;
  line-height: 2rem!important;
  font-size: 1.8rem!important;
  margin-top:0.5rem;
  text-overflow: ellipsis;
}
.card-weather{
  color: #4fc3f7!important;
    font-size:5vw!important;
  font-weight: 600!important;
  margin-top:0.5vh;
  margin-left:0.5vw;
}
.card-clean{
  color: #ff8f00!important;
  font-size:5vw!important;
  font-weight: 600!important;
  margin-top:0.5vh;
  margin-left:0.5vw;
}
.card-shortcut{
  color: #673AB7!important;
    font-size:5vw!important;
  font-weight: 600!important;
  margin-top:0.5vh;
  margin-left:0.5vw;
}
.card-message{
  color: #E57373!important;
  font-size:5vw!important;
  font-weight: 600!important;
  margin-top:0.5vh;
  margin-left:0.5vw;
}
</style>