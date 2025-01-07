<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/picnic">
    <title>Albums</title>
</head>
<body>
    <h1>New album</h1>
    <form action="create" method="post" enctype="multipart/form-data">
    <input type="hidden" name="album_post" value="1">
    <p> <label for="name">Name</label>
        <input type="text" name="name" id="name" value=" <?=$_SESSION["create_album"]["album"]['name'] ?>">
    </p>
    <p style="color: red;">
            <?php 
            if (isset($_SESSION['create_album']["errors"]['name_error'])):
                echo $_SESSION['create_album']["errors"]['name_error'];
                unset($_SESSION['create_album']["errors"]['name_error']);
                endif;
            ?>
        </p>
    <p><label for="release_date">Release date</label>
        <input type="text" name="release_date" id="release_date" value=" <?=$_SESSION["create_album"]["album"]['release_date'] ?>">
    </p>
    <p style="color: red;">
            <?php 
            if (isset($_SESSION['create_album']["errors"]['date_error'])):
                echo $_SESSION['create_album']["errors"]['date_error'];
                unset($_SESSION['create_album']["errors"]['date_error']);
                endif;
            ?>
        </p>    
    <p><label for="price">Price</label>
        <input type="text" name="price" id="price" value=" <?=$_SESSION["create_album"]["album"]['price'] ?>">
    </p>
    <p style="color: red;">
            <?php 
            if (isset($_SESSION['create_album']["errors"]['price_error'])):
                echo $_SESSION['create_album']["errors"]['price_error'];
                unset($_SESSION['create_album']["errors"]['price_error']);
                endif;
            ?>
        </p>
    <p><label for="genre">Genre</label>
        <input type="text" name="genre" id="genre" value=" <?=$_SESSION["create_album"]["album"]['genre'] ?>">
    </p>
    <p><label for="stoc">Stoc</label>
        <input type="text" name="stoc" id="stoc" value=" <?=$_SESSION["create_album"]["album"]['stoc'] ?>">
    </p>
    <p style="color: red;">
            <?php 
            if (isset($_SESSION['create_album']["errors"]['stoc_error'])):
                echo $_SESSION['create_album']["errors"]['stoc_error'];
                unset($_SESSION['create_album']["errors"]['stoc_error']);
                endif;
            ?>
        </p>
    <p><label for="artist_id">Artist id</label>
    <select name="artist_id" id="artist_id">
                <?php foreach ($artists as $artist) : ?>
                    <option value="<?= $artist['id'] ?>"><?= $artist['name'] ?></option>
                <?php endforeach; ?>
            </select>
    </p>
    <p><label for="image">Image</label>
        <input type="file" name="file" id="file">
    </p>
    <p style="color: red;">
            <?php 
            if (isset($_SESSION['create_album']["errors"]['file_error'])):
                echo $_SESSION['create_album']["errors"]['file_error'];
                unset($_SESSION['create_album']["errors"]['file_error']);
                endif;
            ?>
        </p>
        <input type="submit" value="Create" name="create">
    </form>
</body>
</html>