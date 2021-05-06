<div class="modal fade" id="modal_editobjective" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Objective</h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form role="form"   action="<?php echo base64_encode("beans=post/editobjective"); ?>" method="POST">
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
<div class="modal fade" id="modal_addobjective" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Objective</h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form role="form"   action="<?php echo base64_encode("beans=post/addobjective"); ?>" method="POST">
      <div class="modal-body ">
          
  <div class="form-floating mb-3">
      <textarea style="min-height: 200px" required  type="text" class="form-control" id="input_objectivename" name="input_objectivename" placeholder="kwarog"></textarea>
  <label for="input_objectivename">Objective </label>
</div>
 <div class="form-control-dark mb-3">
     <select class="form-select categorychange" name="input_category" aria-label="Select Category...">
         <option selected  disabled>Select Category...</option>

</select>     
           </div>
 <div class="form-control-dark mb-3">
     <select class="form-select outcome_sel" name="input_outcome" aria-label="Select Category...">
         <option selected  disabled>Select Outcome...</option>

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
<div class="modal fade" id="modal_removeobjective" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Delete Objective</h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form role="form"   action="<?php echo base64_encode("beans=post/deleteobjective"); ?>" method="POST">
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