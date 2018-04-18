<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Add Product'), ['action' => 'add']) ?></li>
        
        
    </ul>
</nav>
<div class="products index large-9 medium-8 columns content">
    <h3><?= __('My Products') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                
                <th><?= __('Sort by')?></th>
                <th><?= $this->Paginator->sort('title') ?></th>
                
                <th><?= $this->Paginator->sort('prize') ?></th>
                
            </tr>
        </thead>
        
    </table>
    <div class="row">
        <?php $i=1; foreach ($products as $product): ?>
        <?= $this->element('productuser',[
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
<?= $this->Html->css(['prettyPhoto','main'],['block'=>'pagecss']);?>