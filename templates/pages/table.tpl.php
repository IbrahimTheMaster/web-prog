<h2>CRUD - City Places Dataset</h2>
<p>Logged-in users can create, edit, and delete records in the <code>city_places</code> table.</p>

<?php if (!empty($crudNotice)) { ?>
    <p class="crud-notice"><?= htmlspecialchars($crudNotice, ENT_QUOTES, 'UTF-8') ?></p>
<?php } ?>

<?php if (!empty($crudErrors)) { ?>
    <ul class="crud-errors">
        <?php foreach ($crudErrors as $error) { ?>
            <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
        <?php } ?>
    </ul>
<?php } ?>

<form class="crud-form" action="crud" method="post">
    <input type="hidden" name="action" value="<?= ($editingId > 0 ? 'update' : 'create') ?>">
    <?php if ($editingId > 0) { ?>
        <input type="hidden" name="id" value="<?= (int) $editingId ?>">
    <?php } ?>
    <p>
        <label for="place_name">Place name</label><br>
        <input id="place_name" name="place_name" maxlength="120" required value="<?= htmlspecialchars($crudForm['place_name'], ENT_QUOTES, 'UTF-8') ?>">
    </p>
    <p>
        <label for="district">District</label><br>
        <input id="district" name="district" maxlength="80" required value="<?= htmlspecialchars($crudForm['district'], ENT_QUOTES, 'UTF-8') ?>">
    </p>
    <p>
        <label for="category">Category</label><br>
        <input id="category" name="category" maxlength="60" required value="<?= htmlspecialchars($crudForm['category'], ENT_QUOTES, 'UTF-8') ?>">
    </p>
    <p>
        <label for="ticket_price">Ticket price (EUR)</label><br>
        <input id="ticket_price" name="ticket_price" type="number" step="0.01" min="0" required value="<?= htmlspecialchars($crudForm['ticket_price'], ENT_QUOTES, 'UTF-8') ?>">
    </p>
    <button type="submit"><?= ($editingId > 0 ? 'Update place' : 'Create place') ?></button>
    <?php if ($editingId > 0) { ?>
        <button class="crud-cancel" type="submit" name="cancel_edit" value="1">Cancel edit</button>
    <?php } ?>
</form>

<table class="crud-table">
    <caption>Current city_places records</caption>
    <tr>
        <th>ID</th>
        <th>Place</th>
        <th>District</th>
        <th>Category</th>
        <th>Ticket Price (EUR)</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($crudRows as $row) { ?>
        <tr>
            <td><?= (int) $row['id'] ?></td>
            <td><?= htmlspecialchars($row['place_name'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($row['district'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars((string) $row['ticket_price'], ENT_QUOTES, 'UTF-8') ?></td>
            <td>
                <form class="inline-edit" action="crud" method="post">
                    <input type="hidden" name="action" value="start_edit">
                    <input type="hidden" name="id" value="<?= (int) $row['id'] ?>">
                    <button type="submit">Edit</button>
                </form>
                <form class="inline-delete" action="crud" method="post">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= (int) $row['id'] ?>">
                    <button type="submit" onclick="return confirm('Delete this place?')">Delete</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>