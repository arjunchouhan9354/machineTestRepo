 <?= $this->extend("layouts/master") ?>
<?= $this->section("body-contents") ?>

<div class="container bootstrap snippet">
                  <form class="form" method="post" id="registrationForm">
                    <h5 class="mb-3">User Profile</h5>
    <div class="row">
      <div class="col-sm-3"><!--left col-->
        <div class="text-center">
          <?php
          if($data[0]['profile_pic'] == "")
          { ?>
             <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
          <?php }else{ ?>
            <img src="<?=base_url('public/assets/upload')?>/<?=$data[0]['profile_pic']?>" class="avatar img-circle img-thumbnail" alt="avatar">
          <?php }

          ?>
       
        <h6>Upload a different photo...</h6>
        <input type="file" name="profile_pic" class="text-center center-block file-upload">
      </div>
          
        </div><!--/col-3-->
    	<div class="col-sm-9">
                      <div class="row form-group">
                          
                          <div class="col-md-6 mb-4">
                              <label for="user_name">User Name</label>
                              <input type="hidden" name="user_id" value="<?= $data[0]['user_id'];?>">
                              <input type="text" class="form-control" name="user_name" id="user_name" placeholder="User Name" value="<?= $data[0]['user_name'];?>">
                          </div>
             
                          <div class="col-md-6 mb-4">
                            <label for="mobile_number">Mobile Number</label>
                              <input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Mobile Number"  value="<?= $data[0]['mobile_number'];?>">
                          </div>
                     
                          <div class="col-md-6 mb-4">
                              <label for="address">Address</label>
                              <input type="text" class="form-control" name="address" id="address" placeholder="enter address"  value="<?= $data[0]['address'];?>">
                          </div>
                     
                          <div class="col-md-6 mb-4">
                             <label for="pic_code">PIN Code</label>
                              <input type="text" class="form-control" name="pic_code" id="pic_code" placeholder="enter pin code"  value="<?= $data[0]['pic_code'];?>">
                          </div>
                      
                          
                          <div class="col-md-6 mb-4">
                              <label for="city">City</label>
                              <input type="city" class="form-control"  value="<?= $data[0]['city'];?>" name="city" id="city" placeholder="City">
                          </div>
                  
                          
                          <div class="col-md-6 mb-4">
                              <label for="dob">DOB</label>
                              <input type="date" class="form-control" id="dob" placeholder="somewhere" title="enter a dob"  value="<?= $data[0]['dob'];?>">
                          </div>
                     
                                  
                           <div class="col-md-12">
                                <br>
                              	<button class="btn btn-lg btn-success" id="updateProfileBtn" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Update</button>
                            </div>
                      </div>
              
             </div><!--/tab-pane-->
               
              </div><!--/tab-pane-->
                </form>
<?= $this->endSection() ?>
