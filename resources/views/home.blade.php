<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div style="border: 3px solid black; padding: 20px; margin: 20px; display: flex; flex-direction: column; align-items: center;">
        <h2>Register</h2>
        <form action="/register" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Name">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>