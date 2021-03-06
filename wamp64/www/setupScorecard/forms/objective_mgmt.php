<?php    if ($_SESSION[base64_encode("role")] == base64_encode('administrator')||$_SESSION[base64_encode("role")] == base64_encode('moderator') ){ ?>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Objective Management</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
              
            
            <button accesskey="q" type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_addobjective">  <i class="bi bi-plus"></i> Add</button>
            <button accesskey="w" type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_editobjective">  <i class="bi bi-pencil"></i> Edit</button>
            <button accesskey="r" type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_removeobjective">  <i class="bi bi-trash"></i> Remove</button>
            
            
          </div>
      
        </div>
      </div>

 
 
      <div class="table-responsive">
          
         
        <table id ="tbl_objectivelist" class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Objective </th>
              <th>Outcome</th>
              <th>Category </th>
             
          
              
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
        
        
                            
    var d = new serverData("<?php /*URL in based64*/ echo base64_encode('beans=json/getobjective'); ?>",
    
    // use the folowing format for sending data in http request
                                                                        [
                                                                          
                                                                            {
                                                                             name:"search",
                                                                             value:search
                                                                            }
                                                                        ]
                                                                                );// 1st parameter is the beans name; 2nd parameter is the data, in serializedArray format
    
    
    d.done(function(xhr){
       var tbody = $('#tbl_objectivelist').find('tbody').empty();
       
     
       
        var  item_no = 0;
    
      
 
     
     
       $.each(xhr,function(i,v){
           
       
           item_no++;
           tbody.append('<tr><td>\n\
   <input class="form-check-input" type="checkbox" name="objectiveid[]" value="'+v.object_id+'"> \n\
    '+item_no+'</td><td>'+v.objective_name+'</td><td>'+v.outcome_name+'</td><td>'+v.category_name+'</td></tr>')
           
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
    
     $('#modal_addobjective').on('show.bs.modal',function(e){
        var modal = $(this);
        
          if(typeof localStorage.getItem('categorydata')!= 'undefined'){
        
        var catjson = JSON.parse(localStorage.getItem('categorydata'));
        var ss =modal.find('select[name="input_category"]').empty();
        ss.append('<option selected  disabled>Select Category...</option>');    
        $.each(catjson,function(i,v){
       ss.append('<option value="'+v.id+'">'+v.name+'</option>');    
        });
        
    }
        
        
        
    })
    $(document).on('change','.categorychange',function(){
        var id =$(this).val();
        var outcome_dd = $('.outcome_sel').empty();
           var outcomelist = new serverData("<?php /*URL in based64*/ echo base64_encode('beans=json/getoutcome_by_id'); ?>",[{name:"catid",value:id}]);
           outcomelist.done(function(xhr){
               outcome_dd.append('<option selected  disabled>Select Outcome...</option>')
            $.each(xhr,function(i,v){
                outcome_dd.append('<option value="'+v.id+'" >'+v.outcome_name+'</option>');    
                
            })
               
           })
           
           
   
       categorylist.done(function(xhr){
           localStorage.setItem('categorydata',JSON.stringify(xhr))
           
       })
    
    
    
    })
    
    
    
    $('#modal_editobjective').on('show.bs.modal',function(e){
        var modal = $(this);
        var checked = $('#tbl_objectivelist').find('tbody>tr>td>input[name="objectiveid[]"]:checked').parent('td').parent('tr');
        
       modal.find('div.modal-body').empty();

        
        if(checked.length>0){

            $.each(checked,function(i,v){
                
              
                var r = $(v).find('td');
           
               var set = '<div><hr class="dropdown-divider"><h6>'+(i+1)+' '+$(r.eq(1)[0]).text()+'</h6>'+
             
          
 ' <div class="form-floating mb-3">'+
 ' <input  type="text" class="form-control" id="edit_id'+(i+1)+'" name="edit_id[]" readonly required value="'+$(r.eq(0)[0]).find('input').val()+'" placeholder="#####">'+
 ' <label for="edit_id'+(i+1)+'">ID</label>'+
'</div>'+
 ' <div class="form-floating mb-3">'+
 ' <input  type="text" class="form-control" id="edit_objectivename'+(i+1)+'" name="edit_objectivename[]"  required value="'+$(r.eq(1)[0]).text()+'" placeholder="#####">'+
 ' <label for="edit_objectivename'+(i+1)+'">Objective Name</label>'+
'</div>'+
 '<div class="form-control-dark mb-3">'+
  '   <select class="form-select categorychange" name="edit_category[]" aria-label="Select Category...">'+
   '      <option selected  disabled>Select Category...</option>'

     if(typeof localStorage.getItem('categorydata')!= 'undefined'){
        
        var catjson = JSON.parse(localStorage.getItem('categorydata'));
    
        $.each(catjson,function(i,v){
      set +='<option value="'+v.id+'">'+v.name+'</option>';    
        });
        
    }

set +='</select>     '+
 '          </div>'+
 '<div class="form-control-dark mb-3">'+
  '   <select class="form-select outcome_sel" name="edit_outcome[]" aria-label="Select Category...">'+
   '      <option selected  disabled>Select Outcome...</option>'+

'</select>     '+
 '          </div>'+
          
          
      '     </div>    ';
      
      set = $(set);
      //set.find('select[name="edit_objective[]"]').val(r.eq(5)[0].innerText)
      

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
    $('#modal_removeobjective').on('show.bs.modal',function(e){
        var modal = $(this);
        var checked = $('#tbl_objectivelist').find('input[name="objectiveid[]"]').serializeArray();
        
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

include_once './includes/objective.modals.php';
  }
?>