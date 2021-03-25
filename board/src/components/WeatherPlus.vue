<template>
  <v-col v-on:click="showWeather">
    <div class="feature-icon-life">
      <i class="fa fa-cloud"></i>
    </div>
    <div class="feature-name">天气</div>
    <v-dialog v-model="weatherdialog" max-width="80vw" max-height="80vh" class="hola-card-weather">
      <div class="hola-card hola-card-message" style="margin-bottom:0;">
        <h2 class="hola-card-title hola-card-title-weather" style="font-size:5vw;">天气详情</h2>
        <div v-if="weatherdialog" style="padding:5vw;">
          <div style="font-size:4vw;font-weight:600;color:gray;">当日天气</div>
          <v-row align-content="start" align="start" class="dialog-context">
            <v-col>
              <div>当前温度：{{now.tmp}}℃ {{now.cond_code}} {{now.cond_txt}}</div>
              <div>最高/低气温：{{forecast[0].tmp_max}} ~ {{forecast[0].tmp_min}}</div>
              <div>AQI：{{quality.aqi}}</div>
              <div>风向：{{now.wind_dir}} {{now.wind_sc}}级</div>
              <div>风速：{{now.wind_spd}}km/h</div>
              <div>相对湿度：{{now.hum}}</div>
              <div>降水量：{{now.pcpn}}</div>
              <div>大气压强：{{now.pres}}</div>
              <div>能见度：{{now.vis}}km</div>
              <div>云量：{{now.cloud}}</div>
            </v-col>
            <v-col align-self="center" class="dialog-context">
              <div>更新时间：{{quality.pub_time}}</div>
              <div>AQI：{{quality.aqi}}</div>
              <div>空气质量：{{quality.qlty}}</div>
              <div>主要污染物：{{quality.main}}</div>
              <div>PM10：{{quality.pm10}}</div>
              <div>PM25：{{quality.pm25}}</div>
              <div>二氧化氮：{{quality.no2}}</div>
              <div>二氧化硫：{{quality.so2}}</div>
              <div>一氧化碳：{{quality.co}}</div>
              <div>臭氧：{{quality.o3}}</div>
            </v-col>
          </v-row>
          <v-divider style="margin:2vh;"></v-divider>
          <div style="font-size:4vw;font-weight:600;color:gray;">天气预报</div>
          <v-row>
            <v-col class="dialog-context" cols="6">
              <div>日期：{{forecast[1].date}}</div>
              <div>温度：{{forecast[1].tmp_max}}℃ ~ {{forecast[1].tmp_min}}℃</div>
              <div>日出/日落：{{forecast[1].sr}}/{{forecast[1].ss}}</div>
              <div>月升/月落：{{forecast[1].mr}}/{{forecast[1].ms}}</div>
              <div>白天天气：{{forecast[1].cond_txt_d}}</div>
              <div>夜晚天气：{{forecast[1].cond_txt_n}}</div>
              <div>降水概率：{{forecast[1].pop}}%</div>
              <div>相对湿度：{{forecast[1].hum}}</div>
              <div>风：{{forecast[1].wind_dir}} {{forecast[1].wind_sc}}级</div>
            </v-col>
            <v-col class="dialog-context" cols="6">
              <div>日期：{{forecast[2].date}}</div>
              <div>温度：{{forecast[2].tmp_max}}℃ ~ {{forecast[2].tmp_min}}℃</div>
              <div>日出/日落：{{forecast[2].sr}}/{{forecast[2].ss}}</div>
              <div>月升/月落：{{forecast[2].mr}}/{{forecast[2].ms}}</div>
              <div>白天天气：{{forecast[2].cond_txt_d}}</div>
              <div>夜晚天气：{{forecast[2].cond_txt_n}}</div>
              <div>降水概率：{{forecast[2].pop}}%</div>
              <div>相对湿度：{{forecast[2].hum}}</div>
              <div>风：{{forecast[2].wind_dir}} {{forecast[2].wind_sc}}级</div>
            </v-col>
          </v-row>
        </div>
      </div>
    </v-dialog>
    </v-col>
</template>
<script>
export default {
 data: () => ({
    weatherdialog:false,
    forecast:null,
    now:null,
    quality:null
  }),
  methods:{
    showWeather:function(){
      let that=this;
      this.weatherdialog=true;
      axios.get(`/eboard/getWeather.php`,{
            params:{}
        })
        .then(function (response) {
            that.forecast=response.data.forecast.daily_forecast;
            that.now=response.data.now.now;
            that.quality=response.data.quality.air_now_city;
            console.log(response.data);
        })
        .catch(function (error) {
            console.log(error);
        });
    }
  },
/*created() {
let that=this;
  axios.get(`/eboard/getWeather.php`,{
            params:{}
        })
        .then(function (response) {
            that.forecast=response.data.forecast.daily_forecast;
            that.now=response.data.now.now;
            that.quality=response.data.quality.air_now_city;
            console.log(response.data);
        })
        .catch(function (error) {
            console.log(error);
        });
},*/
}
</script>
