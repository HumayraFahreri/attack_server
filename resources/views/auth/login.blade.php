<x-guest-layout>
   <div class="min-h-screen flex items-center justify-center bg-gray-400/30 pt-12">
        <!-- Kanan: Form login -->
        <div class="w-full max-w-2xl">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden md:flex h-[500px]">
                    <!-- Left side - grey with logo/text -->
                    <div class="hidden md:flex md:w-1/2 bg-[#C9C9C9]/20">
                        <div class="flex flex-col items-center justify-center text-center w-full h-full p-10">
                            <!-- Ikon Shield -->
                            <div class="flex items-center justify-center w-24 h-24">
                                <img src="{{ asset('image/ABH_LOGO.png') }}" class="mx-auto" alt="Logo" />
                            </div>
                            
                            <!-- Judul dan Subjudul -->
                            <h2 class="text-2xl font-bold text-[#343333] mb-3 mt-3">Server Attack</h2>
                            <p class="text-[#8D8D8D] mb-5 landing-none">Authorized Personnel Only</p>
                        </div>
                    </div>


                    <!-- Right side - Login form -->
                    <div class="w-full md:w-1/2 p-8 sm:p-10">
                        <div class="text-center mb-8">
                            <h1 class="text-2xl font-bold text-gray-800">Masuk ke Akun</h1>
                        </div>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}" class="space-y-5" >
                            @csrf

                            <!-- Email Address -->
                            <div>
                                <x-input-label for="email" :value="__('Alamat Email')" class="text-gray-300 font-medium"  />
                                <x-text-input id="email" class="block mt-2 w-full border-[#BF5A4B] focus:border-[#BF5A4B] focus:ring-[#BF5A4B] rounded-lg " 
                                            type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div>
                                <x-input-label for="password" :value="__('Kata Sandi')" class="text-gray-300 font-medium" />
                                <x-text-input id="password" class="block mt-2 w-full border-[#BF5A4B] focus:border-[#BF5A4B] focus:ring-[#BF5A4B] rounded-lg" 
                                            type="password" name="password" required autocomplete="current-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between">
                                <label for="remember_me" class="flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-[#8D8D8D] text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                                    <span class="ml-2 text-sm text-gray-600">Ingat Saya</span>
                                </label>

                                @if (Route::has('password.request'))
                                    <a class="text-sm text-blue-600 hover:text-blue-800 hover:underline" href="{{ route('password.request') }}">
                                        Lupa Kata Sandi?
                                    </a>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-2">
                                <button class="w-full flex items-center justify-center py-2 px-4 rounded-lg text-white bg-[#4F46E5] hover:bg-[#3b35a9] transition-colors">
                                    <span class="font-medium">LOG IN</span>
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout> 