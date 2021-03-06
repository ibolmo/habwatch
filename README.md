Introduction
------------
Harmful Algal Bloom (HAB) Watch is a listing of HAB events as reported by the community, state program volunteers, official offices, from historical events, or by other MERHAB projects. 

Our goal is to facilitate, improve, and inform: to facilitate current monitoring volunteers that weekly visit the California shorelines to protect the community, fisheries, and ecology; to improve the body of knowledge of HABs by using latest metrics, data visualization, and other technologies; and to inform the public to reduce human exposure to HABs.

Team Members
------------
Olmo Maldoando | ibolmo@ucla.edu | Graduate Student Researcher  
Nithya Ramanathan | nithya@cs.ucla.edu | Research Staff  
Eric Graham | egraham@cens.ucla.edu | Research Staff  
Deborah Estrin | destrin@cs.ucla.edu | Director  

Data Feed
---------
feed://api.flickr.com/services/feeds/photos_public.gne?id=35147405@N02&lang=en-us&format=rss_200

Requirements
------------
Doctrine 1.1.x
Symfony 1.2.x
PHP 5.2.x

## PEAR Modules
FirePHP (development, only)

Installation
------------
After installing the aforementioned dependencies, you will need to download a copy of habwatch into a directory, or for development:

    > git clone git://github.com/ibolmo/habwatch.git habwatch; cd habwatch
    > git submodule update --init
    > cd web/css/blueprintcss
    > git submodule update --init
    
    // Summary: clone the latest habwatch and update (init) the submodules used in habwatch as well as the blueprintcss submodules.

Lastly, modify app.sample.php to reflect your configuration:

    > mv ./config/app.sample.php ./config/app.php; vim ./config/app.php

Ideas
-----
SMS Authorization (instead of relying on known #s)

Todo 
----
Use sfDoctrineActAsTaggable -- http://www.symfony-project.org/plugins/sfDoctrineActAsTaggablePlugin  
Use sfFeed2Plugin -- http://www.symfony-project.org/plugins/sfFeed2Plugin  
Use sfGoogleAnalytics -- http://www.symfony-project.org/plugins/sfGoogleAnalyticsPlugin  
Use sfErrorHandler -- http://www.symfony-project.org/plugins/sfErrorHandlerPlugin  
Use xsPChartPlugin -- http://www.symfony-project.org/plugins/xsPChartPlugin  
