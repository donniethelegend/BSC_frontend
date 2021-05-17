<div class="modal fade" id="modal_download_indicator" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Download</h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     <div class="modal-body ">
         <link href="./css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
       
   
       
      <div class="row">
    <div class="col-sm">
      <button class="form-control" id="dl_pdf">
<i class="fa fa-file-pdf-o"   style="font-size:24px"> PDF</i>
</button>
    </div>
    <div class="col-sm">
      <button class="form-control" id="dl_excel">
<i class="fa fa-file-excel-o"  style="font-size:24px"> EXCEL</i>
         </button>
    </div>
    <div class="col-sm">
           <button class="form-control" id="dl_word">
<i class="fa fa-file-word-o" style="font-size:24px"> WORD</i>
</button>
    </div>
  </div>


    </div>
        
        
        
        
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
      
      </div>
           
    </div>
  </div>
</div>
<div class="modal fade" id="modal_editindicator" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Indicator</h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form role="form"   action="<?php echo base64_encode("beans=post/editindicator"); ?>" method="POST">
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
<div class="modal fade" id="modal_addindicator" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Indicator</h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form role="form"   action="<?php echo base64_encode("beans=post/addindicator"); ?>" method="POST">
      <div class="modal-body ">
          
  <div class="form-floating mb-3">
      <textarea   style="min-height:100px;" class="form-control" id="input_indicatorname" name="input_indicatorname" placeholder="kwarog"></textarea>
  <label for="input_indicatorname">Indicator Name</label>
</div>

           
          
 
           <div class="form-control-dark mb-3">
     <select class="form-select" name="parent_indicator" aria-label="Select Province...">
         <option selected    value="noparent">No Parent</option>
  

</select>     
           </div>
           <div class="form-control-dark mb-3">
     <select class="form-select" name="input_objective" aria-label="Select Objective...">
         <option selected  disabled  >Select Objective...</option>
  

</select>     
           </div>
         
           <div class="form-control-dark mb-3">
               <input type="radio" class="btn-check" name="type_indicator" id="type_indicator_quantity" autocomplete="off" value='quantity' checked >
<label class="btn btn-outline-primary" for="type_indicator_quantity" data-toggle="tooltip" data-placement="top" title="Quantity" ><span  class="bi bi-cart-plus-fill"></span></label>
               <input type="radio" class="btn-check" name="type_indicator" id="type_indicator_percent" autocomplete="off" value='percentage'  >
<label class="btn btn-outline-primary" for="type_indicator_percent" data-toggle="tooltip" data-placement="top" title="Percentage" ><span class="bi bi-percent"></span></label>
               <input type="radio" class="btn-check" name="type_indicator" id="type_indicator_toggles" autocomplete="off" value='boolean'  >
<label class="btn btn-outline-primary" for="type_indicator_toggles" data-toggle="tooltip" data-placement="top" title="Yes/No" ><span class="bi bi-toggles"></span></label>
               <input type="radio" class="btn-check" name="type_indicator" id="type_indicator_rating" autocomplete="off" value='rating'  >
<label class="btn btn-outline-primary" for="type_indicator_rating" data-toggle="tooltip" data-placement="top" title="Rating" ><span class="bi bi-file-earmark-bar-graph"></span></label>
              

              
          
      </div>
          
          
           <div class="form-control-dark mb-3">
               <input type="radio" class="btn-check" name="textstyle_indicator" id="normal-outlined" autocomplete="off" value='normal' checked >
<label data-toggle="tooltip" data-placement="top" title="Normal Text"  class="btn btn-outline-secondary" for="normal-outlined"><span class="bi bi-type"></span></label>
               <input type="radio" class="btn-check" name="textstyle_indicator" id="bold-outlined" autocomplete="off" value='bold'  >
<label data-toggle="tooltip" data-placement="top" title="Bold Text" class="btn btn-outline-secondary" for="bold-outlined"><span class="bi bi-type-bold"></span></label>
               <input type="radio" class="btn-check" name="textstyle_indicator" id="italic-outlined" autocomplete="off" value='italic'>
<label data-toggle="tooltip" data-placement="top" title="Italic Text" class="btn btn-outline-secondary" for="italic-outlined"><span class="bi bi-type-italic"></span></label>
               <input type="radio" class="btn-check" name="textstyle_indicator" id="underline-outlined" autocomplete="off" value='underline'>
<label data-toggle="tooltip" data-placement="top" title="Underline Text"  class="btn btn-outline-secondary" for="underline-outlined"><span class="bi bi-type-underline"></span></label>

              
          
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
<div class="modal fade" id="modal_removeindicator" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Delete User</h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form role="form"   action="<?php echo base64_encode("beans=post/deleteindicator"); ?>" method="POST">
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