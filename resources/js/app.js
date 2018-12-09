
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
window.axios = require('axios');
import Vue from 'vue';
import VeeValidate, { Validator } from 'vee-validate';
import ja from 'vee-validate/dist/locale/ja'

Validator.localize('ja', ja);
// Vue.use(VeeValidate);
Vue.use(VeeValidate, { locale: ja });
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// ページ内で利用するパーツコンポーネント
// Vue.component('quiz-page', require('./components/public_views/QuestionPanel'));
// Vue.component('create-page', require('./components/quizzes/Form'));
// Vue.component('create-page', require('./components/quizzes/InputQuestion'));
// Vue.component('create-page', require('./components/quizzes/InputIncorrect'));

// ページ単位のコンポーネント
Vue.component('quiz-page', require('./pages/Quiz'));
Vue.component('create-page', require('./pages/Create'));
Vue.component('edit-page', require('./pages/Edit'));

const app = new Vue({
    el: '#app'
});

// TODO:マイページ削除処理時のみに実行されるよう修正が必要
let btnDelete = document.getElementsByClassName("btn-delete");
for (let i = 0; i < btnDelete.length; i++) {
    btnDelete[i].addEventListener('click', function(e) {
        if (confirm('削除します。よろしいですか？')) {
            document.getElementsByClassName("loading-bg")[0].style.display = 'block';
            document.getElementById('form_' + this.dataset.id).submit();
        }
    });
}
