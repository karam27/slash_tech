@if (session('error'))
    <div style="color: red; font-weight: bold;">
        {{ session('error') }}
    </div>
@endif
