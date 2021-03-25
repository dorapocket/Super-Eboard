<template>
    <v-col @click="card_dialog=true">
              <div class="feature-icon-life">
                <i class="fa fa-id-card"></i>
              </div>
              <div class="feature-name">一卡通</div>
              <v-dialog
      v-model="card_dialog"
      max-width="80vw"
      max-height="80vh"
      class="hola-card-message-commander"
    >
      <v-toolbar flat dark color="primary">
        <v-btn icon dark>
          <v-icon>mdi-close</v-icon>
        </v-btn>
        <v-toolbar-title>一卡通</v-toolbar-title>
        <v-spacer></v-spacer>
      </v-toolbar>
      <v-img src="~@/assets/img/card.jpg"></v-img>
    </v-dialog>
            </v-col>
</template>
<style>

</style>
<script>
export default {
     data: () => ({
    card_dialog: false
  }),
}
</script>