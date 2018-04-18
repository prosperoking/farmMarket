<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Subcategories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
       
    </ul>
</nav>
<div class="subcategories form large-9 medium-8 columns content">
    <?= $this->Form->create($subcategory,['type'=>'file']) ?>
    <fieldset>
        <legend><?= __('Add Subcategory') ?></legend>
        <?php
            echo $this->Form->input('category_id', ['options' => $categories]);
            echo $this->Form->input('name');
           
        ?>
        <div class="input text required">
            <label for="name"><?= __('Sub category default image')?></label>
            <?= $this->Form->file('image',['required']);?>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Add Subcategories')) ?>
    <?= $this->Form->end() ?>
</div>
