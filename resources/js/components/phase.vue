Vue.component("phase",{
`
<template>
<div style="text-align:center">
  <br>
  <div v-if="phase.id != 6"@click="categories" style="cursor:pointer">
  name {{ phase.name }}&nbsp;
  </div>
</div>
</template>
`
<script>
export default{
  props:['phase'],
  data(){
    return{

    }
  },
  methods:{
    categories(){
      const phase = this.phase;
      this.$root.$data.phase = this.phase;
      this.$router.push({name:'categories',params:{phase}})
    }
  }
 }
</script>
});
