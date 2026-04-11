<h2>Message received</h2>
<p>Thank you. Your message was stored. A copy of what you sent appears below.</p>

<dl class="contact-result-summary">
    <dt>Saved at</dt>
    <dd><?= htmlspecialchars($contact_result['saved_at'], ENT_QUOTES, 'UTF-8') ?></dd>
    <dt>Name</dt>
    <dd><?= htmlspecialchars($contact_result['sender_name'], ENT_QUOTES, 'UTF-8') ?></dd>
    <dt>Email</dt>
    <dd><?= htmlspecialchars($contact_result['sender_email'], ENT_QUOTES, 'UTF-8') ?></dd>
    <dt>Subject</dt>
    <dd><?= htmlspecialchars($contact_result['subject'], ENT_QUOTES, 'UTF-8') ?></dd>
    <dt>Message</dt>
    <dd class="contact-result-body"><?= nl2br(htmlspecialchars($contact_result['message_body'], ENT_QUOTES, 'UTF-8')) ?></dd>
</dl>

<p><a href="contact">Send another message</a> &middot; <a href=".">Back to main page</a></p>
