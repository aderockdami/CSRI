Vue.component("categories",{
`
<template>
<div class="alert alert-info text-align-center" role="alert" style="margin-top:50px;">
  <form v-if="Admin" class="" @submit.prevent="createCategory">
    <input v-model="form.name" placeholder="Category name" style="margin-top:30px;"/>
    <br>
    <input v-model="form.weight" placeholder="Category Weight" style="margin-top:30px;"/>
    <br>
    <input type="submit" class="btn btn-info" name="login" value="CREATE" style="margin-top:30px;"/>
  </form>
  <br>
  <div class="row">
  <div class="col-md-6">
  <h4>Category Name</h4>
  </div>
  <div class="col-md-6">
  <h4>Category Weight</h4>
  </div>
  </div>
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
      categories:{},
      phase:0,
      Admin:true
    }
  },
  created(){
    this.$root.$data.show = false;
    this.phase = this.$root.$data.phase;
    this.Admin =  User.isAdmin();
    this.displayCategories();
  },
  methods:{
    createCategory(){
        this.$Progress.start();
        axios.post('/api/admin/category',{name:this.form.name,weight:this.form.weight,phase_id:this.phase.id,token:Storage.getToken()})
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
      axios.get('/api/user/category/' + this.phase.id,{params:{token:Storage.getToken()}})
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
