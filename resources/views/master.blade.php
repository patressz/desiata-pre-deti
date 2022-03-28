@include('partials.header')

    <div class="bg-height my-5">
        @include('layouts.messages')
        @yield('errors')
        @yield('content')
    </div>

@include('partials.footer')
