<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail  = 'admin@addwalls.com';
    public string $fromName   = 'Addwalls';
    public string $recipients = '';

    /**
     * The "user agent"
     */
    public string $userAgent = 'CodeIgniter';

    /**
     * The mail sending protocol: mail, sendmail, smtp
     */
    public string $protocol = 'mail';

    /**
     * The server path to Sendmail.
     */
    public string $mailPath = '/usr/sbin/sendmail';

    /**
     * SMTP Server Hostname
     */
    public string $SMTPHost = 'www.addwalls.com';

    /**
     * SMTP Username
     */
    public string $SMTPUser = 'admin@addwalls.com';

    /**
     * SMTP Password
     */
    public string $SMTPPass = 'Dizcuz@123';

    /**
     * SMTP Port
     */
    public int $SMTPPort = 25;

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
     *
     * @var string '', 'tls' or 'ssl'. 'tls' will issue a STARTTLS command
     *             to the server. 'ssl' means implicit SSL. Connection on port
     *             465 should set this to ''.
     */
    public string $SMTPCrypto = 'tls';

    /**
     * Enable word-wrap
     */
    public bool $wordWrap = true;

    /**
     * Character count to wrap at
     */
    public int $wrapChars = 76;

    /**
     * Type of mail, either 'text' or 'html'
     */
    public string $mailType = 'text';

    /**
     * Character set (utf-8, iso-8859-1, etc.)
     */
    public string $charset = 'UTF-8';

    /**
     * Whether to validate the email address
     */
    public bool $validate = false;

    /**
     * Email Priority. 1 = highest. 5 = lowest. 3 = normal
     */
    public int $priority = 3;

    /**
     * Newline character. (Use “\r\n” to comply with RFC 822)
     */
    public string $CRLF = "\r\n";

    /**
     * Newline character. (Use “\r\n” to comply with RFC 822)
     */
    public string $newline = "\r\n";

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









//  public $fromEmail = 'admin@example.com';
//     public $fromName = 'Addwalls';
//     public $recipients = '';

//     // SMTP configuration (optional)
//     public $protocol = 'mail'; // Use 'smtp' for SMTP configuration
//     public $SMTPHost = 'www.addwalls.com';
//     public $SMTPUser = 'admin@addwalls.com';
//     public $SMTPPass = 'Dizcuz@123';
//     public $SMTPPort = 587;
//     public $SMTPTimeout = 30;
//     public $SMTPCrypto = 'tls'; // Use 'ssl' for SSL encryption

//     // Other email settings
//     public $mailType = 'html'; // Use 'text' for plain text emails
//     public $charset = 'UTF-8';
//     public $wordWrap = true;
//     public $newline = "\r\n";
//     public $CRLF = "\r\n";















}
