<?php

$bday_month = '';
$bday_day = '';
$bday_year = '';
if (!empty($cuser['birthday']))
{
    $birthday = explode('-', $cuser['birthday']);
    $bday_year = $birthday[0];
    $bday_month = $birthday[1];
    $bday_day = $birthday[2];
}
?>
<div class="bar-content">
    <div class="content_center full_content p_m_10 register_main_form" id="regForm">
        <div class="mo_breadcrumb">
            <h1><?php echo __('Join Pharmatalk')?></h1>
        </div>

        <form id="form_reg_step_2">
            <div class="form-group required">
                <label class="col-md-3 control-label" for="avatar">
                    <?php echo __('Profile Picture')?>
                </label>
                <div class="col-md-9 form-inline">
                    <div id="profile_picture"></div>
                    <div id="profile_picture_preview">
                        <?php if(!empty($cuser['avatar'])):?>
                            <img style="" src="<?php echo $this->Moo->getImageUrl(array('User' => $cuser), array('prefix' => '600'))?>" />
                        <?php else:?>
                            <img style="display: none;" src="" />
                        <?php endif;?>
                        <input type="hidden" id="avatar" name="avatar" value="<?php echo $cuser['avatar'];?>" />
                    </div>
                </div>
                <div class="clear"></div>
            </div>

            <?php $show_birthday_signup = Configure::read('core.show_birthday_signup');
            if ( !empty($show_birthday_signup) ): ?>
                <div class="form-group required">
                    <label class="control-label col-md-3" for="birthday">
                        <?php echo __('Birthday')?><a href="javascript:void(0)" class="tip" title="<?php echo __('Only month and date will be shown on your profile')?>">(?)</a>
                    </label>
                    <div class="col-md-9 form-inline">
                        <div class="col-xs-4">
                            <?php echo $this->Form->month('birthday',array('class'=>'form-control','value' => $bday_month))?>
                        </div>
                        <div class="col-xs-4">
                            <div class="p_l_2">
                                <?php echo $this->Form->day('birthday',array('class'=>'form-control', 'value' => $bday_day))?>
                            </div>

                        </div>
                        <div class="col-xs-4">
                            <?php echo $this->Form->year('birthday', 1930, date('Y'),array('class'=>'form-control', 'value' => $bday_year))?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>

            <?php endif; ?>

            <?php $show_gender_signup = Configure::read('core.show_gender_signup');
            if ( !empty($show_gender_signup) ): ?>
                <div class="form-group required">
                    <label class="col-md-3 control-label" for="gender">
                        <?php echo __('Gender')?>
                    </label>
                    <div class="col-md-9 ">
                        <?php echo $this->Form->radio('gender', $this->Moo->getGenderList(), array('class' => '', 'label' => true, 'value' => $cuser['gender'] ? $cuser['gender'] : 'Male','hiddenField'=>true, 'legend'=> false, 'separator'=>'&nbsp;&nbsp;&nbsp;')); ?>
                    </div>
                    <div class="clear"></div>
                </div>
            <?php endif; ?>
            <?php $show_about_signup= Configure::read('core.show_about_signup');
            if ( !empty($show_about_signup) ): ?>
                <div class="form-group required">
                    <label class="col-md-3 control-label" for="gender">
                        <?php echo __('About')?>
                    </label>
                    <div class="col-md-9 ">
                        <?php echo $this->Form->textarea('about',array('class'=>'form-control')); ?>
                    </div>
                    <div class="clear"></div>
                </div>
            <?php endif;?>
            <?php if(isset($cbPackage) && $cbPackage != null):?>
                <div class="form-group required">
                    <label class="col-md-3 control-label" for="Package">
                        <?php echo __('Package')?>
                    </label>
                    <div class="col-md-9 ">
                        <?php echo $this->Form->input('package_id', array(
                            'options' => $cbPackage,
                            'label' => false,
                        ));
                        ?>
                        <a href="<?php echo $this->request->base;?>/subscription/subscribes/compare" title="Compare Subscription" data-target="#themeModal" data-toggle="modal">Click here to learn more about our membership</a>
                    </div>
                    <div class="clear"></div>
                </div>
            <?php endif;?>
            <?php
            echo $this->element( 'custom_fields', array( 'show_heading' => true ) );
            ?>
            <?php if ($isGatewayEnabled && $packages): ?>
                <?php 	$helper = MooCore::getInstance()->getHelper('Subscription_Subscription');    ?>
                <h3 class="page-header"><?php echo __('Membership')?></h3>
                <div class="form-group required">
                    <div id="content_package" style="display:none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="title-modal">
                                    <?php echo __('Subscription Plans')?>
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span></button>
                                </div>
                                <?php
                                $element = (Configure::read('Subscription.select_theme_subscription_packages') ? 'Subscription.theme_compare' : 'Subscription.theme_default');
                                ?>
                                <?php echo $this->element($element,array('compares'=>$compare,'columns'=>$packages,'type'=>'register'));?>
                            </div>
                        </div>
                    </div>
                    <script>
                        $('#plan-view').html($('#content_package').html());
                        $('#content_package').remove();

                        var first = false;
                        $('.button_select').click(function(){
                            $('#plan-view').modal('hide');
                            package_id = $(this).attr('ref');
                            $('#select-plan').val($('.package_register_'+package_id).val());
                        });
                        $('#plan-view').on('shown.bs.modal',function (e) {
                            if (first)
                                return;
                            first = true;
                            $('.compare-register .content').attr('style','');
                            max = 0;
                            $('.compare-register .content').each(function(e){
                                if ($(this).height() > max)
                                    max = $(this).height();
                            });
                            $('.compare-register .content').each(function(e){
                                if ($(this).css('padding-top'))
                                {
                                    $(this).css('height',parseInt($(this).css('padding-top').replace("px", "")) + parseInt($(this).css('padding-bottom').replace("px", "")) + max + 10);
                                }
                            });
                        });

                    </script>
                    <label for="timezone" class=" col-md-3 control-label"><?php echo __('Membership')?></label>
                    <div class="col-md-9 ">
                        <select id="select-plan" name="plan_id">
                            <?php
                            foreach ($packages as $package):
                                $plans = $package['SubscriptionPackagePlan'];
                                if (!count($plans))
                                    continue;
                                $package = $package['SubscriptionPackage'];
                                $plan = array();
                                if(!empty($plans)){
                                    $plan = $plans[0];
                                }
                                ?>
                                <optgroup label="<?php echo $package['name'] ?>">
                                    <?php foreach($plans as $index => $plan): ?>
                                        <?php $plan = $plan['SubscriptionPackagePlan']?>
                                        <option <?php if($index == 0 && $package['default'] == 1) echo 'selected'; ?>  value="<?php echo $plan['id']?>"><?php echo $package['name']. ' - '. $helper->getPlanDescription($plan,$currency['Currency']['currency_code'])?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                                <?php
                            endforeach;
                            ?>

                        </select>
                    </div>
                    <label for="timezone" class="col-md-3  control-label"></label>
                    <div class=" col-md-9 ">
                        <?php
                        echo $this->Html->link(__('Click here to learn more about our memberships.'),
                            '#',
                            array(
                                'data-target' => '#plan-view',
                                'data-toggle' => 'modal'
                            ));
                        ?>
                    </div>

                </div>
            <?php endif; ?>

        <div class="form-group required">
            <label class="col-md-3 control-label">
                <?php echo __('Specialty')?>
            </label>
            <div class="col-md-9 form-inline">
                <input type="hidden" name="data[specialty]" id="_" value="">
                <?php echo $this->Form->radio('specialty', array(SPECIALTY_PHARMACIST => __('Pharmacist'), SPECIALTY_STUDENT => __('Student'), SPECIALTY_OTHER=>__('Others')), array('class' => 'specialty','id' => false, 'label' => true, 'value' => $cuser['specialty'],'hiddenField'=>true, 'legend'=> false, 'separator'=>'&nbsp;&nbsp;&nbsp;')); ?>
            </div>
            <div class="clear"></div>
        </div>
        <div id="university_info" style="<?php echo $univ_style ;?>">
            <div class="form-group required">
                <label class="col-md-3 control-label">
                    <?php echo __('University')?>
                </label>
                <div class="col-md-9 form-inline">
                    <input type="hidden" name="data[university_id]" id="_" value="">
                    <?php $i = 0; foreach($universities as $university):?>
                        <div class="col-md-3">
                            <input type="radio" name="data[university_id]" <?php echo ($cuser['university_id'] == $university['University']['code'] || (empty($cuser['university_id']) && empty($cuser['university']) && $i == 0)) ? 'checked' : '';?> id="univ_<?php echo $university['University']['id'];?>" value="<?php echo $university['University']['code'];?>" class="">
                            <label for="univ_<?php echo $university['University']['id'];?>"><?php echo $university['University'][$uniField];?></label>
                        </div>
                    <?php $i++; endforeach;?>
                    <div class="clear"></div>
                    <div><?php echo __('Please type in (Pharmacist who graduated other university)');?></div>
                    <?php echo $this->Form->text('university', array('value' => $cuser['university']));?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="form-group required">
                <label class="col-md-3 control-label">
                    <?php echo __('Admission year')?>
                </label>
                <div class="col-md-9 form-inline">
                    <?php echo $this->Form->text('admission_year', array('value' => $cuser['admission_year'])); ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="form-group required">
            <label class="col-md-3 control-label">
                <?php echo __('Mob.No')?>
            </label>
            <div class="col-md-9 form-inline">
                <?php echo $this->Form->text('mobile', array('value' => $cuser['mobile'],'type' => 'text','oninput' => 'this.value=this.value.replace(/[^0-9]/g,"");')); ?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="form-group required">
            <label class="col-md-3 control-label">
                <?php echo __('Sub email')?>
            </label>
            <div class="col-md-3 form-inline">
                <?php echo $this->Form->text('sub_mail', array('value' => $cuser['sub_mail'])); ?>
            </div>
            <div class="col-md-6 form-inline">
                <div class="col-md-2 control-label">
                    <?php echo __('Mailing to')?>
                </div>
                <div class="col-md-10">
                    <input type="radio" name="data[mail_to]" id="pri_mail" value="<?php echo $cuser['email'];?>" <?php echo ($cuser['mail_to'] == $cuser['email'] || empty($cuser['mail_to'])) ? 'checked' : '';?>>
                    <label for="pri_mail"><?php echo $cuser['email'];?></label><br/>
                    <input type="radio" name="data[mail_to]" id="sub_mail_to" value="<?php echo $cuser['sub_mail'];?>" <?php echo ($cuser['mail_to'] == $cuser['sub_mail'] && !empty($cuser['mail_to'])) ? 'checked' : '';?>>
                    <label for="sub_mail_to" id="sub_mail_txt"><?php echo $cuser['sub_mail'] != '' ? $cuser['sub_mail'] : __('Sub email');?></label>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="form-group required">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-9 form-inline">
               <a class="btn btn-action" id="btn_submit_step_2"><?php echo __('Next');?></a>
            </div>
            <div class="clear"></div>
        </div>
            <div class="error-message" style="display:none;"></div>
        </form>
    </div>
</div>

<?php if($this->request->is('ajax')): ?>
    <script type="text/javascript">
        require(["jquery","mooUser"], function($,mooUser) {
            mooUser.initRegStep2();
        });
    </script>
<?php else: ?>
    <?php $this->Html->scriptStart(array('inline' => false, 'domReady' => true, 'requires'=>array('jquery','mooUser'), 'object' => array('$','mooUser'))); ?>
    mooUser.initRegStep2();
    <?php $this->Html->scriptEnd(); ?>
<?php endif; ?>