<?php

    $rel = '';
    $icon = '';

    if (!empty($vars['object']->readof)) {
        $rel = 'rel="read" class="u-read-of"';
        $icon = '<i class="fa fa-book"></i> ';
    }
    
    if (!empty($vars['object']->pageTitle)) {
        $body = $vars['object']->pageTitle;
    } else {
        $body = $vars['object']->body;
    }

?>
<div class="known-read">
    <?php

        if (empty($vars['feed_view'])) {

            ?>
            <h2 class="p-bookmark"><?=$icon?><a href="<?= $vars['object']->body; ?>" rel="bookmark"
                                      target="_blank"><?= $this->parseURLs(htmlentities(strip_tags($body)), $rel) ?></a>
            </h2>
        <?php

        }

        if (!empty($vars['object']->description)) {
            echo $this->__(['value' => $vars['object']->description, 'object' => $vars['object'], 'rel' => $rel])->draw('forms/output/richtext');
        
        }
        
        if (!empty($vars['object']->tags)) {
        ?>
            <p class="tag-row"><i class="icon-tag"></i><?=$this->parseURLs($this->parseHashtags(htmlentities(strip_tags($vars['object']->tags))),$rel)?></p>
        <?php
        }

    ?>
</div>
<?= $this->draw('entity/content/embed'); ?>
