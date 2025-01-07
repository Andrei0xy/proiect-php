<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Artist profile</title>
    <style>
        body{
            font-size: 100%;
            background-color: cadetblue;
        }
        .show{
            display: grid;
            grid-template-columns: 50% 50%;
            align-items: center;
            padding: 2px 20px 20px 20px;
            column-gap: 2vw;
            font-size: 1.1em;
            font-weight: 500;
        }
        .show h1{
            grid-column: span 2;
            border: 0.9rem inset brown;
            padding: 10px;
        }
        .show .picture{
            grid-column: span 1;
            width: 40vw;
            height: 40vw;
        }
        .show .right{
            grid-column: span 1;
        }
    </style>
</head>
<body>
    <div class="show">
    <h1>Artist profile</h1>
    <div class="picture">
        <img src=<?= $artist["image"] ?> alt="imagine eminem">
    </div>
    <div class="right">
    <p>Name: <?= $artist["name"] ?></p>
    <p>Join date: <?= $artist["join_date"] ?></p>
    <p>Origin: <?= $artist["origin"] ?></p>
    <p>Description: <?= $artist["description"] ?></p>
    <a href="edit?id=<?= $artist["id"] ?>">Edit</a>
    <a href="index">Back</a>
    </div>
    </div>
</body>
</html>