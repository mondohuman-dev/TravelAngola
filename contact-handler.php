<?php
// Initialize language system
require_once 'includes/language-config.php';

// Response array for JSON output
$response = ['success' => false, 'message' => ''];

// Check if form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = __('contact.form.error');
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Sanitize and validate input data
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

$name = sanitizeInput($_POST['name'] ?? '');
$email = sanitizeInput($_POST['email'] ?? '');
$phone = sanitizeInput($_POST['phone'] ?? '');
$subject = sanitizeInput($_POST['subject'] ?? '');
$message = sanitizeInput($_POST['message'] ?? '');

// Basic validation
$errors = [];

if (empty($name)) {
    $errors[] = 'Name is required';
}

if (empty($email)) {
    $errors[] = 'Email is required';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email format';
}

if (empty($subject)) {
    $errors[] = 'Subject is required';
}

if (empty($message)) {
    $errors[] = 'Message is required';
}

if (!empty($errors)) {
    $response['message'] = __('contact.form.error') . ': ' . implode(', ', $errors);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Prepare email content
$emailSubject = "Travel Angola Contact: " . $subject;
$emailBody = "
New contact form submission from Travel Angola website:

Name: $name
Email: $email
Phone: $phone
Subject: $subject

Message:
$message

--
Submitted at: " . date('Y-m-d H:i:s') . "
Language: " . getCurrentLanguage() . "
IP Address: " . ($_SERVER['REMOTE_ADDR'] ?? 'Unknown');

$headers = [
    'From: noreply@travelangola.co.ao',
    'Reply-To: ' . $email,
    'Content-Type: text/plain; charset=UTF-8',
    'X-Mailer: Travel Angola Contact Form'
];

// Send email (replace with your actual email address)
$to = 'info@travelangola.co.ao'; // Change this to your actual email

// For development/testing, you might want to log to file instead
$logEntry = "
=== Contact Form Submission ===
Date: " . date('Y-m-d H:i:s') . "
Name: $name
Email: $email
Phone: $phone
Subject: $subject
Message: $message
Language: " . getCurrentLanguage() . "
IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'Unknown') . "
================================

";

// Try to send email, fallback to file logging
$emailSent = false;
try {
    if (function_exists('mail') && mail($to, $emailSubject, $emailBody, implode("\r\n", $headers))) {
        $emailSent = true;
    }
} catch (Exception $e) {
    // Email sending failed, will fall back to logging
}

// Log to file for backup/development
$logFile = __DIR__ . '/contact-submissions.log';
if (file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX)) {
    if (!$emailSent) {
        $emailSent = true; // Consider logging as success if email fails
    }
}

if ($emailSent) {
    $response['success'] = true;
    $response['message'] = __('contact.form.success');
} else {
    $response['message'] = __('contact.form.error');
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>