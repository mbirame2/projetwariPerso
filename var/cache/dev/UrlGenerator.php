<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    '_twig_error_test' => [['code', '_format'], ['_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], []],
    'liste_partenaireliste_user' => [[], ['_controller' => 'App\\Controller\\PartenaireController::index'], [], [['text', '/api/liste_user']], [], []],
    'liste_partenaireliste_partenaire' => [[], ['_controller' => 'App\\Controller\\PartenaireController::inx'], [], [['text', '/api/liste_partenaire']], [], []],
    'liste_partenaireajout_partenaire' => [[], ['_controller' => 'App\\Controller\\PartenaireController::new'], [], [['text', '/api/ajout_partenaire']], [], []],
    'liste_partenairemodifier_partenaire' => [['id'], ['_controller' => 'App\\Controller\\PartenaireController::update'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/api/partenaire']], [], []],
    '_apiap' => [[], ['_controller' => 'App\\Controller\\SecurityController::ajoutCaissier'], [], [['text', '/api/register/caissier']], [], []],
    '_apiapp_reg' => [[], ['_controller' => 'App\\Controller\\SecurityController::superadminwari'], [], [['text', '/api/register/superadminpartenaire']], [], []],
    '_apiapp_re' => [[], ['_controller' => 'App\\Controller\\SecurityController::userpartenaire'], [], [['text', '/api/register/userpartenaire']], [], []],
    '_apitoken' => [[], ['_controller' => 'App\\Controller\\SecurityController::index'], [], [['text', '/api/login']], [], []],
    '_apiapp_logout' => [[], ['_controller' => 'App\\Controller\\SecurityController::logout'], [], [['text', '/api/logout']], [], []],
    '_apistatus' => [['id'], ['_controller' => 'App\\Controller\\SecurityController::stas'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/partenaire/bloquer_partenaire']], [], []],
    '_apicontrat' => [[], ['_controller' => 'App\\Controller\\SecurityController::stat'], [], [['text', '/api/contrat']], [], []],
    '_apitranfert' => [[], ['_controller' => 'App\\Controller\\TranfertController::index'], [], [['text', '/api/envoieargent']], [], []],
    '_apitranfertok' => [[], ['_controller' => 'App\\Controller\\TranfertController::retrait'], [], [['text', '/api/retraitargent']], [], []],
    '_apitranfe' => [[], ['_controller' => 'App\\Controller\\TranfertController::tes'], [], [['text', '/api/retrait_test']], [], []],
    'list_des_versements' => [[], ['_controller' => 'App\\Controller\\VersementController::index'], [], [['text', '/api/versement']], [], []],
    'ajout_versement' => [[], ['_controller' => 'App\\Controller\\VersementController::ajout'], [], [['text', '/api/ajout_versement']], [], []],
    'api_entrypoint' => [['index', '_format'], ['_controller' => 'api_platform.action.entrypoint', '_format' => '', '_api_respond' => 'true', 'index' => 'index'], ['index' => 'index'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', 'index', 'index', true], ['text', '/api']], [], []],
    'api_doc' => [['_format'], ['_controller' => 'api_platform.action.documentation', '_format' => '', '_api_respond' => 'true'], [], [['variable', '.', '[^/]++', '_format', true], ['text', '/api/docs']], [], []],
    'api_jsonld_context' => [['shortName', '_format'], ['_controller' => 'api_platform.jsonld.action.context', '_format' => 'jsonld', '_api_respond' => 'true'], ['shortName' => '.+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '.+', 'shortName', true], ['text', '/api/contexts']], [], []],
    'api_comptes_get_collection' => [['_format'], ['_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_collection_operation_name' => 'get'], [], [['variable', '.', '[^/]++', '_format', true], ['text', '/api/comptes']], [], []],
    'api_comptes_post_collection' => [['_format'], ['_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_collection_operation_name' => 'post'], [], [['variable', '.', '[^/]++', '_format', true], ['text', '/api/comptes']], [], []],
    'api_comptes_get_item' => [['id', '_format'], ['_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_item_operation_name' => 'get'], [], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '[^/\\.]++', 'id', true], ['text', '/api/comptes']], [], []],
    'api_comptes_delete_item' => [['id', '_format'], ['_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_item_operation_name' => 'delete'], [], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '[^/\\.]++', 'id', true], ['text', '/api/comptes']], [], []],
    'api_comptes_put_item' => [['id', '_format'], ['_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_item_operation_name' => 'put'], [], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '[^/\\.]++', 'id', true], ['text', '/api/comptes']], [], []],
    'api_partenaires_get_collection' => [['_format'], ['_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Partenaire', '_api_collection_operation_name' => 'get'], [], [['variable', '.', '[^/]++', '_format', true], ['text', '/api/partenaires']], [], []],
    'api_partenaires_post_collection' => [['_format'], ['_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Partenaire', '_api_collection_operation_name' => 'post'], [], [['variable', '.', '[^/]++', '_format', true], ['text', '/api/partenaires']], [], []],
    'api_partenaires_get_item' => [['id', '_format'], ['_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Partenaire', '_api_item_operation_name' => 'get'], [], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '[^/\\.]++', 'id', true], ['text', '/api/partenaires']], [], []],
    'api_partenaires_delete_item' => [['id', '_format'], ['_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Partenaire', '_api_item_operation_name' => 'delete'], [], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '[^/\\.]++', 'id', true], ['text', '/api/partenaires']], [], []],
    'api_partenaires_put_item' => [['id', '_format'], ['_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Partenaire', '_api_item_operation_name' => 'put'], [], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '[^/\\.]++', 'id', true], ['text', '/api/partenaires']], [], []],
    'api_versements_get_collection' => [['_format'], ['_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Versement', '_api_collection_operation_name' => 'get'], [], [['variable', '.', '[^/]++', '_format', true], ['text', '/api/versements']], [], []],
    'api_versements_post_collection' => [['_format'], ['_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Versement', '_api_collection_operation_name' => 'post'], [], [['variable', '.', '[^/]++', '_format', true], ['text', '/api/versements']], [], []],
    'api_versements_get_item' => [['id', '_format'], ['_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Versement', '_api_item_operation_name' => 'get'], [], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '[^/\\.]++', 'id', true], ['text', '/api/versements']], [], []],
    'api_versements_delete_item' => [['id', '_format'], ['_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Versement', '_api_item_operation_name' => 'delete'], [], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '[^/\\.]++', 'id', true], ['text', '/api/versements']], [], []],
    'api_versements_put_item' => [['id', '_format'], ['_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Versement', '_api_item_operation_name' => 'put'], [], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '[^/\\.]++', 'id', true], ['text', '/api/versements']], [], []],
];
