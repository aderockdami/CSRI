Vue.component("home",{
`
<template>
<table class="table" style="margin-top:50px;">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Phases</th>
     
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td><phase v-for="phase in phases" :key="phase.path" :phase="phase"></phase></td>  
    </tr>
  </tbody>
</table>
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
