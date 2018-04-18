<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('My Products'), ['action' => 'myproducts']) ?></li>
       
    </ul>
</nav>
<div class="products form large-9 medium-8 columns content">
    <?= $this->Form->create($product,['type'=>'file']) ?>
    <fieldset>
        <legend><?= __((isset($update))?'Update Product':'Add Product') ?></legend>
        <?php
            echo $this->Form->input('title');
            
            echo $this->Form->input('category_id', ['options' => $categories,'id'=>'cat']);
            echo $this->Form->input('subcategory_id', ['options' => $subcategories,'id'=>'subcat']);
            echo $this->Form->input('description');
            echo $this->Form->input('availableqty',['min'=>1,'label'=>'Quantity Available']);
            echo $this->Form->input('prize',['min'=>1,'label'=>'₦ Prize']);
            echo $this->Form->input('tags',['label'=>'Enter your tags seperate by ",".Note this will help increase your product visibility during a search. tag limit is 5']);
            echo $this->Form->input('image',['type'=>'file','required'=>false,'class'=>'btn']);
        ?>
    </fieldset>
    <?= $this->Form->button(__((isset($update))?$update:'Add product')) ?>
    <?= $this->Form->end() ?>
</div>
<?= $this->Html->script(['jquery.tagsinput.min','productadd'],['block'=>'pagescript']);?>
<?= $this->Html->css('jquery.tagsinput.min',['block'=>'pagecss']);?>