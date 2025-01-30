<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
<<<<<<< HEAD
    public string $fromEmail  = 'utkarsh@ornatets.com'; // Your email address
    public string $fromName   = 'Ornate TechnoServices'; // Your name or company name
=======
    public string $fromEmail  = '';
    public string $fromName   = '';
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
    public string $recipients = '';

    /**
     * The "user agent"
     */
    public string $userAgent = 'CodeIgniter';

    /**
     * The mail sending protocol: mail, sendmail, smtp
     */
<<<<<<< HEAD
    public string $protocol = 'smtp'; // Use SMTP protocol
 
    /**
     * SMTP Server Hostname    $mail->Host = 'mail.ornatets.com';
     */
    public string $SMTPHost = 'mail.ornatets.com'; 
=======
    public string $protocol = 'mail';

    /**
     * The server path to Sendmail.
     */
    public string $mailPath = '/usr/sbin/sendmail';

    /**
     * SMTP Server Hostname
     */
    public string $SMTPHost = '';
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26

    /**
     * SMTP Username
     */
<<<<<<< HEAD
    public string $SMTPUser = 'noreply@ornatets.com'; // Your email username
=======
    public string $SMTPUser = '';
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26

    /**
     * SMTP Password
     */
<<<<<<< HEAD
    public string $SMTPPass = 'NoReOrnate@2023*'; // Your email password
=======
    public string $SMTPPass = '';
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26

    /**
     * SMTP Port
     */
<<<<<<< HEAD
    public int $SMTPPort = 465; // Commonly used: 587 (TLS) or 465 (SSL)
=======
    public int $SMTPPort = 25;
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26

    /**
     * SMTP Timeout (in seconds)
     */
    public int $SMTPTimeout = 5;

    /**
     * Enable persistent SMTP connections
     */
    public bool $SMTPKeepAlive = false;

    /**
     * SMTP Encryption.
<<<<<<< HEAD
     */
    public string $SMTPCrypto = 'ssl'; // 'tls' or 'ssl'
=======
     *
     * @var string '', 'tls' or 'ssl'. 'tls' will issue a STARTTLS command
     *             to the server. 'ssl' means implicit SSL. Connection on port
     *             465 should set this to ''.
     */
    public string $SMTPCrypto = 'tls';
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26

    /**
     * Enable word-wrap
     */
    public bool $wordWrap = true;

    /**
<<<<<<< HEAD
     * Type of mail, either 'text' or 'html'
     */
    public string $mailType = 'html'; // Use 'html' for rich text emails
=======
     * Character count to wrap at
     */
    public int $wrapChars = 76;

    /**
     * Type of mail, either 'text' or 'html'
     */
    public string $mailType = 'text';
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26

    /**
     * Character set (utf-8, iso-8859-1, etc.)
     */
    public string $charset = 'UTF-8';

    /**
<<<<<<< HEAD
=======
     * Whether to validate the email address
     */
    public bool $validate = false;

    /**
     * Email Priority. 1 = highest. 5 = lowest. 3 = normal
     */
    public int $priority = 3;

    /**
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
     * Newline character. (Use “\r\n” to comply with RFC 822)
     */
    public string $CRLF = "\r\n";

    /**
     * Newline character. (Use “\r\n” to comply with RFC 822)
     */
    public string $newline = "\r\n";
<<<<<<< HEAD
}


// $mail->isSMTP();
//         
//         $mail->SMTPAuth = true;
//         $mail->Username = 'rashika@ornatets.com'; 
//         $mail->Password = 'RashikA@24**'; 
//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
//         $mail->Port = 587; 
//         $mail->setFrom('rashika@ornatets.com', 'admin');
//         $mail->addAddress($to);
        
//         $mail->isHTML(false);
//         $mail->Subject = $subject;
//         $mail->Body = $message;
        
//         $mail->send();
//         return true;
=======

    /**
     * Enable BCC Batch Mode.
     */
    public bool $BCCBatchMode = false;

    /**
     * Number of emails in each BCC batch
     */
    public int $BCCBatchSize = 200;

    /**
     * Enable notify message from server
     */
    public bool $DSN = false;
}
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
