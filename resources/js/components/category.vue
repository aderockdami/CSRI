Vue.component("category",{
`
<template>
<div style="text-align:center">
  <br>
  <span @click="question" style="cursor:pointer">
  name {{ category.name }}&nbsp;
  weight {{ category.weight }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>
  <span v-if="Admin" @click="deleteCategory" >delete</span>
</div>
</template>
`
<script>
export default{
  props:['category'],
  data(){
    return{
      Admin:User.isAdmin()
    }
  },
  methods:{
    question(){
      const category = this.category
      this.$router.push({name:'questions',params:{category}})
    },
    deleteCategory(){
      console.log(this.category.id);
      axios.delete('/api/admin/category/'+this.category.id,{ data: { token: Storage.getToken() }})
      .then((response)=>{
        this.$Progress.finish();
        this.$parent.displayCategories();
      })
      .catch((errors)=>{
        this.$Progress.fail();
      })
    }
  }
 }
</script>
});
