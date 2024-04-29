<x-layout>
    <div class="bg-gray-800 mb-10 card">
        <div class="flex flex-col items-center justify-center text-white px-5 md:px-20 py-5">
            <h1 class="text-5xl mb-5">Welcome to My <span class="text-orange-500">RSS</span> List</h1>
            <p class="text-xl text-center">
                Make sure you never miss a new article again. Log in or sign up to start making your custom RSS feed and keep your favorite publications all in one spot! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
            </p>
        </div>
    </div>
    <div class="flex flex-col md:flex-row bg-gray-800 p-5 card">
        <form method="POST" action="/login" class="grow w-1/2 px-8 pt-6 pb-8 mb-4">
            @csrf
            <h2 class="text-3xl text-white mb-3 font-bold">Login</h2>
            <div class="mb-4">
                <label class="block text-white text-sm font-bold mb-2" for="login_email">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="login_email" name="login_email" type="email" placeholder="example@email.com" required>
                @error('login_email')
                <p class="mt-3 text-red-500 italic"> {{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block text-white text-sm font-bold mb-2" for="login_password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="login_password" name="login_password" type="password" placeholder="******************" required>
                @error('login_password')
                <p class="mt-3 text-red-500 italic"> {{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Log In
                </button>
            </div>
        </form>

        <div class="flex items-center justify-center text-white text-2xl">
            OR
        </div>

        <form method="POST" action="/register" class="grow w-1/2 px-8 pt-6 pb-8 mb-4">
            @csrf
            <h2 class="text-3xl text-white mb-3 font-bold">Sign Up</h2>
            <div class="mb-4">
                <label class="block text-white text-sm font-bold mb-2" for="name">
                    Username
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="JoelBusch" required>
                @error('name')
                <p class="mt-3 text-red-500 italic"> {{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-white text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="example@email.com" required>
                @error('email')
                <p class="mt-3 text-red-500 italic"> {{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-white text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" type="password" placeholder="******************" required>
                @error('password')
                <p class="mt-3 text-red-500 italic"> {{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block text-white text-sm font-bold mb-2" for="password_confirmation">
                    Confirm Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password_confirmation" name="password_confirmation" type="password" placeholder="******************" required>
                @error('password_confirmation')
                <p class="mt-3 text-red-500 italic"> {{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Sign Up
                </button>
            </div>
        </form>
    </div>
</x-layout>