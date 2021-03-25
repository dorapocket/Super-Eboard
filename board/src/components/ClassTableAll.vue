<template>
  <v-col v-on:click="showAllClassTable">
    <div class="feature-icon">
      <i class="fa fa-th-list"></i>
    </div>
    <div class="feature-name">课表</div>

    <v-dialog
      v-model="class_dialog"
      max-width="80vw"
      max-height="80vh"
      class="hola-card-message-commander"
    >
      <v-toolbar flat dark color="primary">
        <v-btn icon dark>
          <v-icon>mdi-close</v-icon>
        </v-btn>
        <v-toolbar-title>课表</v-toolbar-title>
        <v-spacer></v-spacer>
      </v-toolbar>

      <v-img src="~@/assets/img/classtable.png"></v-img>
    </v-dialog>
  </v-col>
</template>

<style>
</style>
<script>
export default {
  data: () => ({
    class_dialog: false
  }),
  methods: {
    showAllClassTable: function() {
      this.class_dialog = true;
    }
  }
};
</script>