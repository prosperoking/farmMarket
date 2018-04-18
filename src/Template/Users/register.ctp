<?php if($this->request->session()->read('Auth.User')):
    
endif;
?>
<div class="container">
    <div class="row">
        
        <div class="col-sm-4 ">
            <h2>Create an account!</h2>
        <?= $this->form->create('users',['url'=>['action'=>'register'],'enctype' => 'multipart/form-data'])?>
        <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">First Name</span>
        <?= $this->form->input('firstname',['placeholder'=>'enter first name',
                                'class'=>'form-control',
                                 'aria-describedby'=>'basicaddon1',
                                    'label'=>FALSE])?>
        </div><br>
        <div class="input-group">
        <span class="input-group-addon" id="basic-addon2">Last Name</span>
        <?= $this->form->input('lastname',['placeholder'=>'enter last name',
                                'class'=>'form-control',
                                 'aria-describedby'=>'basicaddon2',
                                    'label'=>FALSE])?>
        </div><br>
        <div class="input-group">
        <span class="input-group-addon" id="basic-addon3">Other Name</span>
        <?= $this->form->input('othername',['placeholder'=>'enter other name',
                                'class'=>'form-control',
                                 'aria-describedby'=>'basicaddon3',
                                    'label'=>FALSE])?>
        </div><br>
        <div class="input-group">
        <span class="input-group-addon" id="basic-addon8">Email</span>
        <?= $this->form->input('email',['placeholder'=>'enter your email',
                                'class'=>'form-control',
                                 'aria-describedby'=>'basicaddon8',
                                  'type'=>'email',
                                    'label'=>FALSE])?>
        </div><br>
        <div class="input-group">
        <span class="input-group-addon" id="basic-addon5">Phone</span>
        <?= $this->form->input('phone',['placeholder'=>'enter your phone no',
                                'class'=>'form-control',
                                 'aria-describedby'=>'basicaddon6',
                                  'type'=>'tel',
                                    'label'=>FALSE])?>
        </div><br>
        <div class="input-group">
        <span class="input-group-addon" id="basic-addon4">Username</span>
        <?= $this->form->input('username',['placeholder'=>'enter a username',
                                'class'=>'form-control',
                                 'aria-describedby'=>'basicaddon3',
                                    'label'=>FALSE])?>
        </div><br>
        <div class="input-group">
        <span class="input-group-addon" id="basic-addon5">Password</span>
        <?= $this->form->input('password',['placeholder'=>'enter your password',
                                'class'=>'form-control',
                                 'aria-describedby'=>'basicaddon6',
                                  'type'=>'password',
                                    'label'=>FALSE])?>
        </div><br>
        <div class="input-group">
        <span class="input-group-addon" id="basic-addon6">Upload Profile photo</span>
        <?= $this->form->input('imageprof',[
                                'type'=>'file',
                                'class'=>'form-control',
                                 'aria-describedby'=>'basicaddon6',
                                    'label'=>FALSE])?>
        </div><br>
        <?= $this->form->button('register',['type'=>'submit','class'=>'btn btn-lg btn-success'])?>
        <?= $this->form->end()?>
        </div>
        <div class="col-sm-1 col-sm-offset-1">
            <h2 class="rnd">OR</h2>
	</div>
        <div class="col-sm-4 col-sm-offset-1">
		<div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
				<?= $this->form->create('users',['url'=>['action'=>'login']])?>
                    <input type="text" placeholder="username" name="username" />
                                <input type="password" placeholder="password" name="password"/>
                               
				<button type="submit" class="btn btn-lg btn-success">Login</button>
				<?= $this->form->end()?>
					</div><!--/login form-->
				</div>
    </div>
</div>