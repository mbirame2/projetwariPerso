<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'security.logout_listener.login' shared service.

include_once $this->targetDirs[3].'/vendor/symfony/security-http/Firewall/ListenerInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/security-http/Firewall/LegacyListenerTrait.php';
include_once $this->targetDirs[3].'/vendor/symfony/security-http/Firewall/LogoutListener.php';

$this->privates['security.logout_listener.login'] = $instance = new \Symfony\Component\Security\Http\Firewall\LogoutListener(($this->services['security.token_storage'] ?? ($this->services['security.token_storage'] = new \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage())), ($this->privates['security.http_utils'] ?? $this->load('getSecurity_HttpUtilsService.php')), ($this->privates['security.logout.success_handler.login'] ?? $this->load('getSecurity_Logout_SuccessHandler_LoginService.php')), ['csrf_parameter' => '_csrf_token', 'csrf_token_id' => 'logout', 'logout_path' => 'app_logout']);

$instance->addHandler(($this->privates['security.logout.handler.csrf_token_clearing'] ?? $this->load('getSecurity_Logout_Handler_CsrfTokenClearingService.php')));

return $instance;
