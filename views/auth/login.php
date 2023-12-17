<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            height: 93vh;
        }

        form label {
            display: block;
        }

        form input {
            margin-bottom: 1rem;
            display: block;
        }

        .info {
            background-color: blue;
            color: white;
            border-radius: 5px;
            padding: 2px 4px 2px 4px;
        }

        .error {
            background-color: red;
            color: white;
            border-radius: 5px;
            padding: 2px 4px 2px 4px;
        }

        .flex {
            display: flex;
        }

        .justify-content-center {
            justify-content: center;
        }

        .align-items-center {
            align-items: center;
        }

        .flex-column {
            flex-direction: column;
        }
    </style>
</head>

<body class="flex justify-content-center align-items-center">

    <form action="/login" method="post" class="flex justify-content-center align-items-center flex-column">
        <?php foreach ($session->get_flash() as $key => $val) { ?>
            <?php if ($key == 'error') { ?>
                <div class="error"><?= $val ?></div>
            <?php } else if ($key == 'info') { ?>
                <div class="info"><?= $val ?></div>
            <?php } ?>
        <?php } ?>
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="">
            <label for="password">Password</label>
            <input type="password" name="password" id="">
            <button type="submit">Login</button>
        </div>
    </form>

</body>

</html>