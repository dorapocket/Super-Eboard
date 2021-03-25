<template>
  <v-col @click="dialog = true">
    <div class="feature-icon">
      <i class="fa fa-file"></i>
    </div>
    <div class="feature-name">作业</div>

    <v-dialog
      v-model="dialog"
      fullscreen
      hide-overlay
      transition="dialog-bottom-transition"
      scrollable
    >
      <v-card tile>
        <v-toolbar flat dark color="primary"  style="z-index:999;height:8vh;">
          <v-btn icon dark @click="dialog = false" style="transform:scale(2,2);top:4vw;left:4vw;">
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-toolbar-title style="font-size:5vw;padding-top:4.5vh;padding-left:8vw;">作业</v-toolbar-title>
          <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text style="z-index:1;height:92vh;">
          <v-container style="">
            <v-row dense>
              <v-col v-for="(item, i) in items" :key="i" cols="8" offset="2">
                <v-card :color="item.color" dark style="transform:scale(1.8,1.8);margin-top:6vh;">
                  <div class="d-flex flex-no-wrap justify-space-between">
                    <div>
                      <v-card-title class="headline" v-text="item.title"></v-card-title>

                      <v-card-subtitle v-text="item.artist"></v-card-subtitle>
                      <v-card-actions>
                    <v-btn text>详细信息</v-btn>
                  </v-card-actions>
                    </div>


                  </div>
                </v-card>
              </v-col>


            </v-row>
          </v-container>
        </v-card-text>

        <div style="flex: 1 1 auto;"></div>
      </v-card>
    </v-dialog>
  </v-col>
</template>
<style>
</style>
<script>
export default {
  data() {
    return {
      dialog: false,
      items: [
           {
          color: "#385F73",
          title: "2020/6/15 英语作业",
          artist: "完形填空P1~P10，听力部分不做"
        },
         {
          color: "#00695C",
          title: "2020/6/15 数学作业",
          artist: "完成试卷，C组不做，整理错题本"
        },
         {
          color: "#33691E",
          title: "2020/6/15 政治作业",
          artist: "背诵毛泽东思想、邓小平主义、三个代表重要思想，下周默写"
        },
        {
          color: "#5D4037",
          title: "端午节 语文作业",
          artist: "完成古文翻译，查阅相关资料制作端午节手抄报"
        },
        {
          color: "#952175",
          title: "端午节 物理作业",
          artist: "完成第一章、力与运动相关练习，下周考试"
        }
      ]
    };
  }
};
</script>