<?php if ($_SESSION[base64_encode("role")] == base64_encode('administrator') ){ ?>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Signatories</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
              
            
              <select class="btn btn-sm btn-outline-secondary page-limit"><option value="10">10/Page</option><option value="20">20/Page</option><option value="50">50/Page</option><option value="100">100/Page</option></select>
              <button accesskey="q" type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_addsignatories">  <i class="bi bi-plus"></i> Add</button>
              <button accesskey="w" type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_editsignatories">  <i class="bi bi-pencil"></i> Edit</button>
              <button accesskey="r" type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_removesignatories">  <i class="bi bi-trash"></i> Remove</button>
            
            
          </div>
      
        </div>
      </div>

 
 
      <div class="table-responsive">
          
         
        <table id ="tbl_signatorieslist" class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              
              <th>Fullname</th>
              <th>Position</th>
              <th>Status</th>
             
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
        var provinces = new serverData("<?php /*URL in based64*/ echo base64_encode('beans=json/getprovinces'); ?>",null);
   
       provinces.done(function(xhr){
          // $.cookie('indicatordata',JSON.stringify(xhr));
           localStorage.setItem('provincedata',JSON.stringify(xhr))
           
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
        
        
                            
    var d = new serverData("<?php /*URL in based64*/ echo base64_encode('beans=json/getsignatures'); ?>",
    
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
       var tbody = $('#tbl_signatorieslist').find('tbody').empty();
       
       
 

        $.cookie('totalpage',((xhr[0].total/limit)>(parseInt(xhr[0].total/limit))?parseInt(xhr[0].total/limit)+1:parseInt(xhr[0].total/limit)));   
    
 
    
       
       
       $('.pagination').empty();
       var pagetot = $.cookie('totalpage');
       var pagen = 0;
       $('.pagination').append($('  <li class="page-item"><a class="page-link page-previous"  >Previous</a></li>'))    
       
       for(i=1;i<=pagetot;i++){
           pagen =((i*parseInt(limit))-limit);
         
       $('.pagination').append($('  <li class="page-item  '+(offset==pagen?"active":"")+'"><a class="page-link page-number" data-page="'+pagen+'" >'+i+'</a></li>'))    
       }
       $('.pagination').append($('  <li class="page-item"><a class="page-link page-next"  >Next</a></li>'))    
       
       
        var  item_no = 0;
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
     
     
       $.each(xhr,function(i,v){
           
       
           item_no++;
           tbody.append('<tr><td>\n\
   <input class="form-check-input" type="checkbox" name="id[]" value="'+v.id+'"> \n\
    '+item_no+'</td><td>'+v.fullname+'</td><td>'+v.position+'</td><td>'+v.status+'</td></tr>')
           
       })
       
       
       
       
       
      
        
    })
    
    } 
    
       loadTable();
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
    $(document).ajaxComplete(function( event, xhr, settings ) {
    var json_rs = xhr.responseJSON;
    console.log(xhr)
if(typeof json_rs.close_modal!='undefined'){
    if(json_rs.close_modal==true){
        $('.modal').modal('hide');
        
 }
 else {
     
     
     $(json_rs.close_modal).modal('hide');
    // $('#modal_addsignatories').modal('hide');
     
   //  $('#modal_removesignatories').modal('hide');
     
     
 }
    
}
if(typeof json_rs.table_reload!='undefined'){
    if(json_rs.table_reload){
        
    
          loadTable();
        
        
    }
    
    
    
}
     
    });
    
    
    
    
    $('#modal_addsignatories').on('show.bs.modal',function(e){
        
        
        var modal = $(this);
        if(typeof localStorage.getItem('provincedata')!= 'undefinced'){
    var pdata =  JSON.parse(localStorage.getItem('provincedata'));
    var  option  = $('select[name="input_province"]').empty();
    option.append('<option selected  disabled>Select Province...</option>');
    $.each(pdata,function(i,v){
        
        
            option.append(' <option value="'+v.province_name+'">'+v.province_code+'</option>');
    })
    
    
    
}
        
    })
    $('#modal_editsignatories').on('show.bs.modal',function(e){
        var modal = $(this);
        var checked = $('#tbl_signatorieslist').find('tbody>tr>td>input[name="id[]"]:checked').parent('td').parent('tr');
        
       modal.find('div.modal-body').empty();

        
        if(checked.length>0){

            $.each(checked,function(i,v){
                var r = $(v).find('td');
                console.log(r.eq(1)[0].innerText)
               var set = '<div><hr class="dropdown-divider"><h6>'+(i+1)+' '+r.eq(1)[0].innerText+'</h6>'+
             
          
 ' <div class="form-floating mb-3">'+
 ' <input  type="text" class="form-control" id="edit_id'+(i+1)+'" name="edit_id[]" readonly required value="'+$(r.eq(0)[0]).find('input').val()+'" placeholder="#####">'+
 ' <label for="edit_id'+(i+1)+'">ID</label>'+
'</div>'+
  ' <div class="form-floating mb-3">'+
  '<input type="text" class="form-control" id="edit_lname'+(i+1)+'" name="edit_fullname[]" required value="'+r.eq(1)[0].innerText+'" placeholder="Gallocanta">'+
  '<label for="edit_fname'+(i+1)+'">Last Name</label>'+
'</div>\n\
<div class="form-control-dark mb-3">\n\
<select class="form-select" name="edit_position[]" aria-label="Select System Role...">\n\
<option value="Regional Director">Regional Director</option>\n\
<option value="ARD Finance and Administrative Service">ARD Finance and Administrative Service</option>\n\
<option value="ARD Field Operations">ARD Field Operations</option>\n\
<option value="ARD for Technical Services">ARD for Technical Services</option>\n\
</select></div>    <div class="form-control-dark mb-3">\n\
<select class="form-select" name="edit_status[]" aria-label="Select System Role...">\n\
<option value="active">Active</option>\n\
<option value="inactive">Inactive</option>\n\
</select></div>    ';
      
      
      set = $(set);
 

      set.find('select[name="edit_position[]"]').val(r.eq(2)[0].innerText)
      set.find('select[name="edit_status[]"]').val(r.eq(3)[0].innerText)
      
                
                modal.find('div.modal-body').append(set);





            })
        
            modal.find('button[type=submit]').removeProp('disabled');
            }
            else {
        
            modal.find('div.modal-body').html('<h6>No Item/s selected!</h6>');
            
                modal.find('button[type=submit]').prop('disabled',true);
         
            
            }
        
    })
    $('#modal_removesignatories').on('show.bs.modal',function(e){
        var modal = $(this);
        var checked = $('#tbl_signatorieslist').find('input[name="id[]"]').serializeArray();
        
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

include_once './includes/signatories.modals.php';
  }
?>