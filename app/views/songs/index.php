<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/picnic">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Songs</title>
</head>
<body>
<h1>All Songs</h1>
<a href="create" role="button">New song</a>
<table>
    <tr>
        <th>Name</th>
        <th>Length</th>
        <?php if(isset($_SESSION["request_user"]) && $_SESSION["request_user"]["role_id"]==1): ?>
        <th>Actions</th>
        <?php endif; ?>
    </tr>
    <?php foreach ($songs as $song) : ?>
        <tr>
            <td><?= $song["name"] ?></td>
            <td><?= $song["length"] ?></td>
            <?php if(isset($_SESSION["request_user"]) && $_SESSION["request_user"]["role_id"]==1): ?>
            <td>
                <a href="edit?id=<?=$song['id']?>">Edit</a> |
                <a href="delete?id=<?=$song['id']?>">Delete</a>
            </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>