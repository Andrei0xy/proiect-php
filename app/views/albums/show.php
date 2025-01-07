<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Album profile</title>
</head>
<body>
    <h1>Album description</h1>
    <p>Name: <?= $album["name"] ?></p>
    <p>Release date: <?= $album["release_date"] ?></p>
    <p>Genre: <?= $album["genre"] ?></p>
    <p>Price: <?= $album["price"] ?></p>
    <p>Stoc: <?= $album["stoc"] ?></p>
    <a href="edit?id=<?= $album["id"] ?>">Edit</a>
    <a href="index">Back</a>
</body>
</html>