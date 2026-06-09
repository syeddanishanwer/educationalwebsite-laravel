<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1e1e2f 0%, #111119 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #ffffff;
        }

        /* Login Card Container */
        .login-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 16px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            font-size: 28px;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 8px;
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .login-header p {
            color: #aaa;
            font-size: 14px;
        }

        /* Alert Box for Authentication Errors */
        .error-alert {
            background: rgba(255, 75, 43, 0.1);
            border: 1px solid rgba(255, 75, 43, 0.3);
            color: #ff4b2b;
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Input Fields */
        .input-group {
            position: relative;
            margin-bottom: 22px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            outline: none;
            color: #fff;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            border-color: #ff4b2b;
            background: rgba(255, 255, 255, 0.12);
            box-shadow: 0 0 10px rgba(255, 75, 43, 0.2);
        }

        .input-group label {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
            font-size: 15px;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        /* Label Animation on Focus/Input */
        .input-group input:focus ~ label,
        .input-group input:valid ~ label {
            top: -12px;
            left: 10px;
            font-size: 12px;
            color: #ff4b2b;
            background: #1a1a26;
            padding: 0 5px;
            border-radius: 4px;
        }

        /* Submit Button */
        .login-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .login-btn:hover {
            box-shadow: 0 5px 15px rgba(255, 75, 43, 0.4);
        }

        .login-btn:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-header">
            <h2>Welcome Back</h2>
            <p>Please login to your account</p>
        </div>

        @if ($errors->has('login_error'))
            <div class="error-alert">
                {{ $errors->first('login_error') }}
            </div>
        @endif

        <form action="{{ route('login.match') }}" method="POST">
            @csrf
            
            <div class="input-group">
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="off">
                <label>Email Address</label>
            </div>

            <div class="input-group">
                <input type="password" name="password" id="password" required>
                <label>Password</label>
            </div>

            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>

</body>
</html>