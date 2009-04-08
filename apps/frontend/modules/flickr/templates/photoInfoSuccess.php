<?= image_tag($Size['source'], array('id' => $Photo->getId(), 'alt' => $Photo->getDescription(), 'size' => $Size[0].'x'.$Size[1])) ?>

<?= include_partial('flickr/info', array('Info' => $Info)) ?>