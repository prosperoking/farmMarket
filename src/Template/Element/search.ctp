<div class="searchcont" >
   <?= $this->form->create(null,[
       'url'=>['controller'=>'products','action'=>'search']
       
       ])?>
        <?php echo $this->Form->input('Products.search', ['type' => 'search','id'=>'searchtext','name'=>'q','placeholder'=>'Search for an item','label'=>false]);?>
                <?php echo $this->Form->button('Search', ['type' => 'submit', 'id'=>'csearchbtn']);?>
                <div id="ajaxsearch"></div>
                <?php echo $this->form->end();?>
            </div>
