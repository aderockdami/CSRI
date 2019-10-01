Vue.component("userHome",{
`
<template>
<div class="alert alert-info text-align-center" role="alert" style="margin-top:50px;">
 <h4>Please Answer Questions From Each Category & Click On Calculate Results.</h4>
<div style="margin-top:20px;">
 
  <phase v-for="phase in phases" :key="phase.path" :phase="phase"></phase>
<br>
  <input type="submit" class="btn btn-info" value="CALCULATE RESULTS" @click="calculateResults">
  <br><br>
  <h5>Reset if you want to retake the test &nbsp;&nbsp;&nbsp;
  <input class="btn btn-info" type="reset" name="" value="RESET" @click="clearResults"></h5>
</div>
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
