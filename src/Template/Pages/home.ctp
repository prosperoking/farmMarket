<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;
/*
if (!Configure::read('debug')):
    throw new NotFoundException();
endif;
*/
$cakeDescription = 'Farm Product Market place: Start selling your product and services now';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('waves.min.css') ?>
    <?= $this->Html->css(['prettyPhoto','main','font-awesome.min']);?>
    <style >
        header {
            background-image: url('img/horizont3.jpg');
            background-position-y: 1300px;
            moz-background-position-y: 1340px;
            
        }
        .navbar {
                margin-bottom: 0px;
                }
    </style>
</head>
<body class="home">
   <div id="flashmsg"><?= $this->Flash->render() ?>  </div>
    <header>
        <div class="header-image">
            <?= $this->Html->image('logo.png',['style'=>'height:150px;width:200px;']) ?>
            <h1>Get your products ready for sale
            </h1>
            <?php if(!($this->request->session()->read('Auth.User'))):?>
            <h3>
                 <a href="/users/" class="btn btn-lg btn-warning" >Register <span class="glyphicon glyphicon-registration-mark"></span></a> or 
                 <a href="/users/login" class="btn btn-lg btn-success" >login <span class="glyphicon glyphicon-log-in"></span></a>
                     
            </h3>
            <?php endif?>
            <?php echo $this->form->create(null,['url'=>['controller'=>'products','action'=>'search'],
                'id'=>'search',
                'type'=>'get'
                ]);
           ?> 
            <div id="searchcont" >
        <?php echo $this->Form->input(Null, ['type' => 'search','id'=>'searchtext','name'=>'q','placeholder'=>'Search for an item']);?>
                <?php echo $this->Form->button('Search', ['type' => 'submit', 'id'=>'csearchbtn']);?>
                <div id="ajaxsearch"></div>
               <?php echo $this->form->end();?>
            </div>
            
            
           
            
            
        </div>
        
        
    </header>
          <?= $this->element('menu',[
        'categories'=>$categ
    ]); ?>
    <div id="content">
        
              
        <div class="row" style="margin-top: 10px;">
            
            <div class="col-sm-9">   
        <?php foreach ($product as $products): ?>
       <?= $this->element('products',[
           'prod'=>$products
       ])?>
        <?php endforeach; ?>
            </div>
            <div class="col-sm-3">
                
            </div>
        </div>
        
       

        <hr/>
       
    </div>
    <footer>
        <div class="row">
            <div class="columns large-12  database checks">
               Farm Product Market Place copyright 2016.
            </div>
        </div>
    </footer>
    <?php echo $this->Html->script(['jquery-2.1.4.min','bootstrap','waves.min','jquery.scrollUp.min','jquery.toast.min','main']);?>
   
    <script>
            $(document).ready(function() {
                $('.nav li.dropdown').hover(function() {
                    $(this).addClass('open');
                }, function() {
                    $(this).removeClass('open');
                });
               $(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
		
	
            });
        </script>
</body>
</html>
<?= $this->Html->css(['prettyPhoto','main','jquery.toast.min']);?>