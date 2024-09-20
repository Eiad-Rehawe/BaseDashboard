<x-guest-layout>
  
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST"  action="{{ route('login.admin') }}" style="direction: {{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }};text-align: {{ app()->getLocale() == 'ar' ? 'right':'left' }}">

        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('frontend.Email')" />
            <x-text-input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('frontend.password')" />

            <x-text-input id="password" class="form-control block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center" style="display: flex">
                <input id="remember_me" type="checkbox" class="form-check-input primary rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 form-control" name="remember">
                <span class="ml-2 text-sm text-gray-600" >{{ __('frontend.Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
           

            <x-primary-button class="btn btn-primary w-100 py-8 mb-4 rounded-2">
                {{ __('frontend.Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
