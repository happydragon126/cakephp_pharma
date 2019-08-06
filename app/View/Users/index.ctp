<?php 
$this->addPhraseJs(array(
    'information'       =>__('Information'),
    'menu_pharmacists'  =>__('This is menu for Pharmacists.'),
    'sorry'       =>__('Sorry'),
    'please_use_below'    =>  'Please use below',
    'search'    =>  'Search',
    'menu1'    =>  'menu',
    'menu_pharmacy'  =>__('This is menu for Pharmacy/Hospital Pharmacy/Sales rep.'),
    'dear_sales_reps'   =>  __('Dear Sales reps.'),
    'you_have_reached_the_right_place' => __('You have reached the right place'),
    'But_your_sales_area_seems_to_be'   =>  __('But, your sales area seems to be “not defined”'),
    'plz_click_this'   =>  __('Please click this'),
    'slink'   =>  __('link'),
    'cprofile_link'   =>  '/users/profile/'.$loggedInUser['id'],
    'and_define_your_sales_area_at_below_fields'   =>  __('and define your sales area at below fields'),
    'department'   =>  __('Department'),
    'sales'   =>  __('Sales'),
    'marketing'   =>  __('Marketing'),
    'others'   =>  __('Others'),
    'sales_area'   =>  __('Sales Area'),
));
?>
<?php if($this->request->is('ajax')): ?>
<script type="text/javascript">
    require(["jquery","mooUser"], function($,mooUser) {
        mooUser.initOnUserIndex();
        <?php if ( !empty( $values ) || !empty($online_filter) ): ?>
        $('#searchPeople').trigger('click');
        <?php endif; ?>
    });
</script>
<?php else: ?>
<?php $this->Html->scriptStart(array('inline' => false, 'domReady' => true, 'requires'=>array('jquery','mooUser'), 'object' => array('$', 'mooUser'))); ?>
mooUser.initOnUserIndex();
<?php if ( !empty( $values ) || !empty($online_filter) ): ?>
$('#searchPeople').trigger('click');
<?php endif; ?>

<?php $this->Html->scriptEnd(); ?>
<?php endif; ?>

<?php $this->setNotEmpty('west');?>
<?php $this->start('west'); ?>
	<div class="box2 filter_block">
            <h3 class="visible-xs visible-sm"><?php echo __('Browse')?></h3>
            <div class="box_content">
		<ul class="list2 menu-list" id="browse">
			<li class="current" id="everyone"><a data-url="<?php echo $this->request->base?>/users/ajax_browse/all" href="<?php echo $this->request->base?>/users"><?php echo __('Everyone')?></a></li>
			<?php if (!empty($cuser)): ?>
                        <li><a data-url="<?php echo $this->request->base?>/users/ajax_browse/friends" href="<?php echo $this->request->base?>/users"><?php echo __('My Friends')?></a></li>
                        <?php endif; ?>
            <?php if($loggedInUser['specialty'] != '1'): ?>
                <li><a data-url="<?php echo $this->request->base?>/users/ajax_browse/pharmacists" href="<?php echo $this->request->base?>/users"><?php echo __('Pharmacists in my Region')?></a></li>
            <?php else: ?>
                <li class="non-specialty"><a href="javascript:void(0);"><?php echo __('Pharmacists in my Region')?></a></li>
            <?php endif; ?>
            <?php if($loggedInUser['com_department'] == 'sales' && empty($loggedInUser['sale_area'])): ?>
                <li class="non-sales_com_department"><a href="javascript:void(0);"><?php echo __('Sales Reps in my Region')?></a></li>
            <?php elseif($loggedInUser['com_department'] == 'sales' && !empty($loggedInUser['sale_area'])): ?>
                <li><a data-url="<?php echo $this->request->base?>/users/ajax_browse/com_department" href="<?php echo $this->request->base?>/users"><?php echo __('Pharmacists in my Region')?></a></li>
            <?php elseif($loggedInUser['job_belong_to'] == 'pharmacy' || $loggedInUser['job_belong_to'] == 'hosp_pharmacy'): ?>
                <li><a data-url="<?php echo $this->request->base?>/users/ajax_browse/pharmacy_com_department" href="<?php echo $this->request->base?>/users"><?php echo __('Pharmacists in my Region')?></a></li>
            <?php else: ?>
                <li class="non-com_department"><a href="javascript:void(0);"><?php echo __('Sales Reps in my Region')?></a></li>
            <?php endif; ?>
		</ul>
            </div>
	</div>

        <?php echo $this->element('user/search_form'); ?>

<?php $this->end(); ?>

    <div class="bar-content">
        <div class="content_center full_content p_m_10">
        
            <div class="mo_breadcrumb">
                <h1><?php echo __('People')?></h1>
                <?php if ($uid && Configure::read("core.allow_invite_friend")):?>
	            	<a href="<?php echo $this->request->base?>/friends/ajax_invite?mode=model" data-target="#themeModal" data-toggle="modal" class="button button-action topButton button-mobi-top" data-dismiss="" data-backdrop="static" style=""><?php echo __('Invite Friends');?></a>
	            <?php endif;?>
            </div>
                        
            <ul class="users_list" id="list-content">
                    <?php 
                    if ( !empty( $values ) || !empty($online_filter) )
                            echo __('Loading...');
                    else
                            echo $this->element( 'lists/users_list', array( 'more_url' => '/users/ajax_browse/all/page:2' ) );
                    ?>
            </ul>
            <div class="clear"></div>
        </div>
    </div>

