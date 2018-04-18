<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\Router;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass('Route');

Router::scope('/', function ($routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
    $routes->connect('/logout',['controller'=>'Users','action'=>'logout']);
    $routes->connect('/about_us',['controller'=>'Users','action'=>'about']);
    $routes->connect('/login',['controller'=>'Users','action'=>'login']);
    $routes->connect('/register',['controller'=>'Users','action'=>'register']);
    $routes->connect('/admin',['controller'=>'Pages','action' => 'display', 'home']);
    $routes->connect('/myproducts',['controller'=>'Products','action' => 'myproducts']);
    $routes->connect('/addproduct',['controller'=>'Products','action' => 'add']);
    $routes->connect('/myshopingcart',['controller'=>'Carts','action' => 'index']);
    $routes->connect(
        '/products/:filter/:name-:id', 
        ['controller' => 'Products', 'action' => 'index'],
        [
            // Define the route elements in the route template
            // to pass as function arguments. Order matters since this
            // will simply map ":id" to $articleId in your action
            'pass' => ['filter','id', 'name'],
            // Define a pattern that `id` must match.
            'id' => '[0-9]+'
        ]
    );
    $routes->connect(
        '/products/view/:title/:id', 
        ['controller' => 'Products', 'action' => 'view'],
        [
            // Define the route elements in the route template
            // to pass as function arguments. Order matters since this
            // will simply map ":id" to $articleId in your action
            'pass' => ['title','id'],
            // Define a pattern that `id` must match.
            'id' => '[0-9]+'
        ]
    );
    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `InflectedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'InflectedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'InflectedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks('InflectedRoute');
});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
/**
 * admin routes
 */
Router::prefix('admin', function ($routes) {
    // All routes here will be prefixed with `/admin`
    // And have the prefix => admin route element added.
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'index']);
    $routes->fallbacks('DashedRoute');
});