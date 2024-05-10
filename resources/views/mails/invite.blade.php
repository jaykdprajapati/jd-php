<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        Dear {{$mailMessage['name'] }} !
        <p>Wecome! Please find your link here to get started with your todo.{{$mailMessage['reset_link']}}</p>
        Thank You
    </body>
</html>