<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Carts Controller
 *
 * @property \App\Model\Table\CartsTable $Carts
 */
class CartsController extends AppController
{

    public function initialize()
        {
            parent::initialize();
            $this->Auth->allow('add');
            $this->loadComponent('RequestHandler');
        }
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $cart = $this->Carts->find('All', [
            'contain' => ['Products', 'Users']
        ])->where(['Carts.user_id'=>$this->Auth->user('id')]);
        
        $this->set(['cart'=> $cart,'title'=>'My Shopping Cart']);
        $this->set('carts', $this->paginate($cart));
        $this->set('_serialize', ['carts']);
    }

    /**
     * View method
     *
     * @param string|null $id Cart id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    
    public function add()
    {
        $this->RequestHandler->renderAs($this, 'json');
        if(empty($this->Auth->user('id'))&& $this->request->is(['ajax','put','post'])){
            $this->set('response',['status'=>0,'message'=>'please log in to add to your cart']);
            return ;
        }
        
        if ($this->request->is(['ajax','put','post'])) {
            $checkexist = $this->Carts->find('All',[
                'conditions'=>['Carts.product_id'=>$this->request->data['product_id'],
                'Carts.user_id'=>$this->Auth->user('id')]
            ]);
            
            $product = $this->Carts->Products->get($this->request->data['product_id']);
            
            if($product->user_id == $this->Auth->user('id')){
               $this->set('response',['status'=>0,'message'=>'Sorry you can\'t purchase from your self']);
               return ;
             }
             
            if ($checkexist->count()){
                //if product already in cart then update
                $this->request->data['quantity'] = $checkexist->toArray()[0]['quantity']+ $this->request->data['quantity'];
                $cart = $this->Carts->get($checkexist->toArray()[0]['id']);
                $a = 0;
                $msg = 'Item has being updated';
            }
            else{
                $cart = $this->Carts->newEntity();
                $a = 1;
                $msg = 'Product is added to your cart.';
            }
            $cart = $this->Carts->patchEntity($cart, $this->request->data);
            $cart->user_id = $this->Auth->user('id');
            
            

            if ($this->Carts->save($cart)) {
                $this->set('response',['status'=>1,'message'=>$msg,'qty'=>$a]);
                return ;
            } else {
                $this->set('response',['status'=>0,'message'=>'Sorry the product could not be saved.']);
                return ;
            }
        }
        
        return $this->request->query('page');
    }

    /**
     * Edit method
     *
     * @param string|null $id Cart id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cart = $this->Carts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cart = $this->Carts->patchEntity($cart, $this->request->data);
            if ($this->Carts->save($cart)) {
                $this->Flash->success(__('The cart has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cart could not be saved. Please, try again.'));
            }
        }
        $products = $this->Carts->Products->find('list', ['limit' => 200]);
        $users = $this->Carts->Users->find('list', ['limit' => 200]);
        $this->set(compact('cart', 'products', 'users'));
        $this->set('_serialize', ['cart']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cart id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cart = $this->Carts->get($id);
        if ($this->Carts->delete($cart)&&($cart->user_id==$this->Auth->user('id')||$this->Auth->user('usertype'))) {
            $this->Flash->success(__('Product removed .'));
        } else {
            $this->Flash->error(__('The Product could not be removed. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
