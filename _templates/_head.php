<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Login to Photogram</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.1.0/css/hover-min.css"
        integrity="sha512-glciccPoOqr5mfDGmlJ3bpbvomZmFK+5dRARpt62nZnlKwaYZSfFpFIgUoD8ujqBw4TmPa/F3TX28OctJzoLfg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap core CSS -->
    <link href="<?=get_config("base_name")?>assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <?if (file_exists($_SERVER['DOCUMENT_ROOT']."my-app/css/".(basename($_SERVER['PHP_SELF'], '.php'))));{?>
    <link
        href="<?=get_config("base_name")?>css/<?=(basename($_SERVER['PHP_SELF'], '.php'));?>.css"
        rel="stylesheet">
    <?}?>
</head>