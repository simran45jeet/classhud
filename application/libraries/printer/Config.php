<?php
    
    $redirectConfig = array(
        'client_id' 	=> '824842367493-sp2kqbhn6hc36bhbgqnjhjnfbao6qgnr.apps.googleusercontent.com',
        'redirect_uri' 	=> 'http://localhost/manwar/pos/new_auth',
        'response_type' => 'code',
        'scope'         => 'https://www.googleapis.com/auth/cloudprint',
    );
    
    $authConfig = array(
        'code' => '',
        'client_id' 	=> '824842367493-sp2kqbhn6hc36bhbgqnjhjnfbao6qgnr.apps.googleusercontent.com',
        'client_secret' => 'zOmLZAFwprD-cG0dT93AjdAo',
        'redirect_uri' 	=> 'http://localhost/manwar/pos/new_auth',
        "grant_type"    => "authorization_code"
    );
    
    $offlineAccessConfig = array(
        'access_type' => 'offline'
    );
    
    $refreshTokenConfig = array(
        
        'refresh_token' => "",
        'client_id'     => $authConfig['client_id'],
        'client_secret' => $authConfig['client_secret'],
        'grant_type'    => "refresh_token" 
    );
    
    $urlconfig = array(	
        'authorization_url' 	=> 'https://accounts.google.com/o/oauth2/auth',
        'accesstoken_url'   	=> 'https://accounts.google.com/o/oauth2/token',
        'refreshtoken_url'      => 'https://www.googleapis.com/oauth2/v3/token'
    );
    
?>
