<div class="modal fade" id="modal_editsignatories" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add User</h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form role="form"   action="<?php echo base64_encode("beans=post/editsignatories"); ?>" method="POST">
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
<div class="modal fade" id="modal_addsignatories" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add User</h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form role="form"   action="<?php echo base64_encode("beans=post/addsignatories"); ?>" method="POST">
      <div class="modal-body ">
          
    
          

 
  <div class="form-floating mb-3">
  <input type="text" class="form-control" required id="input_fullname"  name="input_fullname" placeholder="ex: Atty. Juanna Dela Cruss">
  <label for="input_fullname">Fullname (ex: Atty. Juanna Dela Cruss)</label>
</div>
  
          
   <div class="form-control-dark mb-3">
<select class="form-select" name="input_position" aria-label="Select System Role...">
         
  
  
  <option value="Regional Director">Regional Director</option>
  <option value="ARD Finance and Administrative Service">ARD Finance and Administrative Service</option>
  <option value="ARD Field Operations">ARD Field Operations</option>
  <option value="ARD for Technical Services">ARD for Technical Services</option>
  
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
<div class="modal fade" id="modal_removesignatories" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Delete User</h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form role="form"   action="<?php echo base64_encode("beans=post/deletesignatories"); ?>" method="POST">
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