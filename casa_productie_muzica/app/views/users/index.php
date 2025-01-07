<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/picnic">
    <title>Users</title>
</head>
<body>
<h1>All Users</h1>
<?php  if ($create_permission){
    echo ("<button><a href='create'>Create</a></button>");
} ?>
<a href="export_excel" class="btn btn-success"><i class="dwn"></i>Export excel</a> |
<a href="export_word" class="btn btn-success"><i class="dwn"></i>Export word</a> |
<a href="export_pdf" class="btn btn-success"><i class="dwn"></i>Export pdf</a>
<!-- // <button><a href="create">Create</a></button> -->
<table>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user) : ?>
        <tr>
            <td><?= $user["first_name"] ?></td>
            <td><?= $user["last_name"] ?></td>
            <td><?= $user["email"] ?></td>
            <td>
                <a href="show?id=<?= $user["id"] ?>">Show</a> |
                <a href="edit?id=<?= $user["id"] ?>">Edit</a> |
                <a href="delete?id=<?= $user["id"] ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="/casa_productie_muzica/">Back</a>
</body>
</html>