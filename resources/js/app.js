
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
window.axios = require('axios');
import Vue from 'vue';
import VeeValidate from 'vee-validate';

Vue.use(VeeValidate);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// ページ内で利用するパーツコンポーネント
Vue.component('quiz-page', require('./components/public_veiws/QuestionPanel'));
Vue.component('create-page', require('./components/quizzes/InputQuestion'));
Vue.component('create-page', require('./components/quizzes/InputIncorrect'));

// ページ単位のコンポーネント
Vue.component('quiz-page', require('./pages/Quiz'));
Vue.component('create-page', require('./pages/Create'));


const app = new Vue({
    el: '#app'
});

