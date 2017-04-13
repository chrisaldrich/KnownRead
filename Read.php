<?php

    namespace IdnoPlugins\Read {

        class Read extends \Idno\Common\Entity {

            function getTitle() {
                if (!empty($this->pageTitle)) {
                    return $this->pageTitle;
                }
                return strip_tags($this->body);
            }

            function getDescription() {
                $body = $this->body;
                if (!empty($this->description)) {
                    $body .= ' ' . $this->description;
                }
                return $body;
            }

            function getURL() {
                // If we have a URL override, use it
                if (!empty($this->url)) {
                    return $this->url;
                }

                if (!empty($this->canonical)) {
                    return $this->canonical;
                }
                if (!($this->getSlug()) && ($this->getID())) {
                    return \Idno\Core\Idno::site()->config()->url . 'read/' . $this->getID() . '/' . $this->getPrettyURLTitle();
                } else {
                    return parent::getURL();
                }
            }

            /**
             * Returns a URL for syndication
             * @return mixed
             */
            function getSyndicationURL() {
                return $this->body;
            }

            /**
             * Read objects have type 'read'
             * @return 'read'
             */
            function getActivityStreamsObjectType() {
                return 'read';
            }

            /**
             * Given a URL, returns the page title.
             * @param $Url
             * @return mixed
             */
            function getTitleFromURL($Url){
                $str = \Idno\Core\Webservice::file_get_contents($Url);
                if(strlen($str) > 0){
                    if ($result = preg_match("/\<title\>(.*)\<\/title\>/siu",$str,$title)) {
                        return htmlspecialchars_decode($title[1]);
                    }
                }
                return '';
            }

            /**
             * Saves changes to this object based on user input
             * @return true|false
             */
            function saveDataFromInput() {

                if (empty($this->_id)) {
                    $new = true;
                } else {
                    $new = false;
                }
                $body = \Idno\Core\Idno::site()->currentPage()->getInput('body');
                $description = \Idno\Core\Idno::site()->currentPage()->getInput('description');
                $tags = \Idno\Core\Idno::site()->currentPage()->getInput('tags');
                $title = \Idno\Core\Idno::site()->currentPage()->getInput('title');
                $access = \Idno\Core\Idno::site()->currentPage()->getInput('access');
                $readof = \Idno\Core\Idno::site()->currentPage()->getInput('read-of');
                
                if ($time = \Idno\Core\Idno::site()->currentPage()->getInput('created')) {
                    if ($time = strtotime($time)) {
                        $this->created = $time;
                    }
                }

                $body = trim($body);
                if(filter_var($body, FILTER_VALIDATE_URL) || filter_var($readof, FILTER_VALIDATE_URL) {
                    if (!empty($body) || !empty($readof) {
                        $this->body = $body;
                        if (!empty($readof)) {
                            $this->body = $readof;
                            $this->readof = $readof;
                        }
                        $this->description = $description;
                        $this->tags = $tags;
                        if (empty($title)) {
                            if ($title = $this->getTitleFromURL($this->body)) {
                                $this->pageTitle = $title;
                            } else {
                                $this->pageTitle = '';
                            }
                        } else {
                        	$this->pageTitle = $title;
                        }
                        if (empty($title)) {
                            error_log("No title");
                            \Idno\Core\Idno::site()->session()->addErrorMessage('You need to specify a title.');
                            return false;
                        }
                        $this->setAccess($access);
                        if ($this->publish($new)) {
                            if ($this->getAccess() == 'PUBLIC') {
                                \Idno\Core\Webmention::pingMentions($this->getURL(), \Idno\Core\Idno::site()->template()->parseURLs($this->getDescription()));
                            }
                            return true;
                        }
                    } else {
                        error_log("No URL");
                        \Idno\Core\Idno::site()->session()->addErrorMessage('You can\'t bookmark an empty URL as read.');
                    }
                } else {
                    error_log("Invalid URL");
                    \Idno\Core\Idno::site()->session()->addErrorMessage('That doesn\'t look like a valid URL.');
                }
                return false;

            }

            function deleteData() {
                if ($this->getAccess() == 'PUBLIC') {
                    \Idno\Core\Webmention::pingMentions($this->getURL(), \Idno\Core\Idno::site()->template()->parseURLs($this->getDescription()));
                }
            }

        }

    }
