<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
 <?php 
$usertype = $this->request->session()->read('Auth.User');

if($usertype['usertype'] && $user->id != $usertype['usertype']):?>       <li>

<?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->username)]
            )
        ?></li>
        <?php endif;?>
        
        <li><?= $this->Html->link(__('My Products'), ['controller' => 'Products', 'action' => 'myproducts']) ?></li>
        <li><?= $this->Html->link(__('Add New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user,['type'=>'file']) ?>
    <fieldset>
        <legend><?= __('Update profile') ?></legend>
        <?php
            
            echo $this->Form->input('firstname');
            echo $this->Form->input('lastname');
            echo $this->Form->input('othername');
            
            
            echo $this->Form->input('phone');
            echo $this->Form->file('imageprof',['required'=>false]);
           
        ?>
    </fieldset>
    <?= $this->Form->button(__('Update profile')) ?>
    <?= $this->Form->end() ?>
</div>
