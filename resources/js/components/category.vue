Vue.component("category",{
`
<template>
<div @click="question" style="cursor:pointer">
  <div class="row">
    <div class="col-md-6">
      <ul class="list-group">
      <li class="list-group-item">{{ category.name }}</li>
      </ul>
    </div>
    <div class="col-md-6">
     <ul class="list-group">
      <li class="list-group-item">{{ category.weight }}</li>
      </ul>
    </div>
  </div>
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
