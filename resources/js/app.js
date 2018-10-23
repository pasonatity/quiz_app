
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
window.axios = require('axios');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// ページ内で利用するパーツコンポーネント
Vue.component('quiz-page', require('./components/QuizPannel.vue'));

// ページ単位のコンポーネント
Vue.component('quiz-page', require('./pages/Quiz.vue'));
const app = new Vue({
    el: '#app'
});