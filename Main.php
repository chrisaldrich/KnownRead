<?php

    namespace IdnoPlugins\Read {

        class Main extends \Idno\Common\Plugin {
            function registerPages() {
                \Idno\Core\Idno::site()->addPageHandler('/read/edit/?', '\IdnoPlugins\Read\Pages\Edit');
                \Idno\Core\Idno::site()->addPageHandler('/read/callback/?', '\IdnoPlugins\Read\Pages\Callback');
                \Idno\Core\Idno::site()->addPageHandler('/read/edit/([A-Za-z0-9]+)/?', '\IdnoPlugins\Read\Pages\Edit');
                \Idno\Core\Idno::site()->addPageHandler('/read/delete/([A-Za-z0-9]+)/?', '\IdnoPlugins\Read\Pages\Delete');
                \Idno\Core\Idno::site()->addPageHandler('/read/([A-Za-z0-9]+)/.*', '\Idno\Pages\Entity\View');
            }
        }

    }