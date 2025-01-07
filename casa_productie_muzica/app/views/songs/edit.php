<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/picnic">
    <title>Edit Song</title>
</head>
<body>
    <h1>Song profile</h1>
    <form method="post">
    <input type="hidden" name="id" value="<?=$song["id"] ?>">
    <p> <label for="name">Name</label>
        <input type="text" name="name" id="name" value=" <?=$song["name"] ?>">
    </p>
        <p>
            <?php  
                if (isset($_SESSION["edit_song"]) && isset($_SESSION["edit_song"]['name_error'])) 
                echo $_SESSION["edit_song"]['name_error'];
                unset($_SESSION["edit_song"]['name_error']);
            ?>
        </p>
    <p><label for="length">Length</label>
        <input type="text" name="length" id="length" value=" <?=$song["length"] ?>">
    </p>
        <p>
            <?php  
                if (isset($_SESSION["edit_song"]) && isset($_SESSION["edit_song"]['length_error'])) 
                echo $_SESSION["edit_song"]['length_error'];
                // var_dump ($_SESSION["edit_artist"]);
                unset($_SESSION["edit_song"]['length_error']);
            ?>
        </p>
        <input type="submit" value="Update" name="update">
    </form>
    <a href="index?id=<?=$song["album_id"] ?>">Back</a>
</body>
</html>