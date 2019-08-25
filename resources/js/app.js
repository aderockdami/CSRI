require('./bootstrap');
import router from "./routes"

Vue.component('navbar',require('./components/navbar.vue').default);


const app = new Vue({
    el: '#app',
    router:router,
    data() {
      return {
        show:true
      };
    },
    methods: {

    }
});
