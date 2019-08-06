<?php

/*
 * Copyright (c) SocialLOFT LLC
 * mooSocial - The Web 2.0 Social Network Software
 * @website: http://www.moosocial.com
 * @author: mooSocial
 * @license: https://moosocial.com/license/
 */
App::uses('Component', 'Controller');

class SocialPublisherComponent extends Component {

    public function initialize(Controller $controller) {
        // Load model
    }
  
    public function socialLogout($provider) {
        App::import('Lib/SocialIntegration', 'Auth');
        App::import('Lib/SocialIntegration', 'Storage');

        $storage = new SocialIntegration_Storage();

        // Check if SocialIntegration_Auth session already exist
        if (!$storage->config("CONFIG")) {
            header("HTTP/1.0 404 Not Found");
            die("You cannot access this page directly.");
        }

        SocialIntegration_Auth::initialize($storage->config("CONFIG"));

        $hauth = SocialIntegration_Auth::setup($provider);
        $hauth->adapter->initialize();
        $hauth->adapter->logout();
    }
    
   public function getSocialProvidersConfigs() {
        
        $providers_key = array('facebook', 'google','twitter');

        // Default config
        $config = array(
            "base_url" => "http://localhost/social/auths/endpoint/google",
            "providers" => array(
                "Facebook" => array(
                    "enabled" => false,
                ),
                "Google" => array(
                    "enabled" => false,
                    "access_type" => "offline", // optional
                    "approval_prompt" => "force", // optional
                ),
                "Twitter" => array(
                    "enabled" => false,
                )
        ));

        foreach ($providers_key as $key) {
            $provider_name = ucfirst($key);

            $config['providers'][$provider_name]['enabled'] = true;
            // Set key and secret
            $config['providers'][$provider_name]['keys'] = array(
                'id' => Configure::read(ucfirst($key) . 'Integration.' . $key . '_app_id'),
                'secret' => Configure::read(ucfirst($key) . 'Integration.' . $key . '_app_secret'),
            );
            $config['providers'][$provider_name]['scope'] = Configure::read(ucfirst($key) . 'Integration.' . $key . '_app_scope');
            $config['providers'][$provider_name]['redirect_uri'] = Configure::read(ucfirst($key) . 'Integration.' . $key . '_app_return_url');
        }
        
        return $config;
    }
}
   
    
