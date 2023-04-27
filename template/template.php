<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ut">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <title><?php echo $title; ?></title>
</head>

<body>
    <?php include_once "navBar.php" ?>
    <?php echo $content; ?>
    <script src="../dist/bundle.js"></script>
</body>

</html>