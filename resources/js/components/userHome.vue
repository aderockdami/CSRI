Vue.component("userHome",{
`
<template>
<div style="text-align:center">
  Please answer questions from each category from each phase and then click on calculate results.
  <br>
  <br>
  <h1>PHASES</h1>
  <phase v-for="phase in phases" :key="phase.path" :phase="phase"></phase>
  <br>
  <br>
  <input type="submit" value="CALCULATE RESULTS" @click="calculateResults">
  <br>
  <br>
  RESET IF YOU WANT TO RETAKE THE TEST
  <br>
  <br>
  <input type="reset" name="" value="RESET" @click="clearResults">
</div>
</template>
`
<script>
import phase from './phase.vue';
export default {
  components: {
    phase
  },
  data(){
    return{
      phases:{}
    }
  },
  created(){
    this.$root.$data.show = false;
    this.displayPhases();
  },
  methods:{
    displayPhases(){
      this.$Progress.start();
      axios.get('/api/user/phase',{params:{token:Storage.getToken()}})
        .then((response)=>{
          this.$Progress.finish();
          this.phases = response.data.data
        })
        .catch((error)=>{
        this.$Progress.fail();
        })
    },
    calculateResults(){
      this.$router.push({ path:`/result`});
    },
    clearResults(){
      axios.delete('/api/user/result/'+User.id(),{params:{token:Storage.getToken()}})
        .then((response)=>{
          alert('response cleared you can take the test again');
          this.$Progress.finish();
        })
        .catch((error)=>{
        this.$Progress.fail();
        })
    }
  }
 }
</script>
});
