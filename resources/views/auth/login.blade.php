<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - X Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-[#05060F] min-h-screen flex items-center justify-center">
    <div class="bg-[#12131A] p-8 rounded-2xl shadow-lg w-full max-w-md">
        <!-- Logo/Title -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-[#EBEBEB]" style="font-family: 'Patua One', cursive;">X Academy</h1>
            <p class="text-gray-400 mt-2">Teacher Portal</p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="bi bi-envelope text-gray-400"></i>
                    </div>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" 
                           class="bg-[#1E1F25] border border-[#2B2C32] text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" 
                           placeholder="Enter your email" required>
                </div>
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="bi bi-lock text-gray-400"></i>
                    </div>
                    <input type="password" id="password" name="password" 
                           class="bg-[#1E1F25] border border-[#2B2C32] text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-10 p-2.5" 
                           placeholder="Enter your password" required>
                    <button type="button" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-300 focus:outline-none"
                            onclick="togglePassword()">
                        <i class="bi bi-eye" id="togglePassword"></i>
                    </button>
                </div>
                @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" 
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-300">
                        Remember me
                    </label>
                </div>
                <a href="#" class="text-sm text-blue-500 hover:text-blue-400">
                    Forgot password?
                </a>
            </div>

            <!-- Login Button -->
            <button type="submit" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#5EBAB4] hover:bg-[#4CA8A2] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5EBAB4] transition duration-150 ease-in-out">
                Sign in
            </button>
        </form>
    </div>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }
    </script>
</body>
</html> 