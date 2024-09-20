<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('frontend.This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('frontend.password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="form-control current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="btn btn-primary w-100 py-8 mb-4 rounded-2" style="background: #7fad39;margin-top:10px">
            <x-primary-button>
                {{ __('frontend.Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
