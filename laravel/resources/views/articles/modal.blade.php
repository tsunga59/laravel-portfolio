<div class="modal" id="js-modal">
    <div class="modal_card">
        <h2>{{ session('achievement_message') }}</h2>
        <p>{{ date('n') }}月の朝活達成日数： <span>{{ Auth::user()->count_achievements }}日</span></p>
        <a href="{{ route('articles.create') }}" class="btn green">自慢する</a>
        <div class="close_btn" id="js-modal-close">×</div>
    </div>
</div>