<div class="page-wrapper" id="">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor page-title-text">Profile</h3>
         </div>
      </div>

      <div class="row">
         <div class="col-12 col-12-no-padding">
            <div class="card">
               <div class="card-body">
                  <form method="post" id="update_users" action="<?= base_url(); ?>profile/update_users">
                     <input type="hidden" class="form-control" id="fk_user_id" name="fk_user_id" value="<?php echo $user_prof[0]['fk_user_id']; ?>">
                     <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $user_prof[0]['user_id'];  ?>">
                     <input id="user_id" type="hidden" name="user_id" value="">
                     <div class="form-row">
                        <div class="form-group col-md-4">
                           <label for="first_name">First Name:</label>
                           <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user_prof[0]['first_name']; ?>" required="">
                        </div>
                        <div class="form-group col-md-4">
                           <label for="last_name">Last Name:</label>
                           <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user_prof[0]['last_name']; ?>" required="">
                        </div>
                        <div class="form-group col-md-4">
                           <label for="email">Email Address:</label>
                           <input type="email" class="form-control" id="email" name="email" value="<?php echo $user_prof[0]['email']; ?>" required="">
                        </div>
                     </div>

                     <div class="form-row">
                        <div class="form-group col-md-4">
                           <label for="phone_number">Phone Number:</label>
                           <input type="number" class="form-control" id="phone_number" name="phone_number" value="<?php echo $user_prof[0]['phone_number']; ?>">
                        </div>
                        <div class="form-group col-md-4">
                           <label for="username">Userame:</label>
                           <input type="text" class="form-control" id="username" name="username" value="<?php echo $user_prof[0]['username']; ?>" required="">
                        </div>
                        <div class="form-group col-md-4">
                           <label for="password">Update Password:</label>
                           <input type="password" class="form-control" id="password" name="password" value="">
                        </div>
                     </div>

                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <label for="city">City:</label>
                           <input type="text" class="form-control" id="city" name="city" value="<?php echo $user_prof[0]['city']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                           <label for="state">State:</label>
                           <input type="text" class="form-control" id="state" name="state" value="<?php echo $user_prof[0]['state']; ?>">
                        </div>
                     </div>

                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <label for="country">Country:</label>
                           <input type="text" class="form-control" id="country" name="country" value="<?php echo $user_prof[0]['country']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                           <label for="zip_code">Zipcode:</label>
                           <input type="text" class="form-control" id="zip_code" name="zip_code" value="<?php echo $user_prof[0]['zip_code']; ?>">
                        </div>
                     </div>
                     <div class="col-md-12">
                        <button type="submit" class="btn atm-button"><i class="fa fa-check"></i> Save Changes</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>