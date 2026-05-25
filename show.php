<?php
include_once("config/url.php");
include_once("config/process.php");

$printMsg = $_SESSION['msg'] ?? '';
$_SESSION['msg'] = '';

include_once("templates/header.php");
?>
<div class="container" id="view-contact-container">
    <?php include_once("templates/backbtn.html"); ?>
    <?php if($contact): ?>
        <h1 id="main-title"><?= htmlspecialchars($contact["name"], ENT_QUOTES, "UTF-8") ?></h1>
        <p class="bold">Telefone:</p>
        <p><?= $contact["phone"] ?></p>
        <p class="bold">Observação:</p>
        <p><?= $contact["observations"] ?></p>
    <?php else: ?>
        <p id="empty-list-text">Contato não encontrado.</p>
    <?php endif; ?>
</div>
<?php
include_once("templates/footer.php");
?>
