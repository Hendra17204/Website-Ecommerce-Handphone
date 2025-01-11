<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

        * {
            box-sizing: border-box;
        }

        body {
            background: #f4f4f4;
            /* Light gray background */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
        }

        .container {
            display: flex;
            width: 80%;
            max-width: 800px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .login-section {
            background-color: #fff;
            padding: 80px 40px;
            border-radius: 8px 0 0 8px;
            flex: 1;
        }

        .signup-section {
            background-color: #5cb85c;
            /* Green background */
            color: white;
            padding: 80px 40px;
            border-radius: 0 8px 8px 0;
            text-align: center;
            align-content: center;
            flex: 1;
        }

        h1 {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        h2 {
            text-align: center;
        }

        p {
            font-size: 14px;
            font-weight: 300;
            /* Lighter font weight */
            line-height: 1.6;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
            color: #555;
            /* Slightly darker gray */
        }

        span {
            font-size: 12px;
        }

        a {
            color: #333;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
            display: block;
            /* Make it a block element for better spacing */
            text-align: center;
        }

        button {
            border-radius: 20px;
            border: 1px solid #5cb85c;
            background-color: #5cb85c;
            color: #FFFFFF;
            font-size: 14px;
            /* Slightly larger font size */
            font-weight: bold;
            padding: 12px 50px;
            /* Increased padding */
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
            cursor: pointer;
            /* Add cursor style */
            margin-bottom: 15px;
            /* Add margin for better spacing */
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
            color: #4CAF50;
            /* Green text color */
        }

        .login-section form {
            text-align: center;
            /* Centers the button horizontally */
        }

        .signup-section h1,
        p {
            color: white;
        }

        .signup-section button {
            border: 1px solid white;

        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: calc(100% - 24px);
            padding: 12px;
            margin-bottom: 15px;
            background-color: #ececec;
            border: none;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .error-message {
            font-size: 14px;
            color: red;
            margin-bottom: 10px;
        }

        /* ... rest of your CSS ... */
    </style>
</head>

<body>
    <div class="container">
        <div class="signup-section">
            <h1>Welcome Back</h1>
            <p>To keep connected with us please login with your personal info</p>
            <a href="{{ route('login') }}"><button type="button">LOG IN</button></a>
        </div>
        <div class="login-section">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h1>Create Account</h1>
                <input type="text" placeholder="Name" name="name" required />
                <input type="email" placeholder="Email" name="email" required />

                <input type="password" placeholder="Password" name="password" required />
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror

                <input type="password" placeholder="Confirm Password" name="password_confirmation" required />
                @error('password_confirmation')
                    <div class="error">{{ $message }}</div>
                @enderror
                <button type="submit">Sign Up</button>
            </form>
        </div>
</body>

</html>
