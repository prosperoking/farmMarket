<nav class="large-2 medium-2 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('') ?></li>
        
        
        <li><?= $this->Html->link(__('View more Products'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Add a Product'), ['action' => 'add']) ?> </li>
        
    </ul>
</nav>
<div class="products view large-10 medium-10 columns content">
    <h3><?= h($product->title) ?></h3>
    <div class="col-sm-12">
<div class="product-details"><!--product-details-->
        <div class="col-sm-5">
                <div class="view-product">
                        <img src="<?= h($product->image) ?>" alt="<?= __($product->title)?>" />

                </div>
        </div>
        <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->
                        <h2><?= h($product->title) ?></h2>
                        <p><?= __('Product Id')?>:<?= h($product->id) ?></p>
                        <span style="width: 100%">
                            <?= $this->form->create(null,[
                                                        'url'=>['controller'=>'cart','action'=>'add']

                                                        ])?>
                            <span >₦<?= h($product->prize) ?></span>
                                <label>Quantity:</label>
                                <input name='quantity' type="number" value="1" min="1" required/>
                                <input type="hidden" value="<?= $product->id ?>" name="product_id"/>
                                <button type="button" class="btn btn-fefault cart" >
                                        <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                </button>
                                <?= $this->form->end()?>
                        </span>
                        <p><b>Category:</b><?= $product->category->name?></p>
                        <p><b>Subcategory:</b> <?= $product->subcategory->name?></p>
                        <p><b>Seller:</b> <?= $product->user->username ?></p>

                </div><!--/product-information-->
        </div>
</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
        <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab"><?= __('Details')?></a></li>
                        <li><a href="#companyprofile" data-toggle="tab"><?= __('Sellers Info')?></a></li>
                        <li><a href="#tag" data-toggle="tab"><?= __('Other Products by Seller')?></a></li>

                </ul>
        </div>
        <div class="tab-content ">
                <div class="tab-pane fade active in " id="details" >
                    <div class="col-sm-12" style="padding: 20px;">

                                                        <?= $this->Text->autoParagraph(h($product->description)); ?>

                        </div>

                </div>

                <div class="tab-pane fade" id="companyprofile" >
                        <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                        <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <p><b><?= __('First Name:')?></b><?= __($product->user->firstname)?></p>
                                                    <p><b><?= __('Last Name:')?></b><?= __($product->user->lastname)?></p>
                                                    <p><b><?= __('Other Names:')?></b><?= __($product->user->othername)?></p>
                                                    <p><b><?= __('Phone:')?></b><?= __($product->user->phone)?></p>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                        <div class="single-products">
                                                <div class="productinfo text-center">
                                                        <img src="/<?= __($product->user->imageprof)?>" alt="" />
                                                        
                                                       <a href="/users/<?= $product->user->username?>" style="display: inline-block;">
                                                           <i class="fa fa-plus-square"></i><?= __('View Profile') ?>
                                                       </a> 
                                                       
                                                </div>
                                        </div>
                                </div>
                        </div>
                        
                        
                </div>

                <div class="tab-pane fade" id="tag" >
                        <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                        <div class="single-products">
                                                <div class="productinfo text-center">
                                                        <img src="images/home/gallery1.jpg" alt="" />
                                                        <h2>$56</h2>
                                                        <p>Easy Polo Black Edition</p>
                                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        
                        
                </div>

                

        </div>
</div><!--/category-tab-->

    </div>
    
</div>
<?= $this->Html->css(['prettyPhoto','main','responsive.css'],['block'=>'pagecss']);?>