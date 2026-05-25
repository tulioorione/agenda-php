<?php
include_once("config/url.php");
include_once("config/process.php");

$printMsg = $_SESSION['msg'] ?? '';
$_SESSION['msg'] = '';

include_once("templates/header.php");
?>
    <div class="container" id="view-contact-container">
        <h1 id="main-title"><?= $contact["name"] ?></h1>
    </div>
<?php
include_once("templates/footer.php");
?>
