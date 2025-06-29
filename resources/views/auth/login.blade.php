<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />



    <!-- الشعار -->
    <div class="flex justify-center mb-4">
        <img src="{{ asset('storage/images/slachTech.png') }}" alt="شعار slash Tech" style="max-width: 150px;">
    </div>


    <!-- العنوان -->
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            مرحباً بك في صفحة تسجيل الدخول إلى لوحة التحكم <span class="text-blue-600">Slash </span>Tech
        </h2>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-right w-full" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-right w-full" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Forgot Password + Remember -->
        <div class="mt-4 flex justify-between items-center">
            <label class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <x-primary-button class="w-full justify-center">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
