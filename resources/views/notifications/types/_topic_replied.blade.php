<li class="media {{ $loop->last ? 'border-bottom' : '' }}">
    <div class="media-left">
        <a href="{{ route('users.show', $notification->data['user_id']) }}">
            <img src="{{ $notification->data['user_avatar'] }}" alt="{{ $notification->data['user_name'] }}" class="media-object img-thumbnail mr-3" style="width:48px;heiht:48px;" />
        </a>
    </div>

    <div class="media-body">
        <div class="media-heading mt-0 mb-1 text-secondary">
            <a href="{{ route('users.show', $notification->data['user_id']) }}">{{ $notification->data['user_name'] }}</a>

            <span class="meta float-right" title="{{ $notification->created_at }}">
                <i class="far fa-clock">
                    {{ $notification->created_at->diffForHumans() }}
                </i>
            </span>
        </div>

        <div class="reply-content">
            {!! $notification->data['reply_content'] ?? '' !!}
        </div>
    </div>
</li>
