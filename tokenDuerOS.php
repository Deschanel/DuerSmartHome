<?php
require_once __DIR__.'/serverDuerOS.php';
$_POST['grant_type']=$_GET['grant_type'];
$_POST['code']=$_GET['code'];
$_POST['redirect_uri']=$_GET['redirect_uri'];
$_POST['client_id']=$_GET['client_id'];
$_POST['client_secret']=$_GET['client_secret'];
$server = new OAuth2\Server($storage);
$server->addGrantType(new OAuth2\GrantType\AuthorizationCode($storage));
#$server->handleTokenRequest(OAuth2\Request::createFromGlobals())->send();
$server->handleTokenRequest(OAuth2\Request::createFromGlobals(), new OAuth2\Response())->send();

