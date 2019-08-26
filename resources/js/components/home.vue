Vue.component("home",{
`
<template>
<div style="text-align:center">
  <br>
  <form class="" @submit.prevent="createCategory">
    <input v-model="form.name" placeholder="Category name" style="margin-top:30px;"/>
    <br>
    <input v-model="form.weight" placeholder="Category Weight" style="margin-top:30px;"/>
    <br>
    <input type="submit" name="login" value="CREATE" style="margin-top:30px;"/>
  </form>
  <br>
  Categories
  <category v-for="category in categories" :key="category.path" :category="category"></category>
</div>
</template>
`
<script>
import category from './category.vue';
export default {
  components: {
    category
  },
  data(){
    return{
      form: new Form({
        name:"",
        weight:""
      }),
      categories:{}
    }
  },
  created(){
    this.$root.$data.show = false;
    this.displayCategories();
  },
  methods:{
    createCategory(){
        this.$Progress.start();
        axios.post('/api/admin/category',{name:this.form.name,weight:this.form.weight,token:Storage.getToken()})
        .then((response)=>{
          this.$Progress.finish();
          this.displayCategories();
          alert('created');
        }).catch((error)=>{
            this.$Progress.fail();
          })
    },
    displayCategories(){
      this.$Progress.start();
      axios.get('/api/user/category',{params:{token:Storage.getToken()}})
        .then((response)=>{
          this.$Progress.finish();
          this.categories = response.data.data
        })
        .catch((error)=>{
        this.$Progress.fail();
        })
    }
  }
 }
</script>
});
