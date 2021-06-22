require('./bootstrap');

import Vue from 'vue'

import ArticleTagsInput from './components/ArticleTagsInput'
import ArticleLike from './components/ArticleLike'
import FollowButton from './components/FollowButton'
import { zipWith } from 'lodash';

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
if(document.getElementById('js-sidebar-open-btn') != null) {

    const sidebar = document.getElementById('js-sidebar');
    const sidebarOpenBtn = document.getElementById('js-sidebar-open-btn');
    const sidebarCloseBtn = document.getElementById('js-sidebar-close-btn');

    // 表示ボタンクリック時の処理
    sidebarOpenBtn.addEventListener('click', function() {
        sidebar.classList.add('show');
        sidebarOpenBtn.classList.add('hidden');
    });
            
    // 非表示ボタンクリック時の処理
    sidebarCloseBtn.addEventListener('click', function() {
        sidebar.classList.remove('show');
        sidebarOpenBtn.classList.remove('hidden');
    });

}