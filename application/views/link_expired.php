<div class="container error_404">
    <div class="d-flex justify-content-center">
        <div class="col-sm-6 mx-auto">
            <div class="card my-5 p-5 text-center">
                <div class="card-header ">
                     <div class="error_icon text-muted">
                        <i class="fas fa-skiing-nordic"></i>
                    </div>
                    <h1>Link expired!</h1>
                   
                </div>
                <div class="text-muted ">
                    The link you are trying to use is either expired or has been used already.
               
                <?php if($this->uri->segment(3) == 'recoverPassword'){ ?>
                    <br/> <br/>
                    Still do not have your password? click below and get a new link to recover it.<br/><br/>
                    <a href="<?php echo superadmin_url('users/forgotPassword'); ?>" class="card-link">Forgot Password?</a>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>