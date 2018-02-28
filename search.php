<?php

require_once("auth/config.php");

$title = "Search";

?>

<?php require_once("layout/header.php"); ?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6" id="form-create">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET" autocomplete="off">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="warNameSearch" id="warNameSearch" class="form-control" data-provide="typeahead" placeholder="Search By War" autofocus required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="submit" value="Search" name="search" class="btn btn-primary form-control">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php
        echo WarHandler::searchWars($conn);
        ?>
    </div>
</div>
<?php require_once("layout/footer.php"); ?>
