Vue.component("Signup",{
  `
  <template>
  
  <form style="margin-top:50px;" @submit.prevent="signup">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputorganisation">Organisation Name</label>
      <input v-model="form.email" name="email" class="form-control" id="inputorganisation" placeholder="enter the name">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword">Password</label>
      <input v-model="form.password" type="password" class="form-control" id="inputPassword" placeholder=" enter the Password">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputsector">Sector</label>
      <input v-model="form.sector" name="email" class="form-control" id="inputsector" placeholder=" enter the sector">
    </div>
    <div class="form-group col-md-6">
      <label for="inputdate">Date of Assessment</label>
      <input v-model="form.date_of_assesment"  type="date" class="form-control" id="inputdate" placeholder=" enter date">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputinternalexternal">Internal & External</label>
      <input v-model="form.internal_external" name="email" class="form-control" id="inputinternalexternal" placeholder=" enter">
    </div>
    
  </div>
   <div class="form-row">
   
  <div class="form-group col-md-6">
      <input type="submit" class="btn btn-info" name="login" value="SIGN UP">
    </div>
</div>
    <span>
      <li v-for="error in errors">
        {{ error[0] }}
      </li>
    </span>
    

  </form>
  </template>
  `
  <script>
  export default{
    data(){
      return {
        form: new Form({
          email:'',
          password:'',
          sector:'',
          date_of_assesment:'',
          internal_external:''
        }),
        errors:{}
      }
    },
    methods:{
      signup(){
        this.$Progress.start();
        this.form.post('/api/auth/signup')
        .then((response)=>{
          User.ResponseAfterLogin(response);
          this.$Progress.finish();
          this.$router.push({ path:`/userHome`});
        }).catch((error)=>{
          this.errors = error.response.data.errors;
          alert('please check to see your date of assement follows year-month-date such as 1999-05-25');
          this.$Progress.fail();
          })
      }
    }
  }
  </script>
});
