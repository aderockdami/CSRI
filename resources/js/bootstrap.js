import Vue from "vue";
import axios from "axios";
import VueRouter from "vue-router";
import {Form,HasError,AlertError} from 'vform';
import VueProgressBar from 'vue-progressbar';
import VueApexCharts from 'vue-apexcharts'
import Storage from './helpers/Storage'
import Token from './helpers/Token'
import User from './helpers/User'

Vue.use(VueProgressBar,{
  color:'#bffaf3',
  failedColor:'red',
  height:'3px'
})

Vue.component('apexchart', VueApexCharts)

window.Form = Form;
Vue.component(HasError.name,HasError)
Vue.component(AlertError.name, AlertError)

window.Vue = Vue;

Vue.use(VueRouter);

window.Storage = Storage;
window.Token = Token;
window.User = User;

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
