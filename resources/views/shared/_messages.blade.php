@foreach(['success', 'error', 'warning', 'info'] as $message)
    @if(session()->has($message))
        <div class="flesh-message">
            <p class="alert {{ 'alert-'.$message }}">
                {{ session()->get($message) }}
            </p>
        </div>
    @endif
@endforeach
