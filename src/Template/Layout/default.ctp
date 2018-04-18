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
if(!isset($pageDescription)):
$pageDescription = ' - Farm Product Market place';
endif;
if(!isset($title)):
$title = '';
endif
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
         <?= $title ?>
        <?= $pageDescription ?>
      
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('font-awesome.min.css') ?>
     <?= $this->Html->css('animate.css') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    
    <?= $this->fetch('pagecss')?>

    <?= $this->fetch('meta') ?>
    
</head>
<body>
    <div id="flashmsg"><?= $this->Flash->render() ?>  </div>
        
    <header>
        <div class="header-title">
            <span ><?= $title ?></span><span><?= $this->element('search')?></span>
        </div>
        
        <div class="header-help">
            <?php if(!($this->request->session()->read('Auth.User'))):?>
            <span><a href="/login">Login</a></span>
            <?php endif;?>
            <?php if($this->request->session()->read('Auth.User')):?>
            <span><a href="/myproducts"><i class="glyphicon glyphicon-grain"> </i> My Products</a></span>
            <span><a><i class="glyphicon glyphicon-shopping-cart"> </i> Dashboard <span class="label label-danger"></span></a></span>
            <?php endif;?>
            <span><a href="/about_us">About Us</a></span>
           
        </div>
    </header>
    <?= $this->element('menu',[
        'categories'=>$categ
    ])?>
    <div id="container">

        <div id="content">
          

            <div class="row">
                <?= $this->fetch('content') ?>
            </div>
        </div>
        <footer>
            
        </footer>
        </div>
        <?php echo $this->Html->script(['jquery-2.1.4.min','bootstrap','jquery.scrollUp.min',
            ]);?>
        <?= $this->fetch('pagescript')?>
        
       
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
