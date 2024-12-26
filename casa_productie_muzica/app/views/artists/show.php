<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Artist profile</title>
</head>
<body>
    <h1>Artist profile</h1>
    <p>Name: <?= $artist["name"] ?></p>
    <p>Join date: <?= $artist["join_date"] ?></p>
    <p>Origin: <?= $artist["origin"] ?></p>
    <p>Description: <?= $artist["description"] ?></p>
    <a href="edit?id=<?= $artist["id"] ?>">Edit</a>
    <a href="index">Back</a>
</body>
</html>