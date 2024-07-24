<?php

$email = $_POST["email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$mysqli = require __DIR__ . "/connection.php";
if ($mysqli === false) {
    die("Conexiunea la baza de date a eșuat.");
}

$sql = "UPDATE users
        SET code = ?,
            expirat = ?
        WHERE email = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();

if ($mysqli->affected_rows) {

    $to = $email;
    $subject = "Password Reset";
    $message = "Click <a href='http://example.com/reset-password.php?token=$token'>here</a> to reset your password.";
    $headers = "From: noreply@example.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Salvăm mesajul într-un fișier .eml temporar
    $temp_file = tempnam(sys_get_temp_dir(), 'email');
    file_put_contents($temp_file, "To: $to\r\nSubject: $subject\r\n$headers\r\n$message");

    // Trimiterea e-mailului folosind sendmail
    $sendmail_path = "C:\xampp\SendMail\SendMail.exe";
    $sendmail_args = "-t";
    $sendmail_cmd = "$sendmail_path $sendmail_args < $temp_file";
    $result = exec($sendmail_cmd);

    if (!$result) {
        echo "Mesajul a fost trimis, verificați-vă inboxul.";
    } else {
        echo "Mesajul nu a putut fi trimis. Eroare sendmail: $result";
    }

    // Ștergem fișierul .eml temporar
    unlink($temp_file);
}

