Vue.component("card",{
`
<template>
<div style="display:inline-block;">
  {{ card.category }}
  <br>
  <br>
  CATEGORY WEIGHT : {{ card.weight }}
  <br>
  TOTAL SCORE : {{card.score}}
  <br>
  SCORE OUT OF 100 : {{card.average100}}
  <br>

  <chart :options="chartOptionsBar"></chart>
</div>
</template>
`
<script>
export default{
  props:['card'],
  data(){
    return{
      chartOptionsBar: {
        xAxis: {
          data: ["average Score","total score obtainable"]
        },
        yAxis: {
          type: 'value'
        },
        series: [
          {
            type: 'bar',
            data: [this.card.average,5]
          }
        ]
      }
    }
  }
 }
</script>
});
