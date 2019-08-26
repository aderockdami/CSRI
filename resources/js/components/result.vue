Vue.component("result",{
`
<template>
<div style="text-align:center">
  <div style="display:inline-block;">
    A CHART SHOWING Average FOR EACH CATEGORY BY NAME
    <chart :options="chartOptionsBar"></chart>
    <br>
    MATURITY RATING : {{weightedAverage}}
    <br>
    <br>
    MATURITY LEVEL : {{matuarity}}
  </div>
  <br>
  <br>
  <br>
  DATA BY EACH CATEGORY
  <br>
  <br>
  <br>
  <card v-for="card in cards" :key="card.path" :card="card"></card>
</div>
</template>
`
<script>
import card from './card.vue';
export default {
  components: {
    card
  },
  data(){
    return{
      chartOptionsBar: {
        xAxis: {
          data: []
        },
        yAxis: {
          type: 'value'
        },
        series: [
          {
            type: 'bar',
            data: []
          }
        ]
      },
      weightedAverage:0,
      matuarity:"",
      cards:{}
    }
  },
  created(){
    this.displayResults();
  },
  methods:{
    displayResults(){
      axios.get('/api/user/result/'+User.id(),{params:{token:Storage.getToken()}})
        .then((response)=>{
          this.$Progress.finish();
          this.cards = response.data.data;
          for (var i = 0; i < response.data.data.length; i++) {
            this.chartOptionsBar.xAxis.data.push(response.data.data[i].category);
            this.chartOptionsBar.series[0].data.push(response.data.data[i].average);
            this.weightedAverage +=  response.data.data[i].weightedAverage;
          }
          if(this.weightedAverage>=80 && this.weightedAverage <= 100){
            this.matuarity = "ADAPTIVE LEVEL 4"
          }
          else if (this.weightedAverage>=70 && this.weightedAverage <= 79) {
            this.matuarity = "REPETABLE LEVEL 3"
          }
          else if (this.weightedAverage>=60 && this.weightedAverage <= 60) {
            this.matuarity = "RISK INFORMED LEVEL 2"
          }
          else if (this.weightedAverage>=0 && this.weightedAverage <= 59) {
            this.matuarity = "PARTIAL LEVEL 1"
          }
        })
        .catch((error)=>{
        this.$Progress.fail();
        })
    }
  }
 }
</script>
});
