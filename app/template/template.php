<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ut">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/style.css">
    <title><?php echo $title; ?></title>
</head>

<body>
    <?php include_once "navBar.php" ?>
    <div class="container">
        <?php echo $content; ?>
    </div>
    <script src="../dist/app-bundle.js"></script>
</body>

</html>