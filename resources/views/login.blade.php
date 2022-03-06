@extends('master')

@section('content')

<section id="login-main">
    <aside>
        <img src="{{ asset('images/humanflag.png') }}">
    </aside>

    <form id="login-form" method="POST" action="{{ route('checkLogin') }}">
        @csrf
        <h1>
            Login
        </h1>

        <p class="error">
            Email or password not correct
        </p>

        @if (session('error'))
            <script>
                setTimeout(() => {
                    $('.error').css('display', 'block')
                    setTimeout(() => {$('.error').css('height', '3.7rem')}, 100)
                }, 0)
            </script>
        @endif

        <label for="email">
            Your E-Mail
        </label>
        <input id="email" name="email" type="email" placeholder="contact@viktorkarpinski.com" required>

        <label for="password">
            Your Password
        </label>
        <input id="password" name="password" type="password" placeholder="#MyPassword19" autocomplete="off" required>
        <button>
            Sign In
        </button>
    </form>
</section>

@endsection
