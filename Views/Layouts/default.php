<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="<?= WEBROOT ?>HomeImages/Navbar Logo.jpg">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- CSS -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@500&display=swap" rel="stylesheet">

    <!-- Font Awesome Kit code -->
    <script src="https://kit.fontawesome.com/a4750b0b6a.js" crossorigin="anonymous"></script>

    <title><?= $title ?></title>

    <link rel="stylesheet" href="<?= WEBROOT ?>CSS/<?= lcfirst($title) ?>.css">

    <?php
    //if ($title == 'Signup' || $title == 'Profile')
        //echo '<script type="text/javascript" src="' . WEBROOT . 'Views/Javascript/dis_town.js"></script>';
    ?>

    <style>
        .no-js #loader {
            display: none;
        }

        .js #loader {
            display: block;
            position: absolute;
            left: 100px;
            top: 0;
        }

        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url(<?= '"'.WEBROOT.'/HomeImages/logo_gif.gif"'; ?>) center no-repeat #ccffe0;
            background-size: 150px 150px;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>

    <script>
        //paste this code under the head tag or in a separate js file.
        // Wait for window load
        $(window).on('load', function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut(800);
        });
    </script>

</head>

<body>

    <!-- To show an image when loading a page -->
    <div class="se-pre-con"></div>

    <div style="position: relative;min-height: 100vh;">
        <div style="padding-bottom: 2.5rem;">

            <!-- All other page content -->
            <?php if (isset($navbar)) {
                echo $navbar;
            } ?>
            <?= $content_for_layout; ?>

        </div>


    </div>
    
    <!-- Load footer -->
    <?php
    if ($title != "Login")
        include_once 'footer.php';
    ?>

</body>

</html>