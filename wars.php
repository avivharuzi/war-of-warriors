<?php

require_once("auth/config.php");

$title = "Wars";

?>

<?php require_once("layout/header.php"); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <?php
            echo WarHandler::getWarsFinally($conn);
            ?>
        </div>
    </div>
</div>
<?php require_once("layout/footer.php"); ?>
