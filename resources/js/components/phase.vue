Vue.component("phase",{
`
<template>
  <div @click="categories" style="cursor:pointer">
  <ul class="list-group" style="width:200px;">
  <li class="list-group-item list-group-item-info" style="colour:#F8F7EF"><h6>{{ phase.id }}.&nbsp;&nbsp;&nbsp;{{ phase.name }}&nbsp;</h6></li>
  </ul>
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
