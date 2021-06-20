<dl>
    <dd class="profile_image_area js-image-picker" id="js-image-picker">
        <input type="file" name="profile_image" id="profile_image" value="{{ old('profile_image') ?? $user->profile_image }}" style="display: none" {{ Auth::id() == config('user.guest_user_id') ? 'disabled' : '' }}>
        <label for="profile_image">
            @if(!empty($user->profile_image))
            <img src="/storage/profile_images/{{ $user->profile_image }}" accept="image/*">
            @else
            <img src="/images/default-profile.png">
            @endif
        </label>
    </dd>
    <dt>
        <label for="name">ユーザー名(12文字以内)</label>
    </dt>
    <dd>
        <input type="text" name="name" id="name" value="{{ old('name') ?? $user->name }}" {{ Auth::id() == config('user.guest_user_id') ? 'disabled' : '' }}>
    </dd>
    <dt>
        <label for="self_introduction">自己紹介・意気込み(200文字以内)</label>
    </dt>
    <dd>
        <textarea name="self_introduction" id="self_introduction" rows="6">{{ old('self_introduction') ?? $user->self_introduction }}</textarea>
    </dd>
    <dt>
        <label for="wake_up_time">朝活目標時間(04:00〜08:00/15分毎)</label>
    </dt>
    <dd>
        <input type="time" name="wakeup_time" id="wakeup_time" list="time_list" min="04:00" max="08:00" step="900" value="{{ old('wakeup_time') ?? substr($user->wakeup_time,0,5) }}">
        <datalist id="time_list">
            <option value="04:00"></option>
            <option value="04:30"></option>
            <option value="05:00"></option>
            <option value="05:30"></option>
            <option value="06:00"></option>
            <option value="06:30"></option>
            <option value="07:00"></option>
            <option value="07:30"></option>
            <option value="08:00"></option>
        </datalist>
    </dd>
</dl>