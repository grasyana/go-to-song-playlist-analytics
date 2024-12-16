<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Login</title>
    <script>
      function togglePassword() {
        var passwordField = document.getElementById("password");
        var eyeIcon = document.getElementById("eye-icon");
        if (passwordField.type === "password") {
          passwordField.type = "text"; // Show password
          eyeIcon.src = "images/eye-open.svg"; // Change eye icon to open
        } else {
          passwordField.type = "password"; // Hide password
          eyeIcon.src = "images/eye-closed.svg"; // Change eye icon to closed
        }
      }
    </script>
</head>
<body>
<section class="relative bg-cover bg-center" style="background-image: url('images/bg.jpg');">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <div class="bg-white bg-opacity-50 p-6 rounded-lg shadow-lg w-full sm:w-96">
          <div class="space-y-6 md:space-y-8 sm:p-8">
              <h1 class="text-2xl font-bold leading-tight tracking-tight text-black md:text-2xl dark:text-white">
                  Sign in to your account!
              </h1>
              <form method="POST" action="{{ route('login') }}">
              @csrf     

                <!-- Email Input Field -->
                <div class="mt-4">
                    <label for="email" class="block mb-2 text-sm font-medium text-black">Email</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-green-300 text-black rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-3" placeholder="Enter your email" required="">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input Field -->
                <div class="mt-4 relative">
                    <label for="password" class="block mb-2 text-sm font-medium text-black">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-green-300 text-black rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-3" required="">
                    <button type="button" onclick="togglePassword()" class="absolute right-3 top-10">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                    </button>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember me & Forgot password links -->
                <div class="flex items-center justify-between mt-4">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="remember_me" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-green-300 rounded bg-gray-50 focus:ring-3 focus:ring-green-400" />
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="remember" class="text-black">Remember me</label>
                        </div>
                    </div>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-black hover:underline">
                        Forgot Password?
                    </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="mt-4 w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-3 text-center">
                    Sign in
                </button>

                <!-- Sign Up Link -->
                <p class="mt-4 text-sm font-light text-black text-left">
                    Don’t have an account yet? <a href="{{route('register')}}" class="font-medium text-black hover:underline">Sign up</a>
                </p>
              </form>
          </div>
      </div>
  </div>
</section>
</body>
</html>
