require('./bootstrap');

window.Vue = require('vue').default;

const axios = require('axios')

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('contacts', require('./components/Contacts.vue').default);


const app = new Vue({
    el: '#app',
});
