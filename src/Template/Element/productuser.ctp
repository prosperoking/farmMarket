<div class="col-sm-3" >
	<div class="product-image-wrapper">
		<div class="single-products">
			<div class="productinfo text-center">
                            <a href="/products/view/<?= $prod['id']?>"><img src="<?= $prod['image']?>" alt="" style="height: 130px;"></a>
				<h2>₦<?= $prod['prize']?></h2>
				<p><?= $prod['title']?></p>
                                <a href="/products/view/<?= str_replace(' ','-',$prod['title']).'/'.$prod['id']?>" class="btn btn-info" ><?= __('View')?></a>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $prod->id],['class'=>'btn btn-success']) ?>
                                 <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $prod->id], ['confirm' => __('Are you sure you want to delete # {0}?', $prod->id), 'class'=>'btn btn-danger']) ?>
			</div>
											
		</div>
	</div>
</div>