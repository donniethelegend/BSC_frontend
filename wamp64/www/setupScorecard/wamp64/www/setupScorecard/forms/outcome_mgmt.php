<?php    if ($_SESSION[base64_encode("role")] == base64_encode('administrator')||$_SESSION[base64_encode("role")] == base64_encode('moderator') ){ ?>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Outcome Management</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
              
            
              <button accesskey="q" type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_addoutcome">  <i class="bi bi-plus"></i> Add</button>
            <button accesskey="w" type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_editoutcome">  <i class="bi bi-pencil"></i> Edit</button>
            <button accesskey="r" type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_removeoutcome">  <i class="bi bi-trash"></i> Remove</button>
            
            
          </div>
      
        </div>
      </div>

 
 
      <div class="table-responsive">
          
         
        <table id ="tbl_outcomelist" class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Outcome</th>
              <th>Category</th>
              <th>Goal</th>
            </tr>
          </thead>
          <tbody>
         
          </tbody>
        </table>
         
      </div>
 
  <script>
   

$(document).ready(function(){
    
       var categorylist = new serverData("<?php /*URL in based64*/ echo base64_encode('beans=json/getcategory'); ?>",null);
   
       categorylist.done(function(xhr){
           localStorage.setItem('categorydata',JSON.stringify(xhr))
           
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


    
    
    
    
    function loadTable(){
      
        var search = "";
        
     
        if(typeof $.cookie('search') != 'undefined'){
        search =     $.cookie('search');
         $('.search-bar').val(search);
            
        }
        
        
                            
    var d = new serverData("<?php /*URL in based64*/ echo base64_encode('beans=json/getoutcome'); ?>",
    
    // use the folowing format for sending data in http request
                                                                        [
                                                                          
                                                                            {
                                                                             name:"search",
                                                                             value:search
                                                                            }
                                                                        ]
                                                                                );// 1st parameter is the beans name; 2nd parameter is the data, in serializedArray format
    
    
    d.done(function(xhr){
       var tbody = $('#tbl_outcomelist').find('tbody').empty();
       
     
       
        var  item_no = 0;
    
      
 
     
     
       $.each(xhr,function(i,v){
           
       
           item_no++;
           tbody.append('<tr><td>\n\
   <input class="form-check-input" type="checkbox" name="outcomeid[]" value="'+v.id+'"> \n\
    '+item_no+'</td><td>'+v.outcome_name+'</td>\n\
<td>'+v.category_name+'</td><td>'+v.category_goal+'</td></tr>')
           
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
    
    
    
    
    $('#modal_addoutcome').on('show.bs.modal',function(e){
        var modal = $(this);
        
          if(typeof localStorage.getItem('categorydata')!= 'undefined'){
        
        var catjson = JSON.parse(localStorage.getItem('categorydata'));
        var ss =modal.find('select[name="input_category"]').empty();
        ss.append('tion selected  disabled>Select Category...</option>');    
        $.each(catjson,function(i,v){
       ss.append('<option value="'+v.id+'">'+v.name+'</option>');    
        });
        
    }
        
        
        
    })
    
    
    
    
    
    $('#modal_editoutcome').on('show.bs.modal',function(e){
        var modal = $(this);
        var checked = $('#tbl_outcomelist').find('tbody>tr>td>input[name="outcomeid[]"]:checked').parent('td').parent('tr');
        
       modal.find('div.modal-body').empty();

        
        if(checked.length>0){

            $.each(checked,function(i,v){
                
              
                var r = $(v).find('td');
           var idsel = $(r.eq(0)[0]).find('input').val();
               var set = '<div><hr class="dropdown-divider"><h6>'+(i+1)+' '+$(r.eq(1)[0]).text()+'</h6>'+
             
          
 ' <div class="form-floating mb-3">'+
 ' <input  type="text" class="form-control" id="edit_id'+(i+1)+'" name="edit_id[]" readonly required value="'+$(r.eq(0)[0]).find('input').val()+'" placeholder="#####">'+
 ' <label for="edit_id'+(i+1)+'">ID</label></div>'+
 ' <div class="form-floating mb-3">'+
 ' <input  type="text" class="form-control" id="edit_outcomename'+(i+1)+'" name="edit_outcomename[]"  required value="'+$(r.eq(1)[0]).text()+'" placeholder="#####">'+
 ' <label for="edit_outcomename'+(i+1)+'">Outcome Name</label>'+
 ' </div>'+
          
 '  <div class="form-control-dark mb-3">'+
 '  <select class="form-select" name="edit_category[]" aria-label="Select Category...">'+
 '  <option selected  disabled>Select Category...</option>';
 
    if(typeof localStorage.getItem('categorydata')!= 'undefined'){
        
        var catjson = JSON.parse(localStorage.getItem('categorydata'));
        $.each(catjson,function(i,v){
        set+= '<option '+(idsel == v.id?"selected":"")+' value="'+v.id+'">'+v.name+'</option>';    
        });
        
    }
    
 
set +=' </select>     '+
   ' </div>'+
          
          
      '     </div>    ';
      
   set = $(set);
                modal.find('div.modal-body').append(set);





            })
        
            modal.find('button[type=submit]').removeProp('disabled');
            }
            else {
        
            modal.find('div.modal-body').html('<h6>No Item/s selected!</h6>');
            
                modal.find('button[type=submit]').prop('disabled',true);
         
            
            }
        
    })
    $('#modal_removeoutcome').on('show.bs.modal',function(e){
        var modal = $(this);
        var checked = $('#tbl_outcomelist').find('input[name="outcomeid[]"]').serializeArray();
        
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

include_once './includes/outcome.modals.php';
  }
?>