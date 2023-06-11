<?php

require_once('/data/live/vendor/autoload.php');
require_once('/data/live/vendor/swiftmailer/swiftmailer/lib/swift_required.php');
// require_once('/data/live/vendor/swiftmailer/swiftmailer/lib/swift_init.php');


class SwiftMailer extends CApplicationComponent
{
    public $host;
    public $port;
    public $encryption;
    public $username;
    public $password;
    public $from;

    public function send($to, $subject, $body, $attachment="",$attachmentPath="",$contentType = 'text/html')
    {
        // echo "Sent";
        // exit;
        $message = Swift_Message::newInstance($subject)
            ->setFrom([$this->from['email'] => $this->from['name']])
            ->setTo([$to])
            ->setBody($body, $contentType);
        if($attachment!=""){
            $attachment = Swift_Attachment::fromPath($attachmentPath)->setFilename($attachment);
            $message->attach($attachment);
        }

        $transport = Swift_SmtpTransport::newInstance($this->host, $this->port, $this->encryption)
            ->setUsername($this->username)
            ->setPassword($this->password);

        $mailer = Swift_Mailer::newInstance($transport);
        return $mailer->send($message);
    }
}