<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
           @csrf
<div class="mb-4">
<label for="email" class="block text-gray-700">Email</label>
<input type="email" id="email" name="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
</div>
<div class="mb-4">
<label for="password" class="block text-gray-700">Password</label>
<input type="password" id="password" name="password" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
</div>
<div class="flex items-center justify-between">
<button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bindigog--600">Login</button>
<a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:text-indigo-700">Forgot your password?</a>
</div>
</form>
    </x-auth-card>
</x-guest-layout>
