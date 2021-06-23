<div class="ranking_list">
    <span class="rank{{ $ranked_user->rank }}">{{ $ranked_user->rank }}位</span>
    <div class="user_info">
        <a href="route('users.show', ['user' => $ranked_user]) }}">
            @if(!empty($ranked_user->profile_image))
            <img src="/storage/profile_images/{{ $ranked_user->profile_image }}">
            @else
            <i class="far fa-user fa-lg"></i>
            @endif
        </a>
        <a href="{{ route('users.show', ['user' => $ranked_user]) }}" class="name">
            {{ $ranked_user->name }}
        </a>
    </div>
    <p>{{ $ranked_user->achievements_count }}日</p>
</div>