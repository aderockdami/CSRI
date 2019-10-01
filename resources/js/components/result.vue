Vue.component("result",{
`
<template>
<div style="text-align:center">
  <div style="display:inline-block;">
    <br>
    <br>
    <apexchart type=radar height=500 :options="chartOptions" :series="series" />
   <div class="col-md-10 alert alert-info">
    <h5>OVERALL MATURITY RATING : {{weightedAverage}}</h5>
    </div>
    <div class="col-md-10 alert alert-info">
    <h5>OVERALL MATURITY LEVEL : {{matuarity}}</h5>
    </div>
  </div>
  <div>
  <div class="col-md-10 alert alert-info">
    <h3>Maturity Rating and Level by Phase</h3>
    </div>
  </div>
  <br>
  <br>
  <rating v-for="(rating, index) in ratings" :key="rating.path" :rating="rating"></rating>
</div>
</template>
`
<script>
import rating from './ratings.vue';
export default {
  components: {
    rating
  },
  data(){
    return{
      series: [{
          name: 'Series 1',
          data: [],
      }],
      chartOptions: {
        labels: [],
        title: {
            text: 'MATURITY LEVELS'
        }
      },
      weightedAverage:0,
      matuarity:"",
      ratings:{}
    }
  },
  created(){
    this.displayResults();
  },
  methods:{
    displayResults(){
      axios.get('/api/user/result/'+User.id(),{params:{token:Storage.getToken()}})
        .then((response)=>{

          this.ratings = response.data.data;
          this.$Progress.finish();
          for (var i = 0; i < response.data.data.length; i++) {
            var obj = response.data.data[i];
            let name = Object.keys(obj)[0];
            for (var j = 0; j < eval(`response.data.data[i].${name}.length`); j++) {
              this.name = name;
              this.chartOptions.labels.push(eval(`response.data.data[i].${name}[j].category`));
              this.series[0].data.push(eval(`response.data.data[i].${name}[j].average`));
              this.weightedAverage +=  eval(`response.data.data[i].${name}[j].weightedAverage`);
            }
          }
          this.chartOptions.labels.push("Benchmark");
          this.series[0].data.push(5);
          this.weightedAverage = Math.floor(this.weightedAverage/this.ratings.length);
          if(this.weightedAverage>=80 && this.weightedAverage <= 100){
            this.matuarity = "ADAPTIVE LEVEL 4"
          }
          else if (this.weightedAverage>=50 && this.weightedAverage <= 79) {
            this.matuarity = "REPETABLE LEVEL 3"
          }
          else if (this.weightedAverage>=30 && this.weightedAverage <= 49) {
            this.matuarity = "RISK INFORMED LEVEL 2"
          }
          else if (this.weightedAverage>=0 && this.weightedAverage <= 29) {
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
