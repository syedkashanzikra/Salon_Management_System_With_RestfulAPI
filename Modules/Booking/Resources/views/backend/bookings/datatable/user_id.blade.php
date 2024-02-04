<div class="d-flex gap-3 align-items-center">
  <img src="{{ $data->user->profile_image ?? default_user_avatar() }}" alt="avatar" class="avatar avatar-40 rounded-pill">
  <div>
    <h6 class="m-0">{{ $data->user->full_name ?? default_user_name() }}</h6>
    <small>{{ $data->user->email ?? '--' }}</small>
  </div>
</div>
