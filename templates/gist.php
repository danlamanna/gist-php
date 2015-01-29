<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>gists.danlamanna.com</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body role="document">
        <div class="container theme-showcase" role="main">
            <div>
                Created <?php echo date ("F d Y H:i:s", filemtime(GISTS_DIR . "/" . $gist_id)); ?>
                <br />
                <a href="<?php echo GIST_DOMAIN . "/" . GISTS_DIR . "/" . $gist_id; ?>">Raw Version</a>
            </div>

            <?php if (strpos($gist, "-----BEGIN PGP MESSAGE-----") === 0): ?>
                <div class="alert" role="alert">
                    Was this meant for you?<br />
                    <code>curl --silent <?php echo GIST_DOMAIN . "/" . GISTS_DIR . "/" . $gist_id; ?> | gpg --decrypt</code>
                </div>
            <?php endif; ?>

            <div>
                <textarea rows="25" cols="140"><?php echo $gist; ?></textarea>
            </div>
        </div>
    </body>
</html>
