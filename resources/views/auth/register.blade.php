


<style>
    
    .bn632-hover {
  width: 160px;
  font-size: 16px;
  font-weight: 600;
  color: #fff;
  cursor: pointer;
  margin: 20px;
  height: 55px;
  text-align:center;
  border: none;
  background-size: 300% 100%;
  border-radius: 50px;
  moz-transition: all .4s ease-in-out;
  -o-transition: all .4s ease-in-out;
  -webkit-transition: all .4s ease-in-out;
  transition: all .4s ease-in-out;
}

.bn632-hover:hover {
  background-position: 100% 0;
  moz-transition: all .4s ease-in-out;
  -o-transition: all .4s ease-in-out;
  -webkit-transition: all .4s ease-in-out;
  transition: all .4s ease-in-out;
}

.bn632-hover:focus {
  outline: none;
}

.bn632-hover.bn19 {
  background-image: linear-gradient(
    to right,
    #f5ce62,
    #e43603,
    #fa7199,
    #e85a19
  );
  box-shadow: 0 4px 15px 0 rgba(229, 66, 10, 0.75);
}
</style> 

<x-auth-layout>
    <x-slot name="title">
        @lang('Register')
    </x-slot>

    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 " />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <!-- Social login -->
        <x-auth-social-login />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- First Name -->
            <div class="mt-4">
                <x-label for="first_name" :value="__('First Name')" />

                <x-input id="first_name" type="text" name="first_name" :value="old('first_name')" required autofocus />
            </div>

            <!-- Last Name -->
            <div class="mt-4">
                <x-label for="last_name" :value="__('Last Name')" />

                <x-input id="last_name" type="text" name="last_name" :value="old('last_name')" required autofocus />
            </div>
            <!-- Mobile -->
            <div class="mt-4">
                <x-label for="mobile" :value="__('Contact No')" />

                <x-input id="mobile" type="number" name="mobile" required />
            </div>
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" type="password" name="password_confirmation" required />
            </div>
          

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4 w-100">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('login') }}"><button class="bn632-hover bn19">Already registered?|Login </button></a>
            </div>

    </x-auth-card>
</x-auth-layout>








{{-- // Login Button
<div class="flex items-center justify-end mt-4">
<a href="{{ route('login') }}"><button class="bn632-hover bn19">Already registered?|Login </button></a>
</div> --}}
{{-- <x-slot name="extra">
    <span>
        {{ __('Already registered?') }} <a href=>Login</a>.
    </span>
</x-slot> --}}






