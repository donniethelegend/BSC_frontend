<?php    if ($_SESSION[base64_encode("role")] == base64_encode('administrator')||$_SESSION[base64_encode("role")] == base64_encode('moderator') ){ ?>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Category Management</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
              
            
            <button accesskey="q" type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_addcategory">  <i class="bi bi-plus"></i> Add</button>
            <button accesskey="w" type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_editcategory">  <i class="bi bi-pencil"></i> Edit</button>
            <button accesskey="r" type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_removecategory">  <i class="bi bi-trash"></i> Remove</button>
            
            
          </div>
      
        </div>
      </div>

 
 
      <div class="table-responsive">
          
         
        <table id ="tbl_categorylist" class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Category </th>
              <th>Goal </th>
          
              
            </tr>
          </thead>
          <tbody>
         
          </tbody>
        </table>
         
      </div>
 
  <script>
   

$(document).ready(function(){
    
    
    
    
    
    
    
    
    
    
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


    
    
    
    
    function loadTable(){
      
        var search = "";
        
     
        if(typeof $.cookie('search') != 'undefined'){
        search =     $.cookie('search');
         $('.search-bar').val(search);
            
        }
        
        
                            
    var d = new serverData("<?php /*URL in based64*/ echo base64_encode('beans=json/getcategory'); ?>",
    
    // use the folowing format for sending data in http request
                                                                        [
                                                                          
                                                                            {
                                                                             name:"search",
                                                                             value:search
                                                                            }
                                                                        ]
                                                                                );// 1st parameter is the beans name; 2nd parameter is the data, in serializedArray format
    
    
    d.done(function(xhr){
       var tbody = $('#tbl_categorylist').find('tbody').empty();
       
     
       
        var  item_no = 0;
    
      
 
     
     
       $.each(xhr,function(i,v){
           
       
           item_no++;
           tbody.append('<tr><td>\n\
   <input class="form-check-input" type="checkbox" name="categoryid[]" value="'+v.id+'"> \n\
    '+item_no+'</td><td>'+v.name+'</td><td>'+v.goal+'</td></tr>')
           
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
   
     
     
 }
    
}
if(typeof json_rs.table_reload!='undefined'){
    if(json_rs.table_reload){
        
    
          loadTable();
        
        
    }
    
    
    
}
     
    });
    
    
    
    
    $('#modal_editcategory').on('show.bs.modal',function(e){
        var modal = $(this);
        var checked = $('#tbl_categorylist').find('tbody>tr>td>input[name="categoryid[]"]:checked').parent('td').parent('tr');
        
       modal.find('div.modal-body').empty();

        
        if(checked.length>0){

            $.each(checked,function(i,v){
                
              
                var r = $(v).find('td');
           
               var set = $('<div><hr class="dropdown-divider"><h6>'+(i+1)+' '+$(r.eq(1)[0]).text()+'</h6>'+
             
          
 ' <div class="form-floating mb-3">'+
 ' <input  type="text" class="form-control" id="edit_id'+(i+1)+'" name="edit_id[]" readonly required value="'+$(r.eq(0)[0]).find('input').val()+'" placeholder="#####">'+
 ' <label for="edit_id'+(i+1)+'">ID</label>'+
'</div>'+
 ' <div class="form-floating mb-3">'+
 ' <input  type="text" class="form-control" id="edit_categoryname'+(i+1)+'" name="edit_categoryname[]"  required value="'+$(r.eq(1)[0]).text()+'" placeholder="#####">'+
 ' <label for="edit_categoryname'+(i+1)+'">Category Name</label>'+
'</div>'+
 ' <div class="form-floating mb-3">'+
 ' <textarea  class="form-control" id="edit_categorygoal'+(i+1)+'" name="edit_categorygoal[]"  required placeholder="#####">'+$(r.eq(2)[0]).text()+'</textarea>'+
 ' <label for="edit_categorygoal'+(i+1)+'">Goal</label>'+
'</div>'+
          
          
      '     </div>    ');
      //set.find('select[name="edit_category[]"]').val(r.eq(5)[0].innerText)
      

    //  set.find('select[name="edit_role[]"]').val(r.eq(7)[0].innerText)
      
                
                modal.find('div.modal-body').append(set);





            })
        
            modal.find('button[type=submit]').removeProp('disabled');
            }
            else {
        
            modal.find('div.modal-body').html('<h6>No Item/s selected!</h6>');
            
                modal.find('button[type=submit]').prop('disabled',true);
         
            
            }
        
    })
    $('#modal_removecategory').on('show.bs.modal',function(e){
        var modal = $(this);
        var checked = $('#tbl_categorylist').find('input[name="categoryid[]"]').serializeArray();
        
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

include_once './includes/category.modals.php';
  }
?>