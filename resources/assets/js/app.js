require('./bootstrap');

window.Vue = require('vue');

window.VueResource = require('vue-resource');

moment = require('moment');
moment.locale('fr');

Vue.component('benevoles', require('./components/BenevolesComponent.vue'));
Vue.component('captures', require('./components/CapturesComponent.vue'));
Vue.component('cats', require('./components/CatsComponent.vue'));
Vue.component('participants', require('./components/ParticipantsComponent.vue'));

const app = new Vue({
    el: '#app'
});
