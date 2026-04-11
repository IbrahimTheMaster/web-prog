<?php
/**
 * Contact: PHP validation, INSERT into messages, redirect to fifth page (contact-result).
 */
$contact_errors = array();
$contact_old = array(
    'sender_name' => '',
    'sender_email' => '',
    'subject' => '',
    'message_body' => '',
);

$contact_pdo = function () {
    return new PDO(
        'mysql:host=localhost;dbname=databaselesson',
        'root',
        '',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
};

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender_name = isset($_POST['sender_name']) ? trim((string) $_POST['sender_name']) : '';
    $sender_email = isset($_POST['sender_email']) ? trim((string) $_POST['sender_email']) : '';
    $subject = isset($_POST['subject']) ? trim((string) $_POST['subject']) : '';
    $message_body = isset($_POST['message_body']) ? trim((string) $_POST['message_body']) : '';

    $contact_old = array(
        'sender_name' => $sender_name,
        'sender_email' => $sender_email,
        'subject' => $subject,
        'message_body' => $message_body,
    );

    if ($sender_name === '') {
        $contact_errors['sender_name'] = 'Name is required.';
    } elseif (mb_strlen($sender_name) > 100) {
        $contact_errors['sender_name'] = 'Name must be at most 100 characters.';
    }

    if ($sender_email === '') {
        $contact_errors['sender_email'] = 'Email is required.';
    } elseif (!filter_var($sender_email, FILTER_VALIDATE_EMAIL)) {
        $contact_errors['sender_email'] = 'Please enter a valid email address.';
    } elseif (mb_strlen($sender_email) > 120) {
        $contact_errors['sender_email'] = 'Email must be at most 120 characters.';
    }

    if ($subject === '') {
        $contact_errors['subject'] = 'Subject is required.';
    } elseif (mb_strlen($subject) > 150) {
        $contact_errors['subject'] = 'Subject must be at most 150 characters.';
    }

    if ($message_body === '') {
        $contact_errors['message_body'] = 'Message is required.';
    }

    if (empty($contact_errors)) {
        $user_id = null;
        if (isset($_SESSION['login'], $_SESSION['user_id'])) {
            $user_id = (int) $_SESSION['user_id'];
        }

        try {
            $dbh = $contact_pdo();
            $dbh->query('SET NAMES utf8 COLLATE utf8_general_ci');
            $sql = 'INSERT INTO messages (sender_name, sender_email, subject, message_body, user_id)
                    VALUES (:sender_name, :sender_email, :subject, :message_body, :user_id)';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':sender_name', $sender_name, PDO::PARAM_STR);
            $stmt->bindValue(':sender_email', $sender_email, PDO::PARAM_STR);
            $stmt->bindValue(':subject', $subject, PDO::PARAM_STR);
            $stmt->bindValue(':message_body', $message_body, PDO::PARAM_STR);
            if ($user_id === null) {
                $stmt->bindValue(':user_id', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            }
            $stmt->execute();

            $_SESSION['contact_result'] = array(
                'sender_name' => $sender_name,
                'sender_email' => $sender_email,
                'subject' => $subject,
                'message_body' => $message_body,
                'saved_at' => date('Y-m-d H:i:s'),
            );
            header('Location: contact-result');
            exit;
        } catch (PDOException $e) {
            $contact_errors['_form'] = 'We could not save your message. Please try again later.';
        }
    }
}
