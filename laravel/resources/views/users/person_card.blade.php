<div class="person_card">
    <a href="{{ route('users.show', ['user' => $person]) }}" class="person_image">
        @if(!empty($person->profile_image))
        <img src="/storage/profile_images/{{ $person->profile_image }}">
        @else
        <i class="far fa-user fa-2x"></i>
        @endif
    </a>
    <a href="{{ route('users.show', ['user' => $person]) }}" class="person_name">
        {{ $person->name }}
    </a>
    @if(!Auth::id() === $person->id)
    <div class="person_menu">
      <follow-button
       :initial-has-followed='@json($user->hasFollowed(Auth::user()))'
       :authorized='@json(Auth::check())'
       endpoint="{{ route('users.follow', ['user' => $user]) }}"
      >
      </follow-button>
    </div>
    @endif
</div>