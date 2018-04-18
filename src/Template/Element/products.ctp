
    
<div class="col-sm-3">
    <div class="product-image-wrapper">
            <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="/products/view/<?= $prod['title'].'-'.$prod['id']?>"><img src="<?= $prod['image']?>" alt="" style="height: 130px;"></a>
                                    <h2>₦<?= $prod['prize']?></h2>
                                    <p><?= $prod['title']?></p>
                                    <a href="/cart/add/<?= $prod['id']?>" class="btn btn-default add-to-cart" data-id ="<?= $prod['id']?>"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            <div class="product-overlay">
                                    <div class="overlay-content">
                                            <h2>₦<?= $prod['prize']?></h2>
                                            <p><?= $prod['title']?></p>
                                            <a href="/carts/add/<?= $prod['id']?>" class="btn btn-default add-to-cart" data-id ="<?= $prod['id']?>">
                                                <i class="fa fa-shopping-cart"></i>
                                                Add to cart</a>
                                            
                                    </div>
                            </div>
            </div>
        <div class="choose">
            <ul class="nav nav-pills nav-justified">
                <li class="txt"><?= __('Avail:').$prod['availableqty']?><meter max="<?= $prod['quantity']?>" value="<?= $prod['availableqty']?>" title="<?= __('Avalailable:')?>"></meter><?= __('Total:').' '.$prod['quantity']?></li>
            </ul>
        </div>
            
            <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li> <a href="/products/view/<?= str_replace(' ','-',$prod['title']).'/'.$prod['id']?>" ><?= __('View')?></a></li>
                        <li>By:<a href="/users/<?= $prod->has('user') ?$prod->user->username : '' ?>" style="display: inline-block;"><i class="fa fa-plus-square"></i><?= $prod->has('user') ? $prod->user->username : '' ?></a></li>
                    </ul>
            </div>
    </div>
</div>
	
						
					