<h2>Messages</h2>
<p>Contact form submissions (newest first). Senders who were not logged in are shown as <strong>Guest</strong>.</p>

<?php if ($messages_error !== '') { ?>
<p class="messages-error"><?= htmlspecialchars($messages_error, ENT_QUOTES, 'UTF-8') ?></p>
<?php } elseif (empty($messages_list)) { ?>
<p class="messages-empty">No messages yet.</p>
<?php } else { ?>
<div class="messages-table-wrap">
    <table class="messages-table">
        <thead>
            <tr>
                <th scope="col">Date and time</th>
                <th scope="col">Sender</th>
                <th scope="col">Subject</th>
                <th scope="col">Message</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages_list as $row) {
                $ts = isset($row['created_at']) ? strtotime($row['created_at']) : false;
                $when = $ts ? date('Y-m-d H:i', $ts) : htmlspecialchars((string) $row['created_at'], ENT_QUOTES, 'UTF-8');
                $is_guest = ($row['user_id'] === null || $row['user_id'] === '');
                $sender_label = $is_guest ? 'Guest' : htmlspecialchars($row['sender_name'], ENT_QUOTES, 'UTF-8');
                ?>
            <tr>
                <td><?= htmlspecialchars($when, ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= $sender_label ?></td>
                <td><?= htmlspecialchars($row['subject'], ENT_QUOTES, 'UTF-8') ?></td>
                <td class="messages-cell-body"><?= nl2br(htmlspecialchars($row['message_body'], ENT_QUOTES, 'UTF-8')) ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php } ?>
