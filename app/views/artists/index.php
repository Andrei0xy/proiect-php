<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artists</title>
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
        <h1>All Artists</h1>
        <a href="create" role="button">New artist</a>
    </div>
    <?php foreach ($artists as $artist) : ?>
        <div class="left">
            <img src=<?= $artist["image"] ?> alt="artist image" loading="lazy">
        </div>
        <div class="right">
            <p>Name: <?= $artist["name"] ?></p>
            <p>Join date: <?= $artist["join_date"] ?></p>
            <p>Origin: <?= $artist["origin"] ?></p>
            <p>Description: <?= $artist["description"] ?></p>
            <p>
                <a href="show?id=<?= $artist["id"] ?>">Show</a> |
                <a href="edit?id=<?=$artist['id']?>">Edit</a> |
                <a href="delete?id=<?=$artist['id']?>">Delete</a>
            </p>
            <p><a href="/casa_productie_muzica/albums/showfor?id=<?= $artist["id"] ?>">View albums</a></p>
            <p><?php 
                if(!isset($_SESSION['content'])){
                    $content=file_get_contents("https://www.shadyrecords.com/artists/");
                    $_SESSION['content']=$content;
                }
                $name=preg_replace('/\s+/','',$artist["name"]);
                $social=explode('<h2 class="title wrap">'.$name.'</h2>',$_SESSION['content']);
                $socialrel = isset($social[1]) ? explode('</ul>', $social[1]) : [];
                if (!empty($socialrel) && strpos($socialrel[1], 'youtube.com/user/' . $name) !== false) {
                    echo $socialrel[1];
                }
                ?></p>
        </div>
    <?php endforeach; ?>
    </div>
<a href="/casa_productie_muzica/">Back</a>
</body>
</html>