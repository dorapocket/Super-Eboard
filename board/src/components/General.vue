<template>
<div class="hola-card card1">

</div>
<!--<v-carousel  
    height="30%"
    hide-delimiters
    cycle
    class="elevation-10"
    >
    <v-carousel-item
      v-for="(item,i) in items"
      :key="i"
      :src="item.src"
      reverse-transition="fade-transition"
      transition="fade-transition"
    ></v-carousel-item>
  </v-carousel>
-->
</template>
<style>
.card1{
  margin-top:-10vw;
  z-index: 1;
  width: 100%;
}
</style>
<script>
export default {
    data () {
      return {
         nxtclass:"语文",
      date:{
          'month':9,
          'day':1,
          'date':'星期一'
      },
        items: [
          {
            src: 'https://www.nbxiaoshi.net/images/indexfiles/985.300/D1.PNG',
          },
          {
            src: 'https://www.nbxiaoshi.net/images/indexfiles/985.300/D2.PNG',
          },
          {
            src: 'https://www.nbxiaoshi.net/images/indexfiles/985.300/ibstudent.jpg',
          },
          {
            src: 'https://www.nbxiaoshi.net/images/indexfiles/985.300/xiaomen2.jpg',
          },
        ],
      }
    },
  }
</script>