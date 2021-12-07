<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="StyleSheet" href="css/login_styles.css">
</head>

<body>
    <div>
        <form method="POST" class="form-login" action="login">
            @csrf
            <div class="login-container">
                <h1 class="title">Log in</h1>
                <input type="text" name="username" id = "username" class="input-row input-text" placeholder="Username">
                <input type="password" name="password" id = "password" class="input-row input-text" placeholder="Password">
                <span class="display-error">
                @if(isset($err))
                    {{$err}}
                @endif
                </span>
                <button type="submit" class="input-row login-button">Log in</button>
            </div>
        </form>
    </div>
</body>

</html>