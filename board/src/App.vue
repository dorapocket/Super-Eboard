<template>
  <v-app>
    <app-bar></app-bar>
    <bottom-bar></bottom-bar>
    <router-view></router-view>
    <commander></commander>
  </v-app>
</template>

<script>
import MainPage from './components/MainPage';
import bottomBar from './components/bottomBar';
import AppBar from './components/AppBar';
import Commander from './components/Commander';

export default {
  name: 'App',
  components: {
    MainPage,
    bottomBar,
    AppBar,
    Commander,
  },
  data: () => ({
    drawer: null,
  }),
  created:()=>{
  }
};
</script>
