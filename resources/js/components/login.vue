Vue.component("Login",{
  `
  <template>
  <div style="text-align:center; margin-top:30px;">
    <form  @submit.prevent="login">
      <input v-model="form.email" name="email" placeholder="ORGANIZATION NAME" style="margin-top:30px;"/>
      <br/>
      <input v-model="form.password" type="password" name="password" placeholder="PASSWORD"/>
      <br>
      <input type="submit" name="login" value="LOGIN"/>
      <br>
    </form>
  </div>
  </template>
  `
  <script>
  export default{
    data(){
      return {
        form: new Form({
          email:'',
          password:''
        })
      }
    },
    created(){
      if(User.loggedIn()){
        this.$router.push({ path:`/home`});
      }
    },
    methods:{
      login(){
        this.$Progress.start();
        this.form.post('/api/auth/login')
        .then((response)=>{
          User.ResponseAfterLogin(response);
          this.$Progress.finish();
          this.$root.show = false;
          this.$router.push({ path:`/home`});
        }).catch((error)=>{
            this.$Progress.fail();
          })
      }
    }
  }
  </script>
});
