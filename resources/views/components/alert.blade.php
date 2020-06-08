<div>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
    
    @if(session()->has('message'))
        {{ $slot }}
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @elseif(session()->has('error'))
        {{ $slot }}
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    {{-- When using error request handler component --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>