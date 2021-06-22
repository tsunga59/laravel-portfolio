<div class="sidebar_card">
    <h2>{{ date('n') }}月の朝活達成ランキング</h2>
    @foreach ($ranked_users as $ranked_user)
        @include('articles.ranking')
    @endforeach
</div>
<div class="sidebar_card">
    <h2>朝活達成ランクバッジ</h2>
    @include('articles.rank')
</div>

<!-- SP時のランキング非表示ボタン -->
<div class="sidebar_close_btn sp" id="js-sidebar-close-btn">
    <i class="fas fa-times fa-2x"></i>
</div>