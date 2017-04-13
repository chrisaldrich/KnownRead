<?php

    namespace IdnoPlugins\Read {

        class ContentType extends \Idno\Common\ContentType {

            public $title = 'Read';
            public $category_title = 'Read pages';
            public $entity_class = 'IdnoPlugins\\Read\\Read';
            public $indieWebContentType = array('bookmark','read','repost');

        }

    }