<template>
<v-container id="main">
    <v-layout
      wrap
    >
       <div class="hola-container" style="margin-top:-12vh;">
<div  style="width:100%!important">
    <FeatureCommon />
</div>
<div class="hola-columns hola-card-stack" style="margin-top:1vh;margin-bottom:7vh;">
    
</div>
</div>

    </v-layout>
  </v-container>
</template>

<script>
import FeatureCommon from './FeatureCommon'
export default {
  components: {
    FeatureCommon
  },
  data: () => ({
   
  }),
};
</script>

<style>

</style>
