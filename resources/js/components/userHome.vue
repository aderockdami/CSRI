Vue.component("userHome",{
`
<template>
<div style="text-align:center">
  Please answer questions from each category and then click on calculate results.
  <br>
  <br>
  Categories
  <category v-for="category in categories" :key="category.path" :category="category"></category>
  <br>
  <br>
  <input type="submit" value="CALCULATE RESULTS" @click="calculateResults">
  <br>
  <br>
  RESET IF YOU WANT TO RETAKE THE TEST
  <br>
  <br>
  <input type="reset" name="" value="RESET" @click="clearResults">
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
      categories:{}
    }
  },
  created(){
    this.$root.$data.show = false;
    this.displayCategories();
  },
  methods:{
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
