<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('frontend.Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" style="background: red;color:#fff;text-align:center"/>

    <form method="POST" action="{{ route('password.email') }}" style="direction: {{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }};text-align: {{ app()->getLocale() == 'ar' ? 'right':'left' }}">
        @csrf

        <!-- Email Address -->
      <div class="mt-4">
            <x-input-label for="email" :value="__('frontend.Email')" />
            <x-text-input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: red"/>
        </div>

        <x-primary-button class="btn btn-primary w-100 py-8 mb-4 rounded-2" style="background: #7fad39;margin-top:10px">
            {{ __('frontend.Email Password Reset Link') }}
        </x-primary-button>
    </form>
</x-guest-layout>
