<?php

class hwEmailTask extends sfDoctrineBaseTask
{
    protected function configure()
    {
        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_OPTIONAL, 'The application name', 'frontend'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('uri', null, sfCommandOption::PARAMETER_REQUIRED, 'The URI to POST to'),
            new sfCommandOption('mail-connection', null, sfCommandOption::PARAMETER_OPTIONAL, 'URI Abstraction (see Net_Url.php) for mailbox connection'),
        ));
        
        $this->aliases = array('habwatch-email-pull');
        $this->namespace        = 'habwatch';
        $this->name             = 'email-pull';
        $this->briefDescription = 'Connects to an IMAP server and pulls all emails and pushes to a URI';
        $this->detailedDescription = <<<EOF
The [hwEmail|INFO] task Will connect to the IMAP server and pull all new email and push them to a URI
Call it with:
  [php symfony hwEmail|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array())
    {
        if (!$options['mail-connection']) $options['mail-connection'] = sfConfig::get('app_imap_uri') or die('Missing mail-connection');
        
        require_once 'Mail/IMAPv2.php';  
        $mail = new Mail_IMAPv2($options['mail-connection']);
        if ($alerts = $mail->alerts(false)) $this->logSection('email', $alerts);
        if ($errors = $mail->errors(false)) $this->logSection('email', $errors, null, 'ERROR');
        
        if ($count = $mail->messageCount()) {
            $browser = new sfWebBrowser();
            $this->logSection('email', "You have $count messages");
            
            for ($mid = 1; $mid  <= $count; $mid++) {
                $mail->getHeaders($mid);
                $header = $mail->header[$mid];
                                
                $mail->getParts($mid);
                $msg = $mail->msg[$mid];
                
                $browser->post($options['uri'], array(
                    'from' => $header['fromaddress'],
                    'to' => $header['toaddress'],
                    'reply-to' => $header['reply_toaddress'],
                    'subject' => $header['subject'],
                    'timestamp' => $header['udate'],
                    'message-id' => $header['message-id'],
                    'photos' => array(
                        'filename1' => '@photo',
                        'filename2' => '@photo',
                    )
                ));
                
                //*
                var_dump(array(
                    'result' => $browser->getResponse()
                ));
                //*/
            }
        } else {
            $this->logSection('email', 'No new messages');
        }
        
        $mail->close();
        if ($mail->error) $this->logBlock($mail->error->getErrors(), 'ERROR');
    }
}
