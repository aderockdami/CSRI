Vue.component("Login",{
  `
  <template>
<form style="margin-top:50px;" @submit.prevent="login">
  <div class="form-row">
  <div class="form-group col-md-3"></div>
    <div class="form-group col-md-6">
      <label>Organisation Name</label>
      <input  v-model="form.email" name="email"  class="form-control" placeholder="enter the name">
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-3"></div>
     <div class="form-group col-md-6">
      <label>Password</label>
      <input  v-model="form.password" type="password" name="password" class="form-control"  placeholder="enter the password">
    </div>
    </div>
     <div class="form-row">
    <div class="form-group col-md-3"></div>
     <div class="form-group col-md-6">
      <input class="btn btn-info" type="submit" name="login" value="LOGIN"/>
    </div>
    </div>
    </div>
  </form>
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
    methods:{
      login(){
        this.$Progress.start();
        this.form.post('/api/auth/login')
        .then((response)=>{
          User.ResponseAfterLogin(response);
          this.$Progress.finish();
          if(User.isAdmin()){
            this.$router.push({ path:`/home`});
          }
          else{
            this.$router.push({ path:`/userHome`});
          }
        }).catch((error)=>{
            this.$Progress.fail();
          })
      }
    }
  }
  </script>
});
