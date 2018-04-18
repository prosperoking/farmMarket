<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController
{

    private $dir1 = '/uploads/productimages/';
    private $dir = WWW_ROOT.'uploads'.DS.'subcat'.DS;
    
    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['index','search','view']);
        
    }
    public function search($q=null) {
        $this->set('title','Search result');
        $this->render('index');
    }
    public function myproducts() {
        $title = $this->Auth->user('fistname').' Products';
        $this->set(compact('title'));
        $this->set('products', $this->paginate($this->Products->findByUser_id($this->Auth->user('id'))));
        $this->set('_serialize', ['products']);
        
    }
    /**
     * Index method
     *
     * @return void
     * 
     */
    public function index($filter=Null,$id=Null)
    {
        $isvalid = ['category','subcategory'];
        if(isset($filter)&&isset($id)){
            
            if($filter == $isvalid[0]){
                
                $this->set('title','Filter: Category');
                $this->paginate = [
                    'contain' => ['Users', 'Subcategories','Categories']
                ];
                $this->set('products', $this->paginate($this->Products->find()->where(['Products.category_id'=>$id])));
                $this->set('_serialize', ['products']);
                
                return;
            }elseif($filter==$isvalid[1]){
                $this->set('title','Filter: Subcategory');
                $this->paginate = [
                    'contain' => ['Users', 'Subcategories','Categories']
                ];
                $this->set('products', $this->paginate($this->Products->find('all')->where(['Products.subcategory_id'=>$id])));
                $this->set('_serialize', ['products']);
                return;
            }
        }else{
            
        
        $this->set('title','Products');
        $this->paginate = [
            'contain' => ['Users', 'Subcategories','Categories']
        ];
        $this->set('products', $this->paginate($this->Products));
        $this->set('_serialize', ['products']);
        }
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($title,$id = null)
    {
        
        $this->set('title','Products');
        $product = $this->Products->get($id, [
            'contain' => ['Users', 'Subcategories', 'Transactions','Categories']
        ]);
        
        $this->set('product', $product);
        $this->set('_serialize', ['product']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->set('title', 'Add Your Product');
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            
             if(!empty($this->request->data['image']['name'])){
               $file = $this->request->data['image']; //put the data into a var for easy use

                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $allowed_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                $setNewFileName = time() . "_" . rand(000000, 999999);

                //only process if the extension is valid
                if (in_array($ext, $allowed_ext)) {
                    //do the actual uploading of the file. First arg is the tmp name, second arg is 
                    //where we are putting it
                    move_uploaded_file($file['tmp_name'], $this->dir. $setNewFileName . '.' . $ext);

                    //prepare the filename for database entry 
                    $imageFileName = $this->dir1.$setNewFileName . '.' . $ext;
                    }else{
                        $this->set(compact('user'));
                        $this->set('_serialize', ['user']);
                        $categories = $this->Subcategories->Categories->find('list', ['limit' => 200]);
                        $this->set(compact('subcategory', 'categories'));
                        return $this->Flash->error('Sorry! only JPG,GIF,PNG file formats are accepted');
                         
                    }
            }else{
                $defualtimage = $this->Products->Subcategories->findById($this->request->data['subcategory_id']);
                $image = $defualtimage->toArray();
                
                $imageFileName = $image[0]['image'];
            }
            
            
            $product = $this->Products->patchEntity($product, $this->request->data,[
                'fieldList'=>['user_id','category_id','subcategory_id','prize','title','description','tags']]);
            $product->user_id = $this->Auth->user('id');
            $product->image = $imageFileName;
            if ($this->Products->save($product)) {
                $this->Flash->success(__('Your product has being added.'));
                return $this->redirect(['action' => 'myproducts']);
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
            }
        }
        $users = $this->Products->Users->find('list', ['limit' => 200]);
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $subcategories = $this->Products->Subcategories->find('list', ['limit' => 200,
            'groupField' => 'category_id',
            'Contain'=>['Categories'=>function($q){
            return $q->select(['name']);
            
                }]
           
            ]);
        $this->set(compact('product', 'users', 'subcategories', 'categories'));
        $this->set('_serialize', ['product']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->set('title', 'Update Your Product');
        $product = $this->Products->get($id, [
            'contain' => ['Categories','Subcategories']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])&& ($product->user_id == $this->Auth->user('id')|| $this->Auth->user('type'))) {
            if(!empty($this->request->data['image']['name'])){
               $file = $this->request->data['image']; //put the data into a var for easy use

                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $allowed_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                $setNewFileName = time() . "_" . rand(000000, 999999);

                //only process if the extension is valid
                if (in_array($ext, $allowed_ext)) {
                    //do the actual uploading of the file. First arg is the tmp name, second arg is 
                    //where we are putting it
                    move_uploaded_file($file['tmp_name'], $this->dir. $setNewFileName . '.' . $ext);

                    //prepare the filename for database entry 
                    $imageFileName = $this->dir1.$setNewFileName . '.' . $ext;
                    }else{
                        $this->set(compact('user'));
                        $this->set('_serialize', ['user']);
                        $categories = $this->Subcategories->Categories->find('list', ['limit' => 200]);
                        $this->set(compact('subcategory', 'categories'));
                        return $this->Flash->error('Sorry! only JPG,GIF,PNG file formats are accepted');
                         
                    }
            }else{
                
                $imageFileName = $product->image;
            }
            
            $product = $this->Products->patchEntity($product, $this->request->data,[
                'fieldList'=>['category_id','subcategory_id','prize','title','description','tags']]);
            $product->image = $imageFileName;
            if ($this->Products->save($product)) {
                $this->Flash->success(__('Your product has been Updated.'));
                return $this->redirect(['action' => 'myproducts']);
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
            }
        }
        $update = 'Update';
        $users = $this->Products->Users->find('list', ['limit' => 200]);
        $subcategories = $this->Products->Subcategories->find('list', ['limit' => 200]);
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $this->set(compact('product', 'users','categories', 'subcategories','update'));
        $this->set('_serialize', ['product']);
       
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
   
}
