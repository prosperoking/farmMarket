<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
         $this->Auth->allow(['index','register','about']);
    }
    public function index($username=NULL)
    {
        
        if(!isset($username)){
        $this->setAction('register');
        }
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function register()
    {
        if($this->Auth->user()!=NULL){
            return $this->redirect(['controller'=>'pages','action'=>'/']);
        }
        $dir1 = 'uploads/profimages/';
        $dir = WWW_ROOT.'uploads'.DS.'profimages'.DS;
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $a=$this->request->data;
            if(!empty($a['imageprof']['name'])){
               $file = $this->request->data['imageprof']; //put the data into a var for easy use

                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $allowed_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions
                $setNewFileName = time() . "_" . rand(000000, 999999);

                //only process if the extension is valid
                if (in_array($ext, $allowed_ext)) {
                    //do the actual uploading of the file. First arg is the tmp name, second arg is 
                    //where we are putting it
                    move_uploaded_file($file['tmp_name'], $dir. $setNewFileName . '.' . $ext);

                    //prepare the filename for database entry 
                    $imageFileName = $dir1.$setNewFileName . '.' . $ext;
                    }else{
                        $this->set(compact('user'));
                        $this->set('_serialize', ['user']);
                        return $this->Flash->error('Sorry! only JPG,GIF,PNG file formats are accepted');
                         
                    }
           }else{
                 $imageFileName = $dir1.'default.jpg';
           }
          $user = $this->Users->patchEntity($user, $this->request->data);
          
            
                $user->imageprof = $imageFileName;
            
            $user->usertype= 0;
            $user->accstatus = 1;
            if ($this->Users->save($user)) {
                $this->Auth->setUser($user->toArray());
              
                $this->Flash->success(__('Account created'));
                return $this->redirect(['controller'=>'pages','action' => 'index']);
            } else {
                $this->Flash->error(__('Sorry account could not be created. Please, try again.'));
            }
        }
        $this->set('title','Register');
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
    /**
     * 
     * @return type login
     */
    public function login(){
        if($this->Auth->user()!=NULL){
            return $this->redirect(['controller'=>'pages','action'=>'/']);
        }
        $this->set('title','Login');
        if ($this->request->is('post')) {
        $user = $this->Auth->identify();
        if ($user) {
            $this->Auth->setUser($user);
            $this->Flash->success(__('Login Successful'));
            return $this->redirect($this->Auth->redirectUrl());
        }
        $this->set('values',$this->request->data);
        $this->Flash->error('Your username or password is incorrect.');
    }
        $this->render('register');
    }
    
    public function logout()
            {
                $this->Auth->logout();
                $this->Flash->success('You are now logged out.');
                return $this->redirect('/');
            }
    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    
    
    
    
    public function edit($id = null)
    {
        $currentuser = $this->Auth->user();
        $this->set(['title'=>'Update profile','id'=>$currentuser]);
        
        $ab = true;
        $realid = $currentuser['id'];
        if(isset($id)){
            $realid = $id;
            if($currentuser['id'] == $id || $currentuser['usertype']){
                
            }else{
                $ab = false;
            }
        }
        if($ab){
        $user = $this->Users->get($realid, [
            'contain' => []
        ]);
        $dir1 = '/uploads/profimages/';
        $dir = WWW_ROOT.'uploads'.DS.'profimages'.DS;
        $oldimg = $user['imageprof'];
        if ($this->request->is(['patch', 'post', 'put'])) {
            $a= $this->request->data;
            if(!empty($a['imageprof']['name'])){
               $file = $a['imageprof']; //put the data into a var for easy use

                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $allowed_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions
                $setNewFileName = time() . "_" . rand(000000, 999999);

                //only process if the extension is valid
                if (in_array($ext, $allowed_ext)) {
                    //do the actual uploading of the file. First arg is the tmp name, second arg is 
                    //where we are putting it
                    move_uploaded_file($file['tmp_name'], $dir. $setNewFileName . '.' . $ext);

                    //prepare the filename for database entry 
                    $imageFileName = $dir1.$setNewFileName . '.' . $ext;
                    }else{
                        $this->set(compact('user'));
                        $this->set('_serialize', ['user']);
                        return $this->Flash->error('Sorry! only JPG,GIF,PNG file formats are accepted');
                         
                    }
            }
            $user = $this->Users->patchEntity($user, $this->request->data,[
               'fieldList' =>['firstname','lastname','othername','phone','imageprof']
            ]);
            if(!empty($a['imageprof']['name'])){
                unlink(preg_replace(['/',"\\"],DS ,$user->imageprof));
                $user->imageprof = $imageFileName;
            }else{
                $user->imageprof = $oldimg;
            }
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Account updated'));
                
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
        }else{
            $this->Flash->error(__('Sorry you can\'t perform this action.'));
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * 
     */
    public function about()
    {
        $this->set('title','About Project');
    }
}
