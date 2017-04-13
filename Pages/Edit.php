<?php

    namespace IdnoPlugins\Read\Pages {

        class Edit extends \Idno\Common\Page {

            function getContent() {

                $this->createGatekeeper();    // This functionality is for logged-in users only

                // Are we loading an entity?
                if (!empty($this->arguments)) {
                    $title = 'Edit read';
                    $object = \IdnoPlugins\Read\Read::getByID($this->arguments[0]);
                } else {
                    $title = 'New read';
                    $object = new \IdnoPlugins\Read\Read();
                    $object->pageTitle = ($object->getTitleFromURL($this->getInput('url')));
                }

                if ($owner = $object->getOwner()) {
                    $this->setOwner($owner);
                }

                $t = \Idno\Core\Idno::site()->template();
                $body = $t->__(array(
                    'object' => $object,
                    'url' => $this->getInput('url')
                ))->draw('entity/Read/edit');

                if (!empty($this->xhr)) {
                    echo $body;
                } else {
                    $t->__(array('body' => $body, 'title' => $title))->drawPage();
                }
            }

            function postContent() {
                $this->createGatekeeper();

                $new = false;
                if (!empty($this->arguments)) {
                    $object = \IdnoPlugins\Read\Read::getByID($this->arguments[0]);
                }
                if (empty($object)) {
                    $object = new \IdnoPlugins\Read\Read();
                }

                if ($object->saveDataFromInput()) {
                    $forward = $this->getInput('forward-to', $object->getDisplayURL());
                    $this->forward($forward);
                }

            }

        }

    }