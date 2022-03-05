<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <div id="frm">
        <form action="login.php" method="POST">
            <p>
                <label>Email:</label>
                <input type="text" id="email" name="email"/>
            </p>
            <p>
                <label>Palavra-Passe:</label>
                <input type="password" id="pass" name="pass"/>
            </p>
            <p>
                <input type="submit" id="btn" value="Login"/>
            </p>
        </form>
        <div>Erro, tente novamente.</div>
    </div>
</body>
</html>
