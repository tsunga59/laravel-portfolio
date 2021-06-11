require('./bootstrap');

// window.Vue = require('vue').default;
import Vue from 'vue'

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
import ArticleTagsInput from './components/ArticleTagsInput' 

const app = new Vue({
    el: '#app',
    components: {
        ArticleTagsInput,
    }
});
