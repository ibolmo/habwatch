<?php

foreach(array(
    
    # Used for sending (forgotten password) emails
    'SMTP_USERNAME'     => 'user@stmp.tld',
    'SMTP_PASSWORD'     => 'password',
    
    'DOCTRINE_DB_DSN'   => 'driver://user:password@localhost:5432/database_name',
    
    # Get access to the Flickr API through: http://www.flickr.com/services/api/
    'FLICKR_API_KEY'    => '',
    'FLICKR_SECRET'     => '',
    'FLICKR_TOKEN'      => '',
    
    # Symfony (PEAR -- differs between installation) Directory path
    'PEAR_SF_DIR'       => '/path/to/symfony',
    
) as $key => $value) define($key, $value."\n");