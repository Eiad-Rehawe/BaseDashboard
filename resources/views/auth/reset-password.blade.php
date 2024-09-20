<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}" style="direction: {{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }};text-align: {{ app()->getLocale() == 'ar' ? 'right':'left' }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('frontend.Email')" />
            <x-text-input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('frontend.password')" />
            <x-text-input id="password" class="form-control block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('frontend.Confirm Password')" />

            <x-text-input id="password_confirmation" class="form-control block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>


       

        <x-primary-button class="btn btn-primary w-100 py-8 mb-4 rounded-2" style="background: #7fad39;margin-top:10px">
            {{ __('frontend.Reset Password') }}
        </x-primary-button>
    </form>
</x-guest-layout>
