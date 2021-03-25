<template>
  <v-img src="img/01.jpeg" max-height="30vh">
    <h1>{{classinf}}</h1>
    <h3>班主任：{{leader}}</h3>
  </v-img>
</template>

<style>
h1 {
  font-family: "Montserrat";
  font-size: 6vw;
  color: white;
  margin-top: 7vh;
  margin-left: 5vw;
}
h3 {
  font-family: "Montserrat";
  font-size: 3vw;
  color: white;
  margin-left: 5vw;
}
</style>

<script>
import global from './token.vue';
import { getUrlParam } from "../GetUrlParam";

export default {
  props: {
    source: String
  },
  data: () => ({
    classinf: "",
    leader:"",
    drawer: null
  }),
  created() {
    let that = this;
    let id=1;//getUrlParam("ClassID");
    axios
      .get(`/eboard/getClassInformation.php`, {
        params: {
          classID: id,
        }
      })
      .then(function(response) {
        console.log(response.data);
        that.classinf=response.data.data.classname;
        that.leader=response.data.data.teachername;
      })
      .catch(function(error) {
        console.log(error);
      });
  }
};
</script>>