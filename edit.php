<?php
include_once("config/url.php");
include_once("config/process.php");
include_once("templates/header.php");
?>

<div class="container">
    <?php include_once("templates/backbtn.html"); ?>
    <?php if($contact): ?>
    <h1 id="main-title">Editar contato</h1>
    <form id="edit-form" action="<?= $BASE_URL ?>config/process.php" method="POST">
        <input type="hidden" name="type" value="edit">
        <input type="hidden" name="id" value="<?= (int) $contact["id"] ?>">
        <div class="form-group">
            <label for="name">Nome do contato:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($contact["name"], ENT_QUOTES, "UTF-8") ?>" placeholder="Digite o nome" required>
        </div>
        <div class="form-group">
            <label for="phone">Telefone do contato:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($contact["phone"], ENT_QUOTES, "UTF-8") ?>" placeholder="Digite o telefone" required>
        </div>
        <div class="form-group">
            <label for="observations">Observa&ccedil;&atilde;o:</label>
            <textarea class="form-control" id="observations" name="observations" placeholder="Digite as observa&ccedil;&otilde;es" rows="3"><?= htmlspecialchars($contact["observations"], ENT_QUOTES, "UTF-8") ?></textarea>
        </div>
        <button id="btn-c" type="submit" class="btn btn-primary">Atualizar</button>
    </form>
    <?php else: ?>
        <p id="empty-list-text">Contato n&atilde;o encontrado.</p>
    <?php endif; ?>
</div>

<?php
include_once("templates/footer.php");
?>
