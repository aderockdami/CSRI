Vue.component("navbar",{
`
<template>
<nav class="navbar">
  <span class="navbar-brand"><router-link to="/">CSRI</router-link></span>
   <ul class="nav">
  <li class="nav-item">
    <a v-if="show()" class="nav-link active" href="#"><router-link to="/login">Login</router-link></a>
  </li>
  <li class="nav-item">
    <a v-if="show()"class="nav-link" href="#"><router-link to="/signup">Signup</router-link></a>
  </li>
  <li class="nav-item">
    <a @click="logout" v-if="!show()"class="nav-link" href="#"><router-link to="">Logout</router-link></a>
  </li>
</ul>
    </nav>
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
