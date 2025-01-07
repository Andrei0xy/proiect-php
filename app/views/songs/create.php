<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/picnic">
    <title>Songs</title>
</head>
<body>
    <h1>New song</h1>
    <form action="create" method="post">
    <input type="hidden" name="song_post" value="1">
    <p> <label for="name">Name</label>
        <input type="text" name="name" id="name" value=" <?=$_SESSION["create_song"]["song"]['name'] ?>">
    </p>
    <p style="color: red;">
            <?php 
            if (isset($_SESSION['create_song']["errors"]['name_error'])):
                echo $_SESSION['create_song']["errors"]['name_error'];
                unset($_SESSION['create_song']["errors"]['name_error']);
                endif;
            ?>
        </p>
    <p><label for="length">Length</label>
        <input type="text" name="length" id="length" value=" <?=$_SESSION["create_song"]["song"]['length'] ?>">
    </p>
    <p style="color: red;">
            <?php 
            if (isset($_SESSION['create_song']["errors"]['length_error'])):
                echo $_SESSION['create_song']["errors"]['length_error'];
                unset($_SESSION['create_song']["errors"]['length_error']);
                endif;
            ?>
        </p>    
        <input type="submit" value="Create" name="create">
    </form>
</body>
</html>