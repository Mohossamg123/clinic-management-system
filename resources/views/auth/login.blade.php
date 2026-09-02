<x-guest-layout>
    <!-- استدعاء الخط والأيقونات -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Cairo', sans-serif !important;
            background-color: #f8f9fa !important;
        }

        .login-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(108, 92, 231, 0.08);
            border: 1px solid rgba(108, 92, 231, 0.1);
            padding: 2.5rem;
            max-width: 440px;
            width: 100%;
            margin: auto;
        }

        .login-icon-box {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, rgba(108, 92, 231, 0.1) 0%, rgba(9, 132, 227, 0.1) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem auto;
            color: #6c5ce7;
            font-size: 1.8rem;
        }

        .login-header h2 {
            font-weight: 700;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 0.25rem;
        }

        .login-header p {
            color: #6c757d;
            text-align: center;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .form-control-custom {
            width: 100%;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1.5px solid #e9ecef;
            background-color: #fdfdfd;
            transition: all 0.3s ease;
            color: #495057;
            margin-top: 0.25rem;
        }

        .form-control-custom:focus {
            border-color: #6c5ce7;
            box-shadow: 0 0 0 0.25rem rgba(108, 92, 231, 0.15);
            outline: none;
            background-color: #fff;
        }

        .btn-login {
            background: linear-gradient(135deg, #6c5ce7 0%, #0984e3 100%);
            border: none;
            border-radius: 12px;
            padding: 0.8rem;
            font-weight: 700;
            color: #ffffff;
            width: 100%;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(108, 92, 231, 0.3);
            color: #ffffff;
        }

        .link-forgot {
            color: #6c5ce7;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: color 0.2s;
        }

        .link-forgot:hover {
            color: #0984e3;
        }
    </style>

    <div class="login-card">
        <div class="login-header">
            <div class="login-icon-box">
                <i class="fa-solid fa-hospital-user"></i>
            </div>
            <h2>Welcome Back</h2>
            <p>Sign in to access your dashboard</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold text-secondary" style="font-size: 0.9rem;">Email Address</label>
                <input id="email" class="form-control-custom" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold text-secondary" style="font-size: 0.9rem;">Password</label>
                <input id="password" class="form-control-custom" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="link-forgot" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <button type="submit" class="btn-login">
                <i class="fa-solid fa-right-to-bracket me-1"></i> Log In
            </button>
        </form>
    </div>
</x-guest-layout>
