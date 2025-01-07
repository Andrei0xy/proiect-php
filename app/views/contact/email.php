<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send email</title>
    <style>
        body{
            background-color: darkgoldenrod;
        }
        h2{
            margin-top: 50px;
            justify-self: center;
        }
        .email_container{
            display: grid;
            justify-content: center;
            margin-top: 200px;
        }
    </style>
</head>
<body>
    <div class="email_container">
        <h2>SEND EMAIL</h2>
        <form action="" method="post">
            <p><input type="text" name="name" id="name" placeholder="Full name"></p>
            <p><input type="text" name="email" id="email" placeholder="Your e-mail"></p>
            <p><input type="text" name="subject" id="subject" placeholder="Subject"></p>
            <p><textarea name="message" placeholder="Enter your message"></textarea></p>
            <button type="submit" name="submit">Send mail</button>
        </form>
    </div>
</body>
</html>