<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        .login-container {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .login-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 28px;
            font-weight: 600;
        }

        .session-status {
            margin-bottom: 16px;
            padding: 12px;
            border-radius: 8px;
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            display: none;
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

        .input-error {
            margin-top: 8px;
            color: #dc2626;
            font-size: 14px;
            display: none;
        }

        .checkbox-container {
            display: block;
            margin-top: 16px;
        }

        .checkbox-wrapper {
            display: inline-flex;
            align-items: center;
            cursor: pointer;
        }

        .checkbox {
            margin-right: 8px;
            width: 16px;
            height: 16px;
            border-radius: 4px;
            border: 2px solid #d1d5db;
            accent-color: #6366f1;
            cursor: pointer;
        }

        .checkbox-label {
            font-size: 14px;
            color: #6b7280;
            cursor: pointer;
        }

        .form-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .forgot-password {
            color: #6b7280;
            text-decoration: underline;
            font-size: 14px;
            transition: color 0.3s ease;
            border-radius: 6px;
            padding: 4px 8px;
        }

        .forgot-password:hover {
            color: #111827;
        }

        .forgot-password:focus {
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
        }

        .primary-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
        }

        .primary-button:active {
            transform: translateY(0);
        }

        @media (max-width: 640px) {
            .login-container {
                padding: 30px 20px;
            }
            
            .form-footer {
                flex-direction: column;
                align-items: stretch;
            }
            
            .primary-button {
                width: 100%;
                margin-top: 12px;
            }
        }

        /* Animation for form elements */
        .form-group {
            opacity: 0;
            transform: translateY(20px);
            animation: slideUp 0.6s ease forwards;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .checkbox-container { animation-delay: 0.4s; }
        .form-footer { animation-delay: 0.5s; }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container {
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
    </style>
</head>
<body>
    <div class="login-container">
        <h1 class="login-title">Connete-toi</h1>
        
        <!-- Session Status -->
        <div class="session-status" id="sessionStatus">
            <!-- Status message will appear here -->
        </div>

        <form method="POST" action="/login">
            <!-- CSRF Token (if needed) -->
            <input type="hidden" name="_token" value="">

            <!-- Email Address -->
            <div class="form-group">
                <label class="input-label" for="text">Matricule</label>
                <input id="text" 
                       class="text-input" 
                       type="text" 
                       name="text" 
                       value="" 
                       required 
                       autofocus 
                       autocomplete="username" 
                       placeholder="Enter votre matricule">
                <div class="input-error" id="matriculeError">
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
                       autocomplete="current-password"
                       placeholder="Enter your password">
                <div class="input-error" id="passwordError">
                    <!-- Error message will appear here -->
                </div>
            </div>

            <!-- Remember Me -->
            <div class="checkbox-container">
                <label for="remember_me" class="checkbox-wrapper">
                    <input id="remember_me" 
                           type="checkbox" 
                           class="checkbox" 
                           name="remember">
                    <span class="checkbox-label">enregistrer</span>
                </label>
            </div>

            <div class="form-footer">
        

                <button type="submit" class="primary-button">
                    se connecter
                </button>
            </div>
        </form>
    </div>

    <script>
        // Form validation and interaction
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const matriculeInput = document.getElementById('text');
            const passwordInput = document.getElementById('password');
            const matriculeError = document.getElementById('matriculeError');
            const passwordError = document.getElementById('passwordError');

            // Real-time validation
            matriculeInput.addEventListener('blur', function() {
                if (!this.value) {
                    showError(matriculeError, 'Matricule is required');
                } else {
                    hideError(matriculeError);
                }
            });
                } else {
                    hideError(matriculeError);
                }
            });

            passwordInput.addEventListener('blur', function() {
                if (!this.value) {
                    showError(passwordError, 'Password is required');
                } else {
                    hideError(passwordError);
                }
            });

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                let isValid = true;

                // Validate email
                if (!emailInput.value) {
                    showError(emailError, 'Email is required');
                    isValid = false;
                } else if (!isValidEmail(emailInput.value)) {
                    showError(emailError, 'Please enter a valid email address');
                    isValid = false;
                } else {
                    hideError(emailError);
                }

                // Validate password
                if (!passwordInput.value) {
                    showError(passwordError, 'Password is required');
                    isValid = false;
                } else {
                    hideError(passwordError);
                }

                if (isValid) {
                    // Here you would normally submit the form
                    // For demo purposes, we'll just show a success message
                    const sessionStatus = document.getElementById('sessionStatus');
                    sessionStatus.textContent = 'Login form submitted successfully!';
                    sessionStatus.style.display = 'block';
                    
                    // In a real application, you would submit to your server
                    // form.submit();
                }
            });

            function showError(element, message) {
                element.textContent = message;
                element.style.display = 'block';
                element.parentElement.querySelector('.text-input').style.borderColor = '#dc2626';
            }

            function hideError(element) {
                element.style.display = 'none';
                element.parentElement.querySelector('.text-input').style.borderColor = '#e5e7eb';
            }

            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
        });
    </script>
</body>
</html>
