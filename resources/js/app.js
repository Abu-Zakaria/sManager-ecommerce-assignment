require('./bootstrap');
import Vue from 'vue';
import Homepage from './components/Homepage.vue';

Vue.component("homepage", Homepage);

new Vue({
	el: "#app",
})