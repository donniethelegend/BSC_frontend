<div class="modal fade" id="modal_editoutcome" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Outcome</h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form role="form"   action="<?php echo base64_encode("beans=post/editoutcome"); ?>" method="POST">
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
<div class="modal fade" id="modal_addoutcome" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Outcome</h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form role="form"   action="<?php echo base64_encode("beans=post/addoutcome"); ?>" method="POST">
      <div class="modal-body ">
          
  <div class="form-floating mb-3">
  <input  type="text" class="form-control" id="input_outcomename" name="input_outcomename" placeholder="kwarog">
  <label for="input_outcomename">Outcome Name</label>
</div>
  <div class="form-control-dark mb-3">
     <select class="form-select" name="input_category" aria-label="Select Category...">
         <option selected  disabled>Select Category...</option>

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
<div class="modal fade" id="modal_removeoutcome" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Delete Outcome</h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form role="form"   action="<?php echo base64_encode("beans=post/deleteoutcome"); ?>" method="POST">
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