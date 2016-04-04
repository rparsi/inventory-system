<?php

namespace AppBundle\Service;

/**
 * Class CustomMailer
 * Because the SwiftMailerBundle code doesn't handle smtp connections without username/password properly
 * @package AppBundle\Service
 */
class CustomMailer
{
    protected $mailer = null;
    protected $customTransport = null;
    protected $customMailer = null;
    protected $useMailCatcher = false;
    protected $host = null;
    protected $port = null;

    public function __construct(\Swift_Mailer $mailer, $useMailCatcher, $host, $port)
    {
        $this->mailer = $mailer;
        $this->useMailCatcher = $useMailCatcher;
        $this->host = $host;
        $this->port = $port;
    }

    public function send(\Swift_Message $message)
    {
        if (!$this->useMailCatcher) {
            return $this->mailer->send($message);
        }

        $this->createCustomTransport();
        $this->createCustomMailer();
        return $this->customMailer->send($message);
    }

    private function createCustomTransport()
    {
        if ($this->customTransport) {
            return $this->customTransport;
        }

        $this->customTransport = \Swift_SmtpTransport::newInstance($this->host, $this->port)
            ->setUsername(null)
            ->setPassword(null);

        return $this->customTransport;
    }

     private function createCustomMailer()
     {
         if ($this->customMailer) {
            return $this->customMailer;
         }

         $this->customMailer = \Swift_Mailer::newInstance($this->customTransport);
         return $this->customMailer;
    }
}
