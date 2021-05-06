<div class="modal fade" id="modal_editcategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Category</h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form role="form"   action="<?php echo base64_encode("beans=post/editcategory"); ?>" method="POST">
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
<div class="modal fade" id="modal_adddeadline" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Set Deadline</h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form role="form"   action="<?php echo base64_encode("beans=post/adddeadline"); ?>" method="POST">
      <div class="modal-body ">
          

<script src="./js/moment.min.js" type="text/javascript"></script>
          <script src="./js/daterangepicker.min.js" type="text/javascript"></script>
          <link href="./css/daterangepicker.css" rel="stylesheet" type="text/css"/>
          <h5>Target</h5>
          <div class="input-group mb-3 reportrange target">
              
             <input style=" cursor: pointer; width: 100px;text-align: left" class="input-group-text" readonly name="name[]" value="TARGET"/>
              <span  style=" cursor: pointer;" class="input-group-text"><i data-feather="calendar"></i></span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_start[]" placeholder="Start" aria-label="Start">
  <span  style=" cursor: pointer;" class="input-group-text">TO</span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_end[]" placeholder="End" aria-label="End">
</div>
          <h5>Accomplishment</h5>
          <div class="input-group mb-3 reportrange jan">
              <input style=" cursor: pointer; width: 100px;text-align: left" class="input-group-text" readonly name="name[]" value="JAN"/>
              <span  style=" cursor: pointer;" class="input-group-text"><i data-feather="calendar"></i></span>
  <input readonly type="text" style=" cursor: pointer;" class="form-control" name="input_start[]" placeholder="Start" aria-label="Start">
  <span style=" cursor: pointer;"  class="input-group-text">TO</span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_end[]" placeholder="End" aria-label="End">
</div>
          <div class="input-group mb-3 reportrange feb">
              <input style=" cursor: pointer; width: 100px;text-align: left" class="input-group-text" readonly name="name[]" value="FEB"/>
              <span  style=" cursor: pointer;" class="input-group-text"><i data-feather="calendar"></i></span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_start[]" placeholder="Start" aria-label="Start">
  <span style=" cursor: pointer;"   class="input-group-text">TO</span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_end[]" placeholder="End" aria-label="End">
</div>
               <div class="input-group mb-3 reportrange mar">
                   <input style=" cursor: pointer; width: 100px;text-align: left" class="input-group-text" readonly name="name[]" value="MAR"/>
              <span style=" cursor: pointer;" style=" cursor: pointer;" class="input-group-text"><i data-feather="calendar"></i></span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_start[]" placeholder="Start" aria-label="Start">
  <span style=" cursor: pointer;"  class="input-group-text">TO</span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_end[]" placeholder="End" aria-label="End">
</div>
                 <div class="input-group mb-3 reportrange apr">
                     <input style=" cursor: pointer; width: 100px;text-align: left" class="input-group-text" readonly name="name[]" value="APR"/>
              <span  style=" cursor: pointer;" class="input-group-text"><i data-feather="calendar"></i></span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_start[]" placeholder="Start" aria-label="Start">
  <span  style=" cursor: pointer;" class="input-group-text">TO</span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_end[]" placeholder="End" aria-label="End">
</div>      
          <div class="input-group mb-3 reportrange may">
              <input style=" cursor: pointer; width: 100px;text-align: left" class="input-group-text" readonly name="name[]" value="MAY"/>
              <span  style=" cursor: pointer;" class="input-group-text"><i data-feather="calendar"></i></span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_start[]" placeholder="Start" aria-label="Start">
  <span style=" cursor: pointer;"  class="input-group-text">TO</span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_end[]" placeholder="End" aria-label="End">
</div>   
          <div class="input-group mb-3 reportrange jun">
              <input style=" cursor: pointer; width: 100px;text-align: left" class="input-group-text" readonly name="name[]" value="JUN"/>
              <span  style=" cursor: pointer;" class="input-group-text"><i data-feather="calendar"></i></span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_start[]" placeholder="Start" aria-label="Start">
  <span  style=" cursor: pointer;" class="input-group-text">TO</span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_end[]" placeholder="End" aria-label="End">
</div>
                  <div class="input-group mb-3 reportrange jul">
                      <input style=" cursor: pointer; width: 100px;text-align: left" class="input-group-text" readonly name="name[]" value="JUL"/>
              <span  style=" cursor: pointer;" class="input-group-text"><i data-feather="calendar"></i></span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_start[]" placeholder="Start" aria-label="Start">
  <span  style=" cursor: pointer;" class="input-group-text">TO</span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_end[]" placeholder="End" aria-label="End">
</div>


          <div class="input-group mb-3 reportrange aug">
              <input style=" cursor: pointer; width: 100px;text-align: left" class="input-group-text" readonly name="name[]" value="AUG"/>
              <span  style=" cursor: pointer;" class="input-group-text"><i data-feather="calendar"></i></span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_start[]" placeholder="Start" aria-label="Start">
  <span  style=" cursor: pointer;" class="input-group-text">TO</span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_end[]" placeholder="End" aria-label="End">
</div>
          <div class="input-group mb-3 reportrange sep">
              <input style=" cursor: pointer; width: 100px;text-align: left" class="input-group-text" readonly name="name[]" value="SEP"/>
              <span  style=" cursor: pointer;" class="input-group-text"><i data-feather="calendar"></i></span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_start[]" placeholder="Start" aria-label="Start">
  <span  style=" cursor: pointer;" class="input-group-text">TO</span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_end[]" placeholder="End" aria-label="End">
</div>
          <div class="input-group mb-3 reportrange oct">
              <input style=" cursor: pointer; width: 100px;text-align: left" class="input-group-text" readonly name="name[]" value="OCT"/>
              <span  style=" cursor: pointer;" class="input-group-text"><i data-feather="calendar"></i></span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_start[]" placeholder="Start" aria-label="Start">
  <span  style=" cursor: pointer;" class="input-group-text">TO</span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_end[]" placeholder="End" aria-label="End">
</div>
          <div class="input-group mb-3 reportrange nov">
              <input style=" cursor: pointer; width: 100px;text-align: left" class="input-group-text" readonly name="name[]" value="NOV"/>
              <span  style=" cursor: pointer;" class="input-group-text"><i data-feather="calendar"></i></span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_start[]" placeholder="Start" aria-label="Start">
  <span  style=" cursor: pointer;" class="input-group-text">TO</span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_end[]" placeholder="End" aria-label="End">
</div>
                  <div class="input-group mb-3 reportrange dec">
                      <input style=" cursor: pointer; width: 100px;text-align: left" class="input-group-text" readonly name="name[]" value="DEC"/>
              <span  style=" cursor: pointer;" class="input-group-text"><i data-feather="calendar"></i></span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_start[]" placeholder="Start" aria-label="Start">
  <span  style=" cursor: pointer;" class="input-group-text">TO</span>
  <input style=" cursor: pointer;" readonly type="text" class="form-control" name="input_end[]" placeholder="End" aria-label="End">
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

    