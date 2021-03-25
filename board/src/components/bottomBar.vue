<template>
  <v-bottom-navigation
    id="bottombar"
    v-model="bottomNav"
    app
    min-height="6vh"
    grow=""
  >
  <v-btn style="min-height:6vh;min-width:50vw;" value="main" @click="gohome">
      <span class="bottom-bar-btn">主页</span>
      <v-icon class="bottom-bar-btn-icon">mdi-home</v-icon>
    </v-btn>

   

    <v-btn style="min-height:6vh;min-width:50vw;" value="features" @click="gofeatures">
      <span class="bottom-bar-btn">功能</span>
      <v-icon class="bottom-bar-btn-icon">mdi-school</v-icon>
    </v-btn>
  </v-bottom-navigation>
</template>

<script>
  export default {
    methods:{
      gohome(){
        this.$router.push('/');
      },
      gofeatures(){
        this.$router.push('/features');
      }
    },
    data () {
      return {
        bottomNav: 'main',
      }
    },
  }
</script>

<style>
  .bottom-bar-btn{
    font-size:1.5vh;
  }
  .bottom-bar-btn-icon{
    font-size:3vh!important;
  }
</style>