<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .register-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 28px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.mt-4 {
            margin-top: 16px;
        }

        .input-label {
            display: block;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .text-input {
            display: block;
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .text-input:focus {
            outline: none;
            border-color: #6366f1;
            background: white;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            transform: translateY(-1px);
        }

        .text-input.error {
            border-color: #dc2626;
            background: #fef2f2;
        }

        .input-error {
            margin-top: 8px;
            color: #dc2626;
            font-size: 14px;
            display: none;
        }

        .form-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .login-link {
            color: #6b7280;
            text-decoration: underline;
            font-size: 14px;
            transition: color 0.3s ease;
            border-radius: 6px;
            padding: 4px 8px;
        }

        .login-link:hover {
            color: #111827;
        }

        .login-link:focus {
            outline: none;
            box-shadow: 0 0 0 2px #6366f1;
        }

        .primary-button {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            margin-left: 16px;
        }

        .primary-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
        }

        .primary-button:active {
            transform: translateY(0);
        }

        .primary-button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .password-strength {
            margin-top: 8px;
            font-size: 12px;
        }

        .strength-indicator {
            width: 100%;
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            margin-top: 4px;
            overflow: hidden;
        }

        .strength-bar {
            height: 100%;
            transition: all 0.3s ease;
            width: 0%;
        }

        .strength-weak { background: #dc2626; width: 25%; }
        .strength-medium { background: #f59e0b; width: 50%; }
        .strength-good { background: #10b981; width: 75%; }
        .strength-strong { background: #059669; width: 100%; }

        @media (max-width: 640px) {
            .register-container {
                padding: 30px 20px;
            }
            
            .form-footer {
                flex-direction: column;
                align-items: stretch;
            }
            
            .primary-button {
                width: 100%;
                margin-left: 0;
                margin-top: 12px;
            }
        }

        
        .form-group {
            opacity: 0;
            transform: translateY(20px);
            animation: slideUp 0.6s ease forwards;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-footer { animation-delay: 0.5s; }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-container {
            opacity: 0;
            transform: scale(0.95);
            animation: fadeInScale 0.8s ease forwards;
        }

        @keyframes fadeInScale {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .success-message {
            background: #d1fae5;
            color: #065f46;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #a7f3d0;
            display: none;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1 class="register-title">Create Account</h1>
        
        <div class="success-message" id="successMessage">
            <!-- Success message will appear here -->
        </div>

        <form method="POST" action="{{ route('register') }}">
              @csrf

            <!-- Name -->
            <div class="form-group">
                <label class="input-label" for="name">Name</label>
                <input id="name" 
                       class="text-input" 
                       type="text" 
                       name="name" 
                       value="" 
                       required 
                       autofocus 
                       autocomplete="name" 
                       placeholder="Enter your full name">
                <div class="input-error" id="nameError">
                    <!-- Error message will appear here -->
                </div>
            </div>

            <!-- Email Address -->
            <div class="form-group mt-4">
                <label class="input-label" for="email">Email</label>
                <input id="email" 
                       class="text-input" 
                       type="email" 
                       name="email" 
                       value="" 
                       required 
                       autocomplete="username" 
                       placeholder="Enter your email address">
                <div class="input-error" id="emailError">
                    <!-- Error message will appear here -->
                </div>
            </div>

            <!-- Password -->
            <div class="form-group mt-4">
                <label class="input-label" for="password">Password</label>
                <input id="password" 
                       class="text-input"
                       type="password"
                       name="password"
                       required 
                       autocomplete="new-password"
                       :value="__('Password')"
                       placeholder="Create a strong password">
                <div class="password-strength" id="passwordStrength">
                    <div class="strength-indicator">
                        <div class="strength-bar" id="strengthBar"></div>
                    </div>
                    <div class="strength-text" id="strengthText"></div>
                </div>
                <div class="input-error" id="passwordError">
                    <!-- Error message will appear here -->
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="form-group mt-4">
                <label class="input-label" for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" 
                       class="text-input"
                       type="password"
                       name="password_confirmation" 
                       required 
                       autocomplete="new-password"
                       placeholder="Confirm your password">
                <div class="input-error" id="passwordConfirmationError">
                    <!-- Error message will appear here -->
                </div>
            </div>

            <div class="form-footer">
                <a class="login-link" href="/login">
                    Already registered?
                </a>

                <button type="submit" class="primary-button">
                    Register
                </button>
            </div>
        </form>
    </div>


  
</body>
</html>
