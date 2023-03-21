@extends('layouts.guest')
@section('title', 'Login')
@section('content')
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="Midone - HTML Admin Template" class="w-6" src="{{ asset('assets/images/logo.svg') }}">
                    <span class="text-white text-lg ml-3"> Artemis </span>
                </a>
                <div class="my-auto">
                    <img alt="Midone - HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="{{ asset('assets/images/logo.svg') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        A few more clicks to
                        <br>
                        sign in to your account.
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Manage all your tickets in one
                        place.
                    </div>
                </div>
            </div>

            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <form action="{{ route('login') }}" method="POST" autocomplete="off">
                        @csrf
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Login to Artemis
                        </h2>
                        <div class="intro-x mt-8">
                            <input type="text" class="intro-x login__input form-control py-3 px-4 block" name="email" placeholder="Email" value="{{ old('email') ?? 'admin@artemis.com' }}" required>
                            <input type="password" class="intro-x login__input form-control py-3 px-4 block mt-4" name="password" value="password"
                                   placeholder="Password" required>
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left mb-5">
                            <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Login</button>
                        </div>

                        <hr>
                        <p class="pt-4 mb-4">
                            We've autocompleted a user for you!
                            <br>
                            Optionally, you may use any of these other users.
                            <br>
                            <br>
                            <span class="text-primary" style="font-weight: bold;">Administrator:</span> admin@artemis.com
                            <br>
                            <span class="text-primary" style="font-weight: bold;">Engineer:</span> demoengineer@artemis.com
                            <br>
                            <span class="text-primary" style="font-weight: bold;">Password:</span> password
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
