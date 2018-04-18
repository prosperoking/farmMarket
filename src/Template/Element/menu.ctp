<nav class="navbar navbar-inverse" style="border-radius: 0">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="navbar-brand" href="/" title="Home"><i class="glyphicon glyphicon-home"> </i></a>
    </div>
     <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <?php if($this->request->session()->read('Auth.User')):?>
          
          
          <li>
              <a href="/myshopingcart"><i class="glyphicon glyphicon-shopping-cart"> </i> My Cart <i class="badge" id="cartno"><?= $noincart?></i></a>
          </li>
          
           <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"> </i><?= $this->request->session()->read('Auth.User')['username']?><span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li>
                  <a href="/myproducts"><i class="glyphicon glyphicon-grain"> </i> My Products</a>
              </li>
              <li>
                  <a><i class="glyphicon glyphicon-shopping-cart"> </i> Dashboard <span class="label label-danger"></span></a>
              </li>
              <li>
                  <?= $this->Html->link(__('Add Your Product'), ['controller'=>'products','action' => 'add']) ?>
              </li>
              <?php if($this->request->session()->read('Auth.User.usertype')==true):?>
              
              
              <li>
                  <?= $this->Html->Link('Add Category',['controller'=>'Categories','action'=>'add'])?>
              </li>
              <li>
                  <?= $this->Html->Link('Add Subcategory',['controller'=>'Subcategories','action'=>'add'])?>
              </li>
              <?php endif;?>
            <li><a href="/users/logout">Logout</a></li>
          </ul>
            <li>
              <a><i class="glyphicon glyphicon-comment"> </i> Messages <span class="badge">0</span></a>
          </li>
            <?php endif?>
      </ul>
         </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <li><a href="/products" title="All Products">All products</a></li>
        <?php foreach($categories as $cat):?>
          
       <?php if($cat['subcategories']==NULL){?>
          <li><a href="/products/category/<?= str_replace(' ', '-', $cat['name']).'-'.$cat['id']?>"><?= $cat['name']?></a></li>
       <?php }else{?>
        <li class="dropdown">
          <a href="/products/category/<?= str_replace(' ', '-', $cat['name']).'-'.$cat['id']?>" class="" role="button" aria-haspopup="true" aria-expanded="false"><?= $cat['name']?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php foreach ($cat['subcategories'] as $sub):?>
              <li><a href="/products/subcategory/<?= str_replace(' ', '-', $sub['name']).'-'.$sub['id']?>"><?= $sub['name']?></a></li>
              <?php endforeach;?>
          </ul></li>
       <?php }?> 
        <?php endforeach; ?>
           
           
      </ul>
    </div>
        
          
   
  </div><!-- /.container-fluid -->
</nav>