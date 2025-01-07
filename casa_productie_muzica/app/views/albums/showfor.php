<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/picnic">
    <title>Albums</title>
    <style>
        body{
            font-size: 100%;
            background-color: cadetblue;
        }
        .container{
            display: grid;
            grid-template-columns: 50% 50%;
            align-items: center;
            padding: 2px 20px 20px 20px;
            row-gap: 3vw;
            column-gap: 2vw;
            font-size: 1.1em;
            font-weight: 500;
        }
        .container a{
            color: navy;
        }
        .container .title{
            grid-column: span 2;
            margin-bottom: 1.1em;
            
        }
        .title h1{
            border: 0.9rem inset brown;
            padding: 10px;
        }
        .container .left{
            grid-column: span 1;
        }
        .container .right{
            grid-column: span 1;
        }
        .left img{
            width: 35vw;
            height: 35vw;
            margin-left: 0;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="title">
        <h1>All Albums</h1>
        <a href="create" role="button">New album</a>
    </div>
    <?php foreach ($albums as $album) : ?>
        <div class="left">
            <img src=<?= $album["image"] ?> alt="album image" loading="lazy">
        </div>
        <div class="right">
            <p>Name: <a href="/casa_productie_muzica/songs/index?id=<?= $album["id"]?>"><?= $album["name"] ?></a></p>
            <p>Release date: <?= $album["release_date"] ?></p>
            <p>Genre: <?= $album["genre"] ?></p>
            <p>Price: <?= $album["price"] ?></p>
            <p>Stoc: <?= $album["stoc"] ?></p>
            <p>
                <a href="show?id=<?= $album["id"] ?>">Show</a> |
                <a href="edit?id=<?=$album['id']?>">Edit</a> |
                <a href="delete?id=<?=$album['id']?>">Delete</a>
            </p>
            <p><a href="/casa_productie_muzica/artists/show?id=<?= $album["artist_id"] ?>">View Artist </a></p>
        </div>
    <?php endforeach; ?>
    </div>
<a href="/casa_productie_muzica/artists/index">Back</a>
</body>
</html>
