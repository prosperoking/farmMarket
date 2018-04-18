<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Add new Product'), ['action' => 'add']) ?></li>
 
    </ul>
    <ul class="side-nav">
        <li class="heading"><?= __('Sort By') ?></li>
        <li><?= $this->Paginator->sort('category_id') ?></li>
        <li><?= $this->Paginator->sort('subcategory_id') ?></li>
        </ul>
</nav>
<div class="products index large-9 medium-8 columns content">
    <h3><?= __('Products') ?><?= (empty($products))?'- <i class="glyphicon glyphicon-eye-close"></i> '.__('Sorry no product found') :''?></h3>
    
    <div class="row">
        <?php foreach ($products as $product): ?>
       <?= $this->element('products',[
           'prod'=>$product
       ])?>
        <?php endforeach; ?>
    </div>
    
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
<?= $this->Html->script(['jquery.toast.min','main'],['block'=>'pagescript']);?>
<?= $this->Html->css(['prettyPhoto','jquery.toast.min','main'],['block'=>'pagecss']);?>