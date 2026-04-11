<?php
/**
 * Fifth page: show submitted contact data after successful INSERT (session flash).
 */
if (!isset($_SESSION['contact_result'])) {
    header('Location: contact');
    exit;
}
$contact_result = $_SESSION['contact_result'];
unset($_SESSION['contact_result']);
