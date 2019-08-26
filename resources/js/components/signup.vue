Vue.component("Signup",{
  `
  <template>
  <div style="text-align:center; margin-top:30px;">
    <span>
      <li v-for="error in errors">
        {{ error[0] }}
      </li>
    </span>
    <form  @submit.prevent="signup">
      <input v-model="form.email" name="email" placeholder="ORGANIZATION NAME" style="margin-top:30px;"/>
      <br/>
      <input v-model="form.password" type="password" name="password" placeholder="PASSWORD" style="margin-top:30px;"/>
      <br>
      <input v-model="form.sector" name="email" placeholder="SECTOR" style="margin-top:30px;"/>
      <br/>
      <input v-model="form.date_of_assesment" placeholder="DATE OF ASSESMENT" style="margin-top:30px;"/>
      <br>
      <input v-model="form.internal_external" name="email" placeholder="INTERNAL OR EXTERNAL" style="margin-top:30px;"/>
      <br>
      <input type="submit" name="login" value="SIGN UP" style="margin-top:30px;"/>
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
