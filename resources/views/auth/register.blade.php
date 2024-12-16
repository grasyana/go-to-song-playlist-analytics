<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Register</title>
</head>
<body>
<section class="relative bg-cover bg-center" style="background-image: url('images/bg.jpg');">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <!-- Adjust the width by changing w-full sm:w-96 to your desired width (for example, w-full sm:w-80) -->
      <div class="bg-white bg-opacity-50 p-6 rounded-lg shadow-lg w-full sm:w-80 md:w-96">
          <div class="space-y-6 md:space-y-8 sm:p-8">
              <h1 class="text-2xl font-bold leading-tight tracking-tight text-black md:text-2xl dark:text-white">
                  Register a new account!
              </h1>
              <form method="POST" action="{{ route('register') }}">
              @csrf

                <!-- Name Input Field -->
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-black dark:text-white">Full Name</label>
                    <input type="text" name="name" id="name" class="bg-gray-50 border border-green-300 text-black rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-3" placeholder="Enter your fullname" required="" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Input Field -->
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-black dark:text-white">Email Address</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-green-300 text-black rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-3" placeholder="Enter your email" required="" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input Field -->
                <div class="relative mt-4">
                    <label for="password" class="block mb-2 text-sm font-medium text-black dark:text-white">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-green-300 text-black rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-3" required="">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password Input Field -->
                <div class="mt-4">
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-black dark:text-white">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-gray-50 border border-green-300 text-black rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-3" required="">
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="mt-4 w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-3 text-center">
                    Register
                </button>

                <!-- Sign In Link -->
                <p class="mt-4 text-sm font-light text-black dark:text-gray-400 text-left">
                    Already have an account? <a href="{{ route('login') }}" class="font-medium text-black hover:underline">Sign in</a>
                </p>
              </form>
          </div>
      </div>
  </div>
</section>

</body>
</html>
