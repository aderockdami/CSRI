Vue.component("navbar",{
`
<template>
  <header>
    <div class="container">
      <span><h1 style="font-size:50px; margin:0; float:left; width:70%;"><router-link to="/">CSRI</router-link></h1></span>
      <span v-if="show()"><h1 style="text-align:center; font-size:20px; float:left; width:15%;"><router-link to="/signup">SIGNUP</router-link></h1></span>
      <span v-if="show()"><h1 style="text-align:center; font-size:20px; float:left; width:15%;"><router-link to="/login">LOGIN</router-link></h1></span>
      <span @click="logout" v-if="!show()"><h1 style="text-align:center; font-size:20px; float:left; width:30%;"><router-link to="">LOGOUT</router-link></h1></span>
    </div>
  </header>
</template>
`
<script>
  export default{
    data(){
      return{

      }
    },
    methods:{
      show(){
        return this.$root.show;
      },
      logout(){
        this.$Progress.start();
        axios.post('/api/auth/logout',{token:Storage.getToken()})
        .then((response)=>{
          Storage.clear();
          this.$Progress.finish();
          this.$router.push('/');
        }).catch((error)=>{
            this.$Progress.fail();
          })
      },
      isAdmin(){
        return User.isAdmin()
      }
    }
  }
</script>
});
