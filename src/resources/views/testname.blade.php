<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="my-10">
        <form action="/testname" method="post">
            @csrf
            <input type="text" name="name" id="">
            <input type="submit" value="送信">
        </form>
    </div>
</body>
</html>