<div class="modal fade" id="modal_edituser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add User</h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form role="form"   action="<?php echo base64_encode("beans=post/edituser"); ?>" method="POST">
      <div class="modal-body ">
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Save</button>
      </div>
            </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modal_adduser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add User</h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form role="form"   action="<?php echo base64_encode("beans=post/adduser"); ?>" method="POST">
      <div class="modal-body ">
          
  <div class="form-floating mb-3">
  <input  type="text" class="form-control" id="input_username" name="input_username" placeholder="kwarog">
  <label for="input_username">Username</label>
</div>
  <div class="form-floating mb-3">
  <input  type="password" class="form-control" id="input_password" name="input_password" placeholder="********" >
  <label for="input_password">Password</label>
</div>
           
          
  <div class="form-floating mb-3">
  <input  type="email" class="form-control" id="input_email" name="input_email" placeholder="name@example.com">
  <label for="input_email">Email address</label>
</div>
  <div class="form-floating mb-3">
  <input type="text" class="form-control" id="input_fname" name="input_fname" placeholder="Donnie">
  <label for="input_fname">First Name</label>
</div>
  <div class="form-floating mb-3">
  <input type="text" class="form-control" id="input_mname"  name="input_mname" placeholder="Rocapor">
  <label for="input_fname">Middle Name</label>
</div>
  <div class="form-floating mb-3">
  <input type="text" class="form-control" id="input_lname" name="input_lname" placeholder="Gallocanta">
  <label for="input_fname">Last Name</label>
</div>
  
  <div class="form-floating mb-3">
  <input type="text" class="form-control" id="input_division" name="input_division" placeholder="Technical Division">
  <label for="input_division">Division</label>
</div>
           <div class="form-control-dark mb-3">
     <select class="form-select" name="input_province" aria-label="Select Province...">
         <option selected  disabled>Select Province...</option>

</select>     
           </div>
           <div class="form-control-dark mb-3">
     <select class="form-select" name="input_role" aria-label="Select System Role...">
         
  
  
  <option value="user">User</option>
  <option value="moderator">Moderator</option>
  <option value="administrator">Administrator</option>
</select>     
          
          
          
          

          
          
          
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Save</button>
      </div>
            </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modal_removeuser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Delete User</h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form role="form"   action="<?php echo base64_encode("beans=post/deleteuser"); ?>" method="POST">
      <div class="modal-body ">
          <div class="items"></div>
          <h6>Do you really want to remove selected item/s?</h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="submit" name="submit" class="btn btn-primary">Proceed</button>
      </div>
            </form>
    </div>
  </div>
</div>