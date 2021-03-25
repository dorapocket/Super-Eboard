<template>
<v-container id="main">
    <v-layout
      wrap
    >
       <BasicReminder />

    </v-layout>
  </v-container>
</template>

<script>
import General from './General'
import BasicReminder from './BasicReminder' 
import QuickNotes from './QuickNotes'
export default {
  components: {
    General,
    BasicReminder,
    QuickNotes,
  },
  data: () => ({
   
  }),
};
</script>

<style>

</style>
