<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Add Your Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="carts index large-9 medium-8 columns content">
    <h3><?= __('My Cart '.$this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-shopping-cart'))) ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= __('Product Title') ?></th>
                <th><?= __('Image') ?></th>
                <th><?= $this->Paginator->sort('quantity') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            
            <?php foreach ($carts as $cart): ?>
            <tr>
                
                <td><?= $cart->has('product') ? $this->Html->link($cart->product->title, ['controller' => 'Products', 'action' => 'view', $cart->product->id]) : '' ?></td>
                <td><?= $this->Html->image($cart->product->image,['width'=>'150px','height'=>'100px','class'=>'img img-round']) ?></td>
                <td><?= $this->Number->format($cart->quantity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View Product'),'/products/view/'.str_replace(' ','-',$cart->product->title).'/'.$cart->product->id, ['class'=>'btn ']) ?>
                    <?= $this->Form->postLink(__($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-trash'))), ['action' => 'delete', $cart->id],['escape'=>false,'class'=>'btn btn-danger','confirm' => __('Are you sure you want to remove {0}from your cart?', $cart->product->title)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4">
                    <?= $this->Html->Link(_('Check out'),'/pay',['class'=>'button'])?>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
