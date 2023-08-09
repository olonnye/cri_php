<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return static function (RouteBuilder $routes) {
    /*
     * The default class to use for all routes
     *
     * The following route classes are supplied with CakePHP and are appropriate
     * to set as the default:
     *
     * - Route
     * - InflectedRoute
     * - DashedRoute
     *
     * If no call is made to `Router::defaultRouteClass()`, the class used is
     * `Route` (`Cake\Routing\Route\Route`)
     *
     * Note that `Route` does not do any inflections on URLs which will result in
     * inconsistently cased URLs when used with `{plugin}`, `{controller}` and
     * `{action}` markers.
     */
    $routes->setRouteClass(DashedRoute::class);

    $routes->prefix("api", function (RouteBuilder $builder) {

        $builder->setExtensions(["json"]);
        /**
         * Customer Operations
         */
        $builder->connect("/add-customer", ["controller" => "Customer", "action" => "addCustomer"]);

        $builder->connect("/list-customers", ["controller" => "Customer", "action" => "listCustomers"]);

        $builder->connect("/update-customer/{id}", ["controller" => "Customer", "action" => "updateCustomer"])->setPass(["id"]);

        $builder->connect("/delete-customer/{id}", ["controller" => "Customer", "action" => "deleteCustomer"])->setPass(["id"]);
        /**
         * Description Operations
         */
        $builder->connect("/add-description", ["controller" => "Description", "action" => "addDescription"]);

        $builder->connect("/list-descriptions", ["controller" => "Description", "action" => "listDescriptions"]);

        $builder->connect("/update-description/{id}", ["controller" => "Description", "action" => "updateDescription"])->setPass(["id"]);

        $builder->connect("/delete-description/{id}", ["controller" => "Description", "action" => "deleteDescription"])->setPass(["id"]);
        /**
         * Kit Operations
         */
        $builder->connect("/add-kit", ["controller" => "Kit", "action" => "addKit"]);

        $builder->connect("/list-kits", ["controller" => "Kit", "action" => "listKits"]);

        $builder->connect("/update-kit/{id}", ["controller" => "Kit", "action" => "updateKit"])->setPass(["id"]);

        $builder->connect("/delete-kit/{id}", ["controller" => "Kit", "action" => "deleteKit"])->setPass(["id"]);
    });

    $routes->scope('/', function (RouteBuilder $builder) {
        /*
         * Here, we are connecting '/' (base path) to a controller called 'Pages',
         * its action called 'display', and we pass a param to select the view file
         * to use (in this case, templates/Pages/home.php)...
         */
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

        /*
         * ...and connect the rest of 'Pages' controller's URLs.
         */
        $builder->connect('/pages/*', 'Pages::display');

        /*
         * Connect catchall routes for all controllers.
         *
         * The `fallbacks` method is a shortcut for
         *
         * ```
         * $builder->connect('/{controller}', ['action' => 'index']);
         * $builder->connect('/{controller}/{action}/*', []);
         * ```
         *
         * You can remove these routes once you've connected the
         * routes you want in your application.
         */
        $builder->fallbacks();
    });

};
