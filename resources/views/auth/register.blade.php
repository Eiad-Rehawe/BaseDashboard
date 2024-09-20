<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')"
        style="background: red;color:#fff;text-align:center" />
    <!-- Tabs navs -->

    <div class="triple-toggle-switch w-100">
        <input type="radio" id="state1" name="toggle" checked>
        <label for="state1" id="state1">{{ __('frontend.Register email') }}</label>
        <input type="radio" id="state2" name="toggle">
        <label for="state2" id="state2">{{ __('frontend.Register phone') }}</label>
        <input type="radio" id="state3" name="toggle">
        <label for="state3" id="state3">{{ __('frontend.Register both') }}</label>
        <div class="toggle-slider"></div>
      </div>
    <!-- Tabs navs -->

    <!-- Tabs content -->
    <div class="tab-content" id="ex1-content">
        <div class="tab-pane fade show active" id="state1" role="tabpanel" aria-labelledby="ex1-tab-1">
            <form method="POST" action="{{ route('register') }}"
            style="direction: {{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }};text-align:{{ app()->getLocale() == 'en' ? 'left':'right' }}">
            @csrf
    
            <!-- Name -->
            <div class="mt-4">
                <x-input-label for="first_name" :value="__('table.first_name')" />
                <x-text-input id="first_name" class="form-control block mt-1 w-full" type="text" name="first_name"
                    :value="old('first_name')" required autofocus autocomplete="first_name" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" style="color: red" />
            </div>
            <div class="mt-4">
                <x-input-label for="name" :value="__('table.last_name') " />
                <x-text-input id="last_name" class="form-control block mt-1 w-full" type="text" name="last_name"
                    :value="old('last_name')" required autofocus autocomplete="last_name" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" style="color: red" />
            </div>
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('frontend.Email')" />
                <x-text-input id="email" class="form-control block mt-1 w-full" type="email" name="email"
                    :value="old('email')" autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: red" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="Address" :value="__('frontend.Address')" />
                <x-text-input id="Address" class="form-control block mt-1 w-full" type="text" name="address"
                    :value="old('Address')" required autocomplete="Address" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" style="color: red" />
            </div>
    
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('frontend.password')" />
    
                <x-text-input id="password" class="form-control block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" style="color: red" />
            </div>
    
            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('frontend.Confirm Password')" />
    
                <x-text-input id="password_confirmation" class="form-control block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" style="color: red" />
            </div>
    
            <div class="mt-4">
                <x-input-label for="Gender" :value="__('frontend.gender')" />
    
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="0"
                        style="{{ app()->getLocale() =='ar' ? 'float:right;margin-left:20px' : 'float:left;margin-right:20px'}};border:1px solid #000">
                    <label class="form-check-label" for="gridRadios1">
                        {{ __('frontend.male') }}
                    </label>
    
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="1"
                        style="{{ app()->getLocale() =='ar' ? 'float:right;margin-left:20px' : 'float:left;margin-right:20px'}};border:1px solid #000">
                    <label class="form-check-label" for="gridRadios1">
                        {{ __('frontend.female') }}
                    </label>
                </div>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" style="color: red" />
    
    
            </div>
    
            <div class="row justify-content-center" style="margin-top:10px; ">
    
                <x-primary-button class="btn btn-primary w-70 py-8 mb-4 justify-content-center rounded-2"
                    style="background: #7fad39">
                    {{ __('frontend.Register') }}
                </x-primary-button>
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('frontend.Already registered?') }}
                </a>
    
    
            </div>
        </form>
        </div>
        <div class="tab-pane fade" id="state2" role="tabpanel" aria-labelledby="ex1-tab-2">
            <form method="POST" action="{{ route('register') }}"
            style="direction: {{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }};text-align:{{ app()->getLocale() == 'en' ? 'left':'right' }}">
            @csrf
    
            <!-- Name -->
            <div class="mt-4">
                <x-input-label for="first_name" :value="__('table.first_name')" />
                <x-text-input id="first_name" class="form-control block mt-1 w-full" type="text" name="first_name"
                    :value="old('first_name')" required autofocus autocomplete="first_name" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" style="color: red" />
            </div>
            <div class="mt-4">
                <x-input-label for="name" :value="__('table.last_name') " />
                <x-text-input id="last_name" class="form-control block mt-1 w-full" type="text" name="last_name"
                    :value="old('last_name')" required autofocus autocomplete="last_name" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" style="color: red" />
            </div>
            <!-- Email Address -->
            
            <div class="mt-4">
                <x-input-label for="Phone" :value="__('frontend.Phone')" />
                <input type="tel" id="Phone_1" class="form-control" name="phone" :value="old('phone')">
    
                {{--
                <x-text-input id="Phone" class="form-control block mt-1 w-full" type="phone" name="phone"
                    :value="old('Phone')" required autocomplete="phone" /> --}}
                <x-input-error :messages="$errors->get('phone')" class="mt-2" style="color: red" />
            </div>
            <div class="mt-4">
                <x-input-label for="Address" :value="__('frontend.Address')" />
                <x-text-input id="Address" class="form-control block mt-1 w-full" type="text" name="address"
                    :value="old('Address')" required autocomplete="Address" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" style="color: red" />
            </div>
    
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('frontend.password')" />
    
                <x-text-input id="password" class="form-control block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" style="color: red" />
            </div>
    
            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('frontend.Confirm Password')" />
    
                <x-text-input id="password_confirmation" class="form-control block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" style="color: red" />
            </div>
    
            <div class="mt-4">
                <x-input-label for="Gender" :value="__('frontend.gender')" />
    
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="0"
                        style="{{ app()->getLocale() =='ar' ? 'float:right;margin-left:20px' : 'float:left;margin-right:20px'}};border:1px solid #000">
                    <label class="form-check-label" for="gridRadios1">
                        {{ __('frontend.male') }}
                    </label>
    
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="1"
                        style="{{ app()->getLocale() =='ar' ? 'float:right;margin-left:20px' : 'float:left;margin-right:20px'}};border:1px solid #000">
                    <label class="form-check-label" for="gridRadios1">
                        {{ __('frontend.female') }}
                    </label>
                </div>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" style="color: red" />
    
    
            </div>
    
            <div class="row justify-content-center" style="margin-top:10px; ">
    
                <x-primary-button class="btn btn-primary w-70 py-8 mb-4 justify-content-center rounded-2"
                    style="background: #7fad39">
                    {{ __('frontend.Register') }}
                </x-primary-button>
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('frontend.Already registered?') }}
                </a>
    
    
            </div>
        </form>
        </div>
        <div class="tab-pane fade" id="state3" role="tabpanel" aria-labelledby="ex1-tab-3">
            <form method="POST" action="{{ route('register') }}"
            style="direction: {{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }};text-align:{{ app()->getLocale() == 'en' ? 'left':'right' }}">
            @csrf
    
            <!-- Name -->
            <div class="mt-4">
                <x-input-label for="first_name" :value="__('table.first_name')" />
                <x-text-input id="first_name" class="form-control block mt-1 w-full" type="text" name="first_name"
                    :value="old('first_name')" required autofocus autocomplete="first_name" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" style="color: red" />
            </div>
            <div class="mt-4">
                <x-input-label for="name" :value="__('table.last_name') " />
                <x-text-input id="last_name" class="form-control block mt-1 w-full" type="text" name="last_name"
                    :value="old('last_name')" required autofocus autocomplete="last_name" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" style="color: red" />
            </div>
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('frontend.Email')" />
                <x-text-input id="email" class="form-control block mt-1 w-full" type="email" name="email"
                    :value="old('email')" autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: red" />
            </div>
            <div class="mt-4">
                <x-input-label for="Phone" :value="__('frontend.Phone')" />
                <input type="tel" id="Phone" class="form-control" name="phone" :value="old('phone')">
    
                {{--
                <x-text-input id="Phone" class="form-control block mt-1 w-full" type="phone" name="phone"
                    :value="old('Phone')" required autocomplete="phone" /> --}}
                <x-input-error :messages="$errors->get('phone')" class="mt-2" style="color: red" />
            </div>
            <div class="mt-4">
                <x-input-label for="Address" :value="__('frontend.Address')" />
                <x-text-input id="Address" class="form-control block mt-1 w-full" type="text" name="address"
                    :value="old('Address')" required autocomplete="Address" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" style="color: red" />
            </div>
    
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('frontend.password')" />
    
                <x-text-input id="password" class="form-control block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" style="color: red" />
            </div>
    
            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('frontend.Confirm Password')" />
    
                <x-text-input id="password_confirmation" class="form-control block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" style="color: red" />
            </div>
    
            <div class="mt-4">
                <x-input-label for="Gender" :value="__('frontend.gender')" />
    
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="0"
                        style="{{ app()->getLocale() =='ar' ? 'float:right;margin-left:20px' : 'float:left;margin-right:20px'}};border:1px solid #000">
                    <label class="form-check-label" for="gridRadios1">
                        {{ __('frontend.male') }}
                    </label>
    
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="1"
                        style="{{ app()->getLocale() =='ar' ? 'float:right;margin-left:20px' : 'float:left;margin-right:20px'}};border:1px solid #000">
                    <label class="form-check-label" for="gridRadios1">
                        {{ __('frontend.female') }}
                    </label>
                </div>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" style="color: red" />
    
    
            </div>
    
            <div class="row justify-content-center" style="margin-top:10px; ">
    
                <x-primary-button class="btn btn-primary w-70 py-8 mb-4 justify-content-center rounded-2"
                    style="background: #7fad39">
                    {{ __('frontend.Register') }}
                </x-primary-button>
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('frontend.Already registered?') }}
                </a>
    
    
            </div>
        </form>
        </div>
    </div>
    <!-- Tabs content -->
    
</x-guest-layout>
<script>
    // script.js
var tabs = document.querySelectorAll('#ex1-content .tab-pane')
var lables = document.querySelectorAll('.triple-toggle-switch label')
document.querySelectorAll('.triple-toggle-switch input').forEach(input => {
  input.addEventListener('change', (event) => {
    let id = event.target.id
    lables.forEach(label=>{
        if(label.id == id){
            label.style.backgroundColor = '#4caf50';

        }else{
            label.style.backgroundColor = '';

        }
    })
    tabs.forEach(tab=>{
  if(tab.id == id){
    tab.classList.add('show');
    tab.classList.add('active');
    if (!input.hasAttribute('checked')) {
        input.setAttribute('checked', '');
        }
  }else{
    tab.classList.remove('show');
    tab.classList.remove('active');
    if (input.hasAttribute('checked')) {
        input.removeAttribute('checked');
        }
  }
    })
   
    console.log(`Selected: ${event.target.nextElementSibling.textContent}`);
  });
});

</script>