require('./bootstrap');

import Vue from 'vue'

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

// プロフィール画像のプレビュー機能
if(document.getElementById('js-image-picker') != null) {
    document.querySelector('.js-image-picker input')
        .addEventListener('change', (e) => {
            const input = e.target;
            const reader = new FileReader();
            reader.onload = (e) => {
                input.closest('.js-image-picker').querySelector('img').src = e.target.result
            };
            reader.readAsDataURL(input.files[0]);
        });
}

// 朝活達成モーダルの非表示
if(document.getElementById('js-modal-close') != null) {
    document.getElementById('js-modal-close')
        .addEventListener('click', function() {
            const modal = document.getElementById('js-modal');
            modal.classList.add('hidden');
        });
}

// SP時のランキング表示・非表示
if(document.getElementById('js-sidebar-btn') != null) {
    document.getElementById('js-sidebar-btn')
        .addEventListener('click', function() {
            const sidebar = document.getElementById('js-sidebar');
            const sidebarBtn = document.getElementById('js-sidebar-btn');
            const sidebarIcon = document.getElementById('js-sidebar-icon');
            let sidebarOpen = false;

            if(!sidebarOpen) {
                sidebar.classList.add('show');
                sidebarBtn.classList.add('show');
                // sidebarIcon.classList.add('fas fa-times');
                sidebarOpen = true;
            } else {
                sidebar.classList.remove('show');
                sidebarBtn.classList.remove('show');
                // sidebarIcon.classList.remove('fas fa-times');
                sidebarOpen = false;
            }
        });
}