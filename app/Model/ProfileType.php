<?php

/*
 * Copyright (c) SocialLOFT LLC
 * mooSocial - The Web 2.0 Social Network Software
 * @website: http://www.moosocial.com
 * @author: mooSocial
 * @license: https://moosocial.com/license/
 */

class ProfileType extends AppModel {
	    
    public $order = 'ProfileType.order asc';

	public $validate = array(	
							'name' => 	array( 	 
								'rule' => 'notBlank',
								'message' => 'Name is required'
							)							
	);
}