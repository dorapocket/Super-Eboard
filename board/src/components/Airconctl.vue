<template>
              
  <v-col @click="air_dialog=true">
    <div class="feature-icon-intel">
                <i class="fa fa-thermometer"></i>
              </div>
              <div class="feature-name">空调</div>

    <v-dialog
      v-model="air_dialog"
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
              <i class="fa fa-thermometer" style="font-size:12vw;color:white!important;"></i>
            </v-col>
          </v-row>
          <v-row align="center" align-content="center">
            <v-col align-self="center" style="text-align:center!important;margin-bottom:4vh;">
              <h2 class="hola-card-title" style="font-size:5vw;color:white;">空调</h2>
            </v-col>
          </v-row>
        </v-container>
        <div
          style="padding-top:50px;text-align:center!important;color:grayx-!important;"
        >
          <div class="ltext" style="font-size:4vw;margin:2vh 0 2vh 0;" >当前温度</div>
          <div v-bind:class="airicon">
              <v-row justify="center">
                  <v-col align-self="center">
                      <v-btn @click="temp--" icon x-large style="display:inline-block;transform:scale(3);"><i class="fa fa-minus"></i></v-btn>
                  </v-col>
                  <v-col>
          <span id="air-icon" class="" style="font-size:15vw;margin-bottom:4vh;">{{temp}}℃</span>
                  </v-col>
                  <v-col align-self="center">
                      <v-btn @click="temp++" icon x-large style="display:inline-block;transform:scale(3);"><i class="fa fa-plus"></i></v-btn>
                  </v-col>
              </v-row>
          </div>
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
    air_dialog: false,
    temp:26,
    airicon:"off",
  }),
  created() {
   
  },
  methods: {
    showAir: function() {
      this.air_dialog = true;
    },
   
  }
};
</script>