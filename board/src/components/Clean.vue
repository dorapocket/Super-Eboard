<template>
     <div class="hola-columns-item">
          <div class="hola-card" style="padding:3vw!important;">
            <h2 class="hola-card-title" style="color: #ff8f00!important;">
                <div class="icon-wrapper" style="background:#ff8f00!important;">
                    <span class="icon">
                        <i class="fa fa-trash" style="font-size:2.8vw;color:white!important;"></i>
                    </span>
                </div>
                值周 Clean
            </h2>
             <v-container style="margin-top:0px!important;">
                <v-row align-content="center" align="center" style="padding-left:20px;" v-bind:key="'clean'+index" v-for="(item, index) in clean_person">
                    <div>
                        <span class="icon">
                            <i class="fa fa-user" style="font-size:3vw;color:#ff8f00!important;"></i>
                        </span>
                        <span class="clean-people">
                            {{item}}
                        </span>
                    </div>
                </v-row>
            </v-container>
          </div>
    </div>
</template>
<script>
export default {
    data: () => ({
    clean_person: ["李国宇","章天杰"],
  }),
}
</script>
<style>
.clean-people{
    display: inline-block;
    margin-left: 3vw!important;
    font-size: 3vw!important;
    color:rgba(0, 0, 0, 0.6);
    font-weight: 600;
}
</style>