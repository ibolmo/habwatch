<?= image_tag($Photo->buildImgUrl(Phlickr_Photo::SIZE_500PX), array('id' => $Photo->getId(), 'alt' => $Photo->getDescription(), 'size' => !$Photo->getRotation() ? '500x375' : '375x500')) ?>

<?= include_partial('flickr/info', array('Info' => $Info)) ?>