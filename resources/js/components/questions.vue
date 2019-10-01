Vue.component("questions",{
`
<template>
<div>
<div class="card text-white bg-dark mb-3" style="max-width:25rem;margin-top:30px;">
  <div class="card-body">
    <h5 class="card-title">Category name:{{ this.category.name }}</h5>
    <h5 class="card-title">Category weight:{{ this.category.weight }}</h5>
  </div>
</div>
  <form v-if="Admin" class="" @submit.prevent="createQuestion">
    <input v-model="form.question" placeholder="Question" style="margin-top:30px;"/>
    <br>
    <input type="submit" name="login" class="btn btn-info" value="Create Question" style="margin-top:30px;"/>
  </form>
  <br>
  <br>
  <div v-if="Admin">
  <div class="col-md-10 alert alert-info">
  <h4>Questions</h4>
  <question v-for="question in questions" :key="question.path" :question="question"></question>
  </div>
  </div>
    <div v-if="!Admin" class="row">
    <div class="col-md-10 alert alert-info">
     <h4>Questions</h4>
      <question v-for="question in questions" :key="question.path" :question="question"></question>
    </div>
    <div class="col-md-2 alert alert-info">
    <h4>Options</h4>
        <div v-for="question in questions">
      <select name="options" style="margin-top:23px;">
        <option value="1">
          INITIAL
        </option>
        <option value="2">
          REPETABLE
        </option>
        <option value="3">
          DEFINED
        </option>
        <option value="4">
          MANAGED
        </option>
        <option value="5">
          OPTIMIZING
        </option>
      </select>
      </div>
    </div>
  </div>
   <div>
    <input v-if="!Admin" class="btn btn-info" type="submit" value="SUBMIT" @click="submit">
  </div>
  </div>
</template>
`
<script>
import question from './question.vue';
export default {
    components: {
      question
    },
  props:['category'],
  data(){
    return{
      form: new Form({
        question:""
      }),
      questions:{},
      Admin:true,
      score:0
    }
  },
  created(){
    this.Admin = User.isAdmin();
    this.displayQuestions();
    this.score = "";
  },
  methods:{
    createQuestion(){
      this.$Progress.start();
      axios.post('/api/admin/question/'+this.category.id,{question:this.form.question,token:Storage.getToken()})
      .then((response)=>{
        this.$Progress.finish();
        alert('created');
        this.displayQuestions();
      }).catch((error)=>{
        this.$Progress.fail();
      })
    },
    displayQuestions(){
      this.$Progress.start();
      axios.get('/api/user/question/'+this.category.id,{params:{token:Storage.getToken()}})
        .then((response)=>{
          this.$Progress.finish();
          this.questions = response.data.data
        })
        .catch((error)=>{
        this.$Progress.fail();
        })
    },
    submit(){
      for (var i = 0; i < document.getElementsByName('options').length; i++) {
        this.score += parseInt(document.getElementsByName('options')[i].value);
      }
      if(document.getElementsByName('options').length != 1){
        this.score = this.score.substring(0, this.score.length - 1);
      }
      axios.post('/api/user/result/'+this.category.id,{response:this.score,token:Storage.getToken(),phase_id:this.$root.$data.phase.id})
      .then((response)=>{
        this.$Progress.finish();
        this.$router.push({ path:`/userHome`});
      }).catch((error)=>{
        this.$Progress.fail();
      })
    }
  }
 }
</script>
});
