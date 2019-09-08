Vue.component("home",{
`
<template>
<div style="text-align:center">
  <br>
  <h1>PHASES</h1>
  <phase v-for="phase in phases" :key="phase.path" :phase="phase"></phase>
  <br>
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
    }
  }
 }
</script>
});
