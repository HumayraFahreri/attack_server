<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-[#BF5A4B] px-4">
        <div class="w-full sm:max-w-md bg-white p-6 rounded-lg shadow-md">
            <!-- Teks Penjelasan -->
            <div class="mb-4 text-sm text-gray-600">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block font-medium text-sm text-gray-700">
                        {{ __('Email') }}
                    </label>
                    <input id="email" name="email" type="email" required autofocus
                        class="border-gray-300 focus:border-[#BF5A4B] focus:ring-[#BF5A4B] rounded-md shadow-sm block mt-1 w-full"
                        value="{{ old('email') }}">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Tombol -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-[#BF5A4B] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#a84c3f] focus:bg-[#a84c3f] active:bg-[#923f35] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#BF5A4B] transition ease-in-out duration-150">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
