require('./bootstrap');

// window.Vue = require('vue').default;
import Vue from 'vue'

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
import ArticleTagsInput from './components/ArticleTagsInput'
import ArticleLike from './components/ArticleLike'
import FollowButton from './components/FollowButton'

const app = new Vue({
    el: '#app',
    components: {
        ArticleTagsInput,
        ArticleLike,
        FollowButton,
    }
});

document.querySelector('.js-image-picker input')
    .addEventListener('change', (e) => {
        const input = e.target;
        const reader = new FileReader();
        reader.onload = (e) => {
            input.closest('.js-image-picker').querySelector('img').src = e.target.result
        };
        reader.readAsDataURL(input.files[0]);
    });
