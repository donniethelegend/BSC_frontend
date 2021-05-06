<?php    if ($_SESSION[base64_encode("role")] == base64_encode('administrator')||$_SESSION[base64_encode("role")] == base64_encode('moderator') ){ ?>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Indicator/s Management </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
              
            
              <select class="btn btn-sm btn-outline-secondary page-limit"><option value="10">10/Page</option><option value="20">20/Page</option><option value="50">50/Page</option><option value="100">100/Page</option></select>
              <button accesskey="q" type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_download_indicator">  <i class="bi bi-download"></i> Download</button>
              <button accesskey="q" type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_addindicator">  <i class="bi bi-plus"></i> Add</button>
            <button accesskey="w" type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_editindicator">  <i class="bi bi-pencil"></i> Edit</button>
            <button accesskey="r" type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_removeindicator">  <i class="bi bi-trash"></i> Remove</button>
            
            
          </div>
      
        </div>
      </div>

 
 
      <div class="table-responsive">
          
         
        <table id ="tbl_userlist" class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              
              <th>Indicator</th>
          
              <th>Objective</th>
              <th>Type</th>
              <th>Registration Date</th>
            </tr>
          </thead>
          <tbody>
         
          </tbody>
        </table>
         
      </div>
  <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link"  tabindex="-1" aria-disabled="true">Previous</a>
    </li>
    
    
    <li class="page-item"><a class="page-link" >1</a></li>
    <li class="page-item"><a class="page-link" >2</a></li>
    <li class="page-item"><a class="page-link" >3</a></li>
    
    
    <li class="page-item">
      <a class="page-link" >Next</a>
    </li>
  </ul>
</nav>
  <script>
   
   
 

$(document).ready(function(){
    
    
    
    
    
    $('#dl_pdf').click(function(){
        


           var parentss = new downloadfile("<?php /*URL in based64*/ echo base64_encode('beans=reports/indicators'); ?>",null,null);
       
   
    })
    
    
    
    
    
    
    
    
      var parents = new serverData("<?php /*URL in based64*/ echo base64_encode('beans=json/getindicators'); ?>",null);
   
       parents.done(function(xhr){
          // $.cookie('indicatordata',JSON.stringify(xhr));
           localStorage.setItem('indicatordata',JSON.stringify(xhr))
           
       })
      var objectives = new serverData("<?php /*URL in based64*/ echo base64_encode('beans=json/getobjective'); ?>",null);
   
       objectives.done(function(xhr){
          // $.cookie('indicatordata',JSON.stringify(xhr));
           localStorage.setItem('objectivedata',JSON.stringify(xhr))
           
       })
   
   
   
   
    $('.search-bar').keyup(function(){
        
        var search = $(this).val();

        if(search!=null){
        
        $.cookie('search',search);
        loadTable();
    }
    else{
        $.removeCookie('search');
        
    }
        
        
        
        
        
    })
    $('.page-limit').change(function(){
        
        var limit = $(this).val();
        $.cookie('limit',limit);
        $.cookie('offset',0);
        
        loadTable();
        
        
    })
    $(document).on('click','.page-number',function(){
  
        var offset = $(this).data('page');
    
        $.cookie('offset',offset);
        
        loadTable();
        
        
    })
    $(document).on('click','.page-previous',function(){
   
  var o =$.cookie('offset');
  

  if(0<o){
        var offset = parseInt($.cookie('offset')) - parseInt($.cookie('limit'))
    
        $.cookie('offset',offset);
        
        loadTable();
    }
        
        
    })
    $(document).on('click','.page-next',function(){
  var l =$.cookie('limit');
  var t =$.cookie('totalpage');
  var o =$.cookie('offset');
  

  if(((l*t)-l)>(o)){
        var offset = parseInt($.cookie('offset')) + parseInt($.cookie('limit'))
    
        $.cookie('offset',offset);
        
        loadTable();
    }
        
    })
    
    
    
    
    
    function loadTable(){
        var offset = 0;
        
        var limit = 10;
        var search = "";
        
        if(typeof $.cookie('offset') != 'undefined'){
        offset =     $.cookie('offset');
        
        
       
            
        }
        if(typeof $.cookie('limit') != 'undefined'){
        limit =     $.cookie('limit');
         $('.page-limit').val(limit);
            
        }
        if(typeof $.cookie('search') != 'undefined'){
        search =     $.cookie('search');
         $('.search-bar').val(search);
            
        }
        
        
                            
    var d = new serverData("<?php /*URL in based64*/ echo base64_encode('beans=json/getindicators'); ?>",
    
    // use the folowing format for sending data in http request
                                                                        [
                                                                            {
                                                                             name:"offset",
                                                                             value:offset
                                                                            },
                                                                            {
                                                                             name:"limit",
                                                                             value:limit
                                                                            },
                                                                            {
                                                                             name:"search",
                                                                             value:search
                                                                            }
                                                                        ]
                                                                                );// 1st parameter is the beans name; 2nd parameter is the data, in serializedArray format
    
    
    d.done(function(xhr){
       var tbody = $('#tbl_userlist').find('tbody').empty();
       
       

if(xhr.length>0){
        $.cookie('totalpage',((xhr[0].total/limit)>(parseInt(xhr[0].total/limit))?parseInt(xhr[0].total/limit)+1:parseInt(xhr[0].total/limit)));   
}


 
    
       
       
       $('.pagination').empty();
       var pagetot = $.cookie('totalpage');
       var pagen = 0;
       $('.pagination').append($('  <li class="page-item"><a class="page-link page-previous"  >Previous</a></li>'))    
       
       for(i=1;i<=pagetot;i++){
           pagen =((i*parseInt(limit))-limit);
         
       $('.pagination').append($('  <li class="page-item  '+(offset==pagen?"active":"")+'"><a class="page-link page-number" data-page="'+pagen+'" >'+i+'</a></li>'))    
       }
       $('.pagination').append($('  <li class="page-item"><a class="page-link page-next"  >Next</a></li>'))    
       
       
        var  item_no =0;
       if($('.search-bar').val()==""){
            if(typeof $.cookie('offset')!='undefined'){
         item_no = parseInt($.cookie('offset'));
           }
     else{
         item_no = 0;
     }
     }else{
         item_no = 0;
         
     }
     
     //Fill the table here
       $.each(xhr,function(i,v){
           
       
       
       
           item_no++;
           tbody.append('<tr><td>\n\
   <input class="form-check-input" type="checkbox" name="indicator_id[]" value="'+v.id+'"> \n\
    '+item_no+'</td><td style="font-style:'+v.style+';font-weight:'+v.style+'">'+v.indicator_name+'</td><td>'+v.objective_name+'</td><td>'+v.type+'</td><td>'+v.date_reg+'</td></tr>');
      

      
      
      })
       
       
       
       
       
      
        
    })
    
    } 
    
       loadTable();
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
    $(document).ajaxComplete(function( event, xhr, settings ) {
    var json_rs = xhr.responseJSON;
if(typeof json_rs.close_modal!='undefined'){
    if(json_rs.close_modal==true){
        $('.modal').modal('hide');
        
 }
 else {
     
     
     $(json_rs.close_modal).modal('hide');
    // $('#modal_adduser').modal('hide');
     
   //  $('#modal_removeuser').modal('hide');
     
     
 }
    
}
if(typeof json_rs.table_reload!='undefined'){
    if(json_rs.table_reload){
        
    
          loadTable();
        
        
    }
    
    
    
}
     
    });
    
    
    
    
    $('#modal_editindicator').on('show.bs.modal',function(e){
        var modal = $(this);
  
   
   
   
   
      var checked = $('#tbl_userlist').find('input[name="indicator_id[]"]').serializeArray();
        
       modal.find('div.modal-body').empty();
       
    if(checked.length > 0){
    var itm=new serverData("<?php /*URL in based64*/ echo base64_encode('beans=json/getindicator'); ?>",checked )


itm.done(function(xhr){
    

 
    
        if(xhr.length>0){

            $.each(xhr,function(i,v){
                
                
               var set = '<div><hr class="dropdown-divider"><h6> '+v.indicator_name+'</h6>'+
             
          
 ' <div class="form-floating mb-3">'+
 ' <input  type="email" class="form-control" id="edit_id'+(i+1)+'" name="edit_id[]" readonly required value="'+v.id+'" placeholder="#####">'+
 ' <label for="edit_id'+v.id+'">ID</label></div>   '+
          
  '<div class="form-floating mb-3">'+
 ' <textarea   style="min-height:100px;" class="form-control" id="input_indicatorname'+v.id+'" name="input_indicatorname'+v.id+'" placeholder="kwarog">'+v.indicator_name+'</textarea>'+
 ' <label for="input_indicatorname'+v.id+'">Indicator Name</label>'+
'</div>'+


  
 '          <div class="form-control-dark mb-3">'+
 '    <select class="form-select" name="parent_indicator'+v.id+'" aria-label="Select Province...">'+
 '        <option selected    value="noparent">No Parent</option>'+
  

'</select>     '+
  '         </div>'+
  '<div class="form-control-dark mb-3">'+
 '    <select class="form-select" name="input_objective'+v.id+'" aria-label="Select Objective...">'+
  '       <option selected  disabled  >Select Objective...</option>';
     if(typeof  localStorage.getItem('objectivedata')!='undefined'){
        var obja = JSON.parse(localStorage.getItem('objectivedata'));

        
    if(obja.length>0){
         $.each(obja,function(i,vv){
             set+= '<option '+(v.objective==vv.object_id?"selected":"")+' value='+vv.object_id+'  >'+vv.objective_name+'</option>';
         })
        
        
    }
    }
  
  
set +='</select>     '+
 '          </div>'+
  
         
 '          <div class="form-control-dark mb-3">'+
 '              <input type="radio" class="btn-check" name="type_indicator'+v.id+'" id="type_indicator_quantity'+v.id+'" autocomplete="off" value="quantity" '+(v.type=="quantity"?"checked":"")+' >'+
'<label class="btn btn-outline-primary" for="type_indicator_quantity'+v.id+'" data-toggle="tooltip" data-placement="top" title="Quantity" ><span  class="bi bi-cart-plus-fill"></span></label>'+
 '              <input type="radio" class="btn-check" name="type_indicator'+v.id+'" id="type_indicator_percent'+v.id+'" autocomplete="off" value="percentage"  '+(v.type=="percentage"?"checked":"")+' >'+
'<label class="btn btn-outline-primary" for="type_indicator_percent'+v.id+'" data-toggle="tooltip" data-placement="top" title="Percentage" ><span class="bi bi-percent"></span></label>'+
 '              <input type="radio" class="btn-check" name="type_indicator'+v.id+'" id="type_indicator_toggles'+v.id+'" autocomplete="off" value="boolean"'+(v.type=="boolean"?"checked":"")+' >'+
'<label class="btn btn-outline-primary" for="type_indicator_toggles'+v.id+'" data-toggle="tooltip" data-placement="top" title="Yes/No" ><span class="bi bi-toggles"></span></label>'+
           '<input type="radio" class="btn-check" name="type_indicator'+v.id+'" id="type_indicator_rating'+v.id+'" autocomplete="off" value="rating"  >'+
'<label class="btn btn-outline-primary" for="type_indicator_rating'+v.id+'" data-toggle="tooltip" data-placement="top" title="Rating" ><span class="bi bi-file-earmark-bar-graph"></span></label>'+
              

   '   </div>'+
  '         <div class="form-control-dark mb-3">'+
 '              <input type="radio" class="btn-check" name="textstyle_indicator'+v.id+'" id="normal-outlined'+v.id+'" autocomplete="off" value=normal '+(v.style=="normal"?"checked":"")+'>'+
'<label data-toggle="tooltip" data-placement="top" title="Normal Text"  class="btn btn-outline-secondary" for="normal-outlined'+v.id+'"><span class="bi bi-type"></span></label>'+
 '              <input type="radio" class="btn-check" name="textstyle_indicator'+v.id+'" id="bold-outlined'+v.id+'" autocomplete="off" value=bold  '+(v.style=="bold"?"checked":"")+'>'+
'<label data-toggle="tooltip" data-placement="top" title="Bold Text" class="btn btn-outline-secondary" for="bold-outlined'+v.id+'"><span class="bi bi-type-bold"></span></label>'+
 '              <input type="radio" class="btn-check" name="textstyle_indicator'+v.id+'" id="italic-outlined'+v.id+'" autocomplete="off" value=italic '+(v.style=="italic"?"checked":"")+'>'+
'<label data-toggle="tooltip" data-placement="top" title="Italic Text" class="btn btn-outline-secondary" for="italic-outlined'+v.id+'"><span class="bi bi-type-italic"></span></label>'+
 '              <input type="radio" class="btn-check" name="textstyle_indicator'+v.id+'" id="underline-outlined'+v.id+'" autocomplete="off" value=underline '+(v.style=="underline"?"checked":"")+'>'+
'<label data-toggle="tooltip" data-placement="top" title="Underline Text"  class="btn btn-outline-secondary" for="underline-outlined'+v.id+'"><span class="bi bi-type-underline"></span></label>'+
 '     </div>'+
'</div>     ';
     
     
     var set =$(set);
         var select = set.find('[name="parent_indicator'+v.id+'"]');
      
     
   if(typeof  localStorage.getItem('indicatordata')!='undefined'){
        var aa = JSON.parse(localStorage.getItem('indicatordata'));

        
    if(aa.length>0){
        select.empty();
        select.append('  <option selected  value="noparent">No Parent</option>');
        
   
        $.each(aa,function(i,vv){
            
            select.append('<option '+(vv.id==v.parent_id?"selected":"")+'  value="'+vv.id+'"><p style="font-style:'+vv.style+'font-weight:'+v.style+'">'+vv.indicator_name+'</p></option>');
        });
        
    }
    else{
        select.empty();
        select.append('  <option selected  value="noparent">No Parent</option>');
        
        
    }
    }
  
    
      
      
      
                
                modal.find('div.modal-body').append(set);





            })
        
            modal.find('button[type=submit]').removeProp('disabled');
            }
         
 
 
 
 
 
 
 
})

}
   else {
        
            modal.find('div.modal-body').html('<h6>No Item/s selected!</h6>');
            
                modal.find('button[type=submit]').prop('disabled',true);
         
            
            }


            
    })
    $(document).on('show.bs.modal','#modal_addindicator',function(e){
        var modal = $(this);
    
setTimeout(function() { $('#modal_addindicator').find('#input_indicatorname').focus() }, 500);
 
   var select = modal.find('[name="parent_indicator"]');
   var selectob = modal.find('[name="input_objective"]');
   
 if(typeof localStorage.getItem('indicatordata')!='undefined'){
        var aa = JSON.parse(localStorage.getItem('indicatordata'));
      
        
    if(aa.length>0){
        select.empty();
        select.append('  <option selected  value="noparent">No Parent</option>');
        $.each(aa,function(i,v){
            
            select.append('<option   value="'+v.id+'">'+v.indicator_name+'</option>');
        })
        
    }
    else{
        select.empty();
        select.append('  <option selected  value="noparent">No Parent</option>');
        
        
    }
    }
 if(typeof localStorage.getItem('objectivedata')!='undefined'){
        var objdd = JSON.parse(localStorage.getItem('objectivedata'));
      
        
    if(objdd.length>0){
        selectob.empty();
        selectob.append('  <option selected disabled >Select Objective...</option>');
        $.each(objdd,function(i,v){
            
            selectob.append('<option   value="'+v.object_id+'">'+v.objective_name+'</option>');
        })
        
    }
    else{
        selectob.empty();
        selectob.append('  <option selected  disabled >Select Objective...</option>');
        
        
    }
    }

   
   

   
   
   
   
        
    })
    $('#modal_removeindicator').on('show.bs.modal',function(e){
        var modal = $(this);
        var checked = $('#tbl_userlist').find('input[name="indicator_id[]"]').serializeArray();
        
        if(checked.length>0){
modal.find('div.items').empty();

            $.each(checked,function(i,v){
                modal.find('div.items').append('<input style="display:none" class=" form-check-input" checked type="checkbox" name="'+v.name+'" value="'+v.value+'">');

            })
            modal.find('h6').text('Do you really want to remove selected item/s?');
            modal.find('button[type=submit]').removeProp('disabled');
            }
            else {
            
            modal.find('h6').text('No Item/s selected!');
            
                modal.find('button[type=submit]').prop('disabled',true);
         
            
            }
        
    })
    
    
    })
      

    
  




    </script>
             
    
<?php 

include_once './includes/indicator.modals.php';
  }
?>