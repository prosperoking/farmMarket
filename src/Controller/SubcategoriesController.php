<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Subcategories Controller
 *
 * @property \App\Model\Table\SubcategoriesTable $Subcategories
 */
class SubcategoriesController extends AppController
{
    private $dir1 = '/uploads/subcat/';
    private $dir = WWW_ROOT.'uploads'.DS.'subcat'.DS;
    /**
     * Index method
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();
        $this->Auth->deny();
    }
    public function index()
    {
        $this->set('title','Subcategories');
        $this->paginate = [
            'contain' => ['Categories']
        ];
        $this->set('subcategories', $this->paginate($this->Subcategories));
        $this->set('_serialize', ['subcategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Subcategory id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
         $this->set('title','Subcategories');
        $subcategory = $this->Subcategories->get($id, [
            'contain' => ['Categories', 'Products']
        ]);
        $this->set('subcategory', $subcategory);
        $this->set('_serialize', ['subcategory']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
         
         $this->set('title','Add Subcategories');
        $subcategory = $this->Subcategories->newEntity();
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
            }
            
           
            $subcategory = $this->Subcategories->patchEntity($subcategory, $this->request->data);
            if(!empty($this->request->data['image']['name'])){
                $subcategory->image = $imageFileName;
            }
            if ($this->Subcategories->save($subcategory)) {
                $this->Flash->success(__('The subcategory has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ooops! The subcategory could not be saved. Please, try again.'));
            }
        }
        $categories = $this->Subcategories->Categories->find('list', ['limit' => 200,'order'=>'Categories.name ASC']);
        $this->set(compact('subcategory', 'categories'));
        $this->set('_serialize', ['subcategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Subcategory id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
         $this->set('title','Update Subcategories');
        $subcategory = $this->Subcategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
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
            }  else {
                 $imageFileName = $subcategory->image;
            }
            if(!empty($this->request->data['image']['name'])){
                
            }
            $subcategory = $this->Subcategories->patchEntity($subcategory, $this->request->data);
            if(!empty($this->request->data['image']['name'])){
                unlink(preg_replace(['/',"\\"],DS ,$subcategory->image));
                $subcategory->image = $imageFileName;
            }  else {
                $subcategory->image = $imageFileName;
            }
            if ($this->Subcategories->save($subcategory)) {
                $this->Flash->success(__('The subcategory has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The subcategory could not be saved. Please, try again.'));
            }
        }
        $categories = $this->Subcategories->Categories->find('list', ['limit' => 200]);
        $this->set(compact('subcategory', 'categories'));
        $this->set('_serialize', ['subcategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Subcategory id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subcategory = $this->Subcategories->get($id);
        unlink(preg_replace(['/',"\\"],DS ,$subcategory['image']));
        if ($this->Subcategories->delete($subcategory)) {
            $this->Flash->success(__('The subcategory has been deleted.'));
        } else {
            $this->Flash->error(__('The subcategory could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    public function isAuthorized($user=null) {

        
        
            $isStaff = $user['usertype'];
            if($isStaff == false) {
                $this->redirect($this->Auth->redirectUrl());
                $this->Flash->error(__('Oops! Your authorized to access this page'));  
                return false;
            }
        
        return parent::isAuthorized($user);
    }
}
