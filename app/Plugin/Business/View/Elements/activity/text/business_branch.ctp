<?php
    $businessHelper = MooCore::getInstance()->getHelper('Business_Business');
    $business = $businessHelper->getOnlyBusiness($activity['Activity']['target_id']);
    $business = $business['Business'];
?>
<?php echo __d('business', ' created a new sub page for ');?>
<a href="<?php echo $business['moo_href'];?>">
    <?php echo $business['name'];?>
</a>