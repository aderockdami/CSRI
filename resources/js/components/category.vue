Vue.component("category",{
`
<template>
<div style="text-align:center">
  <br>
  <div @click="question" style="cursor:pointer">
  name {{ category.name }}&nbsp;
  weight {{ category.weight }}&nbsp;
  </div>
</div>
</template>
`
<script>
export default{
  props:['category'],
  data(){
    return{

    }
  },
  methods:{
    question(){
      const category = this.category
      this.$router.push({name:'questions',params:{category}})
    }
  }
 }
</script>
});
