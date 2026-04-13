<?php
/**
 * Logged-in only: list contact messages, newest first. Guest label when user_id is NULL.
 */
if (!isset($_SESSION['login'])) {
    header('Location: .');
    exit;
}

$messages_list = array();
$messages_error = '';

try {
    $dbh = new PDO(
        'mysql:host=localhost;dbname=databaselesson',
        'root',
        '',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    $dbh->query('SET NAMES utf8 COLLATE utf8_general_ci');
    $sql = 'SELECT id, sender_name, sender_email, subject, message_body, user_id, created_at
            FROM messages
            ORDER BY created_at DESC, id DESC';
    $sth = $dbh->query($sql);
    $messages_list = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $messages_error = 'Could not load messages. Please try again later.';
}
