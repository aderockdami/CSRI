Vue.component("rating",{
`
<template>
<div style="text-align:center">
  <div style="display:inline-block;">
    <span> PHASE : {{name}} </span>
    <span style="margin-left:20px;" > MATURITY RATING : {{weightedAverage}}</span>
    <span style="margin-left:20px;" >MATURITY LEVEL : {{matuarity}}</span>
  </div>
  <br>
  <br>
  <br><br><br>
</div>
</template>
`
<script>
export default {
  props:['rating'],
  data(){
    return{
      name:"",
      weightedAverage:0,
      matuarity:""
    }
  },
  created(){
    this.displayResults();
  },
  methods:{
    displayResults(){
      var obj = this.rating;
      let name = Object.keys(obj)[0];
      for (var i = 0; i < eval(`this.rating.${name}.length`); i++) {
        this.name = name;
        this.weightedAverage +=  eval(`this.rating.${name}[i].weightedAverage`);
      }

      this.weightedAverage = Math.floor(this.weightedAverage);

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
    }
  }
 }
</script>
});
