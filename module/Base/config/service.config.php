<?php
/**
 * Service configuration
 */

return [
    'invokables' => [
        'doctrine_extensions.blameable' => 'Gedmo\Blameable\BlameableListener',
        'doctrine_extensions.iptraceable' => 'Gedmo\IpTraceable\IpTraceableListener',
        'doctrine_extensions.loggable' => 'Gedmo\Loggable\LoggableListener',
        'doctrine_extensions.uploadable' => 'Gedmo\Uploadable\UploadableListener',
        'doctrine_extensions.sluggable' => 'Gedmo\Sluggable\SluggableListener',
        'doctrine_extensions.softdeleteable' => 'Gedmo\SoftDeleteable\SoftDeleteableListener',
        'doctrine_extensions.sortable' => 'Gedmo\Sortable\SortableListener',
        'doctrine_extensions.translatable' => 'Gedmo\Translatable\TranslatableListener',
        'doctrine_extensions.timestampable' => 'Gedmo\Timestampable\TimestampableListener',
        'doctrine_extensions.treelistener' => 'Gedmo\Tree\TreeListener',
    ],
];
