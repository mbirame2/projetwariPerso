<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/liste_user' => [[['_route' => 'liste_partenaireliste_user', '_controller' => 'App\\Controller\\PartenaireController::index'], null, ['GET' => 0], null, false, false, null]],
        '/api/liste_partenaire' => [[['_route' => 'liste_partenaireliste_partenaire', '_controller' => 'App\\Controller\\PartenaireController::inx'], null, ['GET' => 0], null, false, false, null]],
        '/api/ajout_partenaire' => [[['_route' => 'liste_partenaireajout_partenaire', '_controller' => 'App\\Controller\\PartenaireController::new'], null, ['POST' => 0], null, false, false, null]],
        '/api/register/caissier' => [[['_route' => '_apiap', '_controller' => 'App\\Controller\\SecurityController::ajoutCaissier'], null, ['POST' => 0], null, false, false, null]],
        '/api/register/superadminpartenaire' => [[['_route' => '_apiapp_reg', '_controller' => 'App\\Controller\\SecurityController::superadminwari'], null, ['POST' => 0], null, false, false, null]],
        '/api/register/userpartenaire' => [[['_route' => '_apiapp_re', '_controller' => 'App\\Controller\\SecurityController::userpartenaire'], null, ['POST' => 0], null, false, false, null]],
        '/api/login' => [[['_route' => '_apitoken', '_controller' => 'App\\Controller\\SecurityController::index'], null, ['POST' => 0], null, false, false, null]],
        '/api/logout' => [[['_route' => '_apiapp_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, ['GET' => 0], null, false, false, null]],
        '/api/contrat' => [[['_route' => '_apicontrat', '_controller' => 'App\\Controller\\SecurityController::stat'], null, ['GET' => 0], null, false, false, null]],
        '/api/envoieargent' => [[['_route' => '_apitranfert', '_controller' => 'App\\Controller\\TranfertController::index'], null, ['POST' => 0], null, false, false, null]],
        '/api/retraitargent' => [[['_route' => '_apitranfertok', '_controller' => 'App\\Controller\\TranfertController::retrait'], null, ['POST' => 0], null, false, false, null]],
        '/api/retrait_test' => [[['_route' => '_apitranfe', '_controller' => 'App\\Controller\\TranfertController::tes'], null, ['POST' => 0], null, false, false, null]],
        '/api/versement' => [[['_route' => 'list_des_versements', '_controller' => 'App\\Controller\\VersementController::index'], null, ['GET' => 0], null, false, false, null]],
        '/api/ajout_versement' => [[['_route' => 'ajout_versement', '_controller' => 'App\\Controller\\VersementController::ajout'], null, ['POST' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api(?'
                    .'|/(?'
                        .'|api/partenaire/([^/]++)(*:76)'
                        .'|partenaire/bloquer_partenaire/([^/]++)(*:121)'
                    .')'
                    .'|(?:/(index)(?:\\.([^/]++))?)?(*:158)'
                    .'|/(?'
                        .'|docs(?:\\.([^/]++))?(*:189)'
                        .'|co(?'
                            .'|ntexts/(.+)(?:\\.([^/]++))?(*:228)'
                            .'|mptes(?'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:262)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:300)'
                                .')'
                            .')'
                        .')'
                        .'|partenaires(?'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:343)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:381)'
                            .')'
                        .')'
                        .'|versements(?'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:422)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:460)'
                            .')'
                        .')'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        76 => [[['_route' => 'liste_partenairemodifier_partenaire', '_controller' => 'App\\Controller\\PartenaireController::update'], ['id'], ['PUT' => 0], null, false, true, null]],
        121 => [[['_route' => '_apistatus', '_controller' => 'App\\Controller\\SecurityController::stas'], ['id'], ['PUT' => 0], null, false, true, null]],
        158 => [[['_route' => 'api_entrypoint', '_controller' => 'api_platform.action.entrypoint', '_format' => '', '_api_respond' => 'true', 'index' => 'index'], ['index', '_format'], null, null, false, true, null]],
        189 => [[['_route' => 'api_doc', '_controller' => 'api_platform.action.documentation', '_format' => '', '_api_respond' => 'true'], ['_format'], null, null, false, true, null]],
        228 => [[['_route' => 'api_jsonld_context', '_controller' => 'api_platform.jsonld.action.context', '_format' => 'jsonld', '_api_respond' => 'true'], ['shortName', '_format'], null, null, false, true, null]],
        262 => [
            [['_route' => 'api_comptes_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_comptes_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        300 => [
            [['_route' => 'api_comptes_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_comptes_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_comptes_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        343 => [
            [['_route' => 'api_partenaires_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Partenaire', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_partenaires_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Partenaire', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        381 => [
            [['_route' => 'api_partenaires_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Partenaire', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_partenaires_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Partenaire', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_partenaires_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Partenaire', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        422 => [
            [['_route' => 'api_versements_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Versement', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_versements_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Versement', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        460 => [
            [['_route' => 'api_versements_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Versement', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_versements_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Versement', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_versements_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Versement', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
