<h2>Contact</h2>
<p>Send us a message about the City Explorer Portal. Fields marked <span class="required-mark">*</span> are required.</p>

<div id="contact-js-errors" class="form-errors" role="alert" hidden></div>

<?php if (!empty($contact_errors['_form'])) { ?>
<p class="form-errors"><?= htmlspecialchars($contact_errors['_form'], ENT_QUOTES, 'UTF-8') ?></p>
<?php } ?>

<form id="contact-form" action="contact" method="post" novalidate>
    <fieldset class="contact-fieldset">
        <legend>Contact form</legend>

        <p>
            <label for="sender_name">Your name <span class="required-mark">*</span></label><br>
            <input type="text" name="sender_name" id="sender_name" maxlength="100" autocomplete="name"
                value="<?= htmlspecialchars($contact_old['sender_name'], ENT_QUOTES, 'UTF-8') ?>">
            <?php if (!empty($contact_errors['sender_name'])) { ?>
            <span class="field-error"><?= htmlspecialchars($contact_errors['sender_name'], ENT_QUOTES, 'UTF-8') ?></span>
            <?php } ?>
        </p>

        <p>
            <label for="sender_email">Email <span class="required-mark">*</span></label><br>
            <input type="email" name="sender_email" id="sender_email" maxlength="120" autocomplete="email"
                value="<?= htmlspecialchars($contact_old['sender_email'], ENT_QUOTES, 'UTF-8') ?>">
            <?php if (!empty($contact_errors['sender_email'])) { ?>
            <span class="field-error"><?= htmlspecialchars($contact_errors['sender_email'], ENT_QUOTES, 'UTF-8') ?></span>
            <?php } ?>
        </p>

        <p>
            <label for="subject">Subject <span class="required-mark">*</span></label><br>
            <input type="text" name="subject" id="subject" maxlength="150"
                value="<?= htmlspecialchars($contact_old['subject'], ENT_QUOTES, 'UTF-8') ?>">
            <?php if (!empty($contact_errors['subject'])) { ?>
            <span class="field-error"><?= htmlspecialchars($contact_errors['subject'], ENT_QUOTES, 'UTF-8') ?></span>
            <?php } ?>
        </p>

        <p>
            <label for="message_body">Message <span class="required-mark">*</span></label><br>
            <textarea name="message_body" id="message_body" rows="6" cols="50"><?= htmlspecialchars($contact_old['message_body'], ENT_QUOTES, 'UTF-8') ?></textarea>
            <?php if (!empty($contact_errors['message_body'])) { ?>
            <span class="field-error"><?= htmlspecialchars($contact_errors['message_body'], ENT_QUOTES, 'UTF-8') ?></span>
            <?php } ?>
        </p>

        <p>
            <button type="submit" id="contact-submit">Send message</button>
        </p>
    </fieldset>
</form>

<section class="contact-map" aria-labelledby="contact-map-heading">
    <h3 id="contact-map-heading">Location</h3>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2726.3375296155727!2d19.66695091525771!3d46.89607994478184!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4743da7a6c479e1d%3A0xc8292b3f6dc69e7f!2sPallasz+Ath%C3%A9n%C3%A9+Egyetem+GAMF+Kar!5e0!3m2!1shu!2shu!4v1475753185783" width="600" height="450" style="border:0;max-width:100%;" allowfullscreen loading="lazy" title="Campus map"></iframe>
    <p><a target="_blank" rel="noopener noreferrer" href="https://www.google.hu/maps/place/Pallasz+Ath%C3%A9n%C3%A9+Egyetem+GAMF+Kar/@46.8960799,19.6669509,17z/data=!3m1!4b1!4m5!3m4!1s0x4743da7a6c479e1d:0xc8292b3f6dc69e7f!8m2!3d46.8960763!4d19.6691396?hl=hu">Open larger map</a></p>
</section>

<script>
(function () {
    var form = document.getElementById('contact-form');
    var box = document.getElementById('contact-js-errors');
    if (!form || !box) return;

    function showJsError(msg) {
        box.textContent = msg;
        box.hidden = false;
    }
    function clearJsError() {
        box.textContent = '';
        box.hidden = true;
    }

    form.addEventListener('submit', function (e) {
        clearJsError();
        var name = (form.sender_name && form.sender_name.value) ? form.sender_name.value.trim() : '';
        var email = (form.sender_email && form.sender_email.value) ? form.sender_email.value.trim() : '';
        var subject = (form.subject && form.subject.value) ? form.subject.value.trim() : '';
        var body = (form.message_body && form.message_body.value) ? form.message_body.value.trim() : '';

        if (!name) {
            e.preventDefault();
            showJsError('Please enter your name.');
            return false;
        }
        if (name.length > 100) {
            e.preventDefault();
            showJsError('Name must be at most 100 characters.');
            return false;
        }
        if (!email) {
            e.preventDefault();
            showJsError('Please enter your email.');
            return false;
        }
        if (email.length > 120) {
            e.preventDefault();
            showJsError('Email must be at most 120 characters.');
            return false;
        }
        var at = email.indexOf('@');
        if (at < 1 || at === email.length - 1 || email.indexOf('@', at + 1) !== -1) {
            e.preventDefault();
            showJsError('Please enter a valid email address.');
            return false;
        }
        if (!subject) {
            e.preventDefault();
            showJsError('Please enter a subject.');
            return false;
        }
        if (subject.length > 150) {
            e.preventDefault();
            showJsError('Subject must be at most 150 characters.');
            return false;
        }
        if (!body) {
            e.preventDefault();
            showJsError('Please enter your message.');
            return false;
        }
        return true;
    });
})();
</script>
