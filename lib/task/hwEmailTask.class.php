<?php

class hwEmailTask extends sfBaseTask
{
    protected function configure()
    {
        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_OPTIONAL, 'The application name', true),
            new sfCommandOption('uri', null, sfCommandOption::PARAMETER_OPTIONAL, 'The URI to POST to', '@email_post'),
            new sfCommandOption('email-address', null, sfCommandOption::PARAMETER_OPTIONAL, 'Email address of the IMAP Mailbox'),
            new sfCommandOption('password', null, sfCommandOption::PARAMETER_OPTIONAL, 'Password of the IMAP Mailbox', sfConfig::get('app_smtp_password'))
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
        if (!$options['email-address']) $options['email-address'] = sfConfig::get('app_smtp_username');
        if (!$options['password']) $options['password'] = sfConfig::get('app_smtp_password');
        
        
    }
}
