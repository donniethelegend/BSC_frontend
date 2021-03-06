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
          
         
        <table id ="tbl_indicatorslist" border="1" class="table table-sm">
          <thead>
            <tr>
              
                <th rowspan="2">STRATEGIC OBJECTIVE</th>
                <th rowspan="2"  >KEY PERFORMANCE INDICATOR(KPI)</th>
              <th colspan="4">ADJUSTED CY 2021 COMMITMENT</th>
              <th rowspan="2">FINAL DOST-1 FY 2021 TARGETS</th>
             
          
              
            </tr>
            <tr>
              
                <th >Q1</th>
                <th >Q2</th>
                <th >Q3</th>
                <th >Q4</th>
             
          
              
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


    
    $(document).on('change','.computable_q',function(){
        
var row = $(this).parent('td').parent('tr');        
var inpt = row.find('input.computable_q');
var res = 0;
$.each(inpt,function(i,v){
 
    res  += $(v).val()!=''? parseInt($(v).val()):0;
    
    row.find('label').text(res)
    
    
})
    })
    $(document).on('change','.computable_p',function(){
        
var row = $(this).parent('td').parent('tr');        
var inpt = row.find('input.computable_p');
var res = 0;
$.each(inpt,function(i,v){
 
    res  += $(v).val()!=''? (parseInt($(v).val())/4):0;// devided by 4 for 4 quarters
    
    row.find('label').text(res)
    
    
})
    })
    
    
    
    
    function loadTable(){
      
        var search = "";
        
     
        if(typeof $.cookie('search') != 'undefined'){
        search =     $.cookie('search');
         $('.search-bar').val(search);
            
        }
        
        
                            
    var d = new serverData("<?php /*URL in based64*/ echo base64_encode('beans=json/getindicators_withsubindicator'); ?>",
    
    // use the folowing format for sending data in http request
                                                                        [
                                                                          
                                                                            {
                                                                             name:"search",
                                                                             value:search
                                                                            }
                                                                        ]
                                                                                );// 1st parameter is the beans name; 2nd parameter is the data, in serializedArray format
    
    
    d.done(function(xhr){
        
        var tbody = $('#tbl_indicatorslist').find('tbody').html('');
       
     

        
    var category =null;
    var outcome = null;
    var objective =null;
    var indicator =null;
    var indicator1 =null;
    var indicator2 =null;
    var cc =0;
   
 
     var row = "";
  


    
       $.each(xhr,function(i,v){
        
         
         cc++;
       if(v.cat_id!==category){
           row += "<tr><td colspan=7><b>"+v.cat_name+"</b><br/><i>Goal: "+v.goal+"</i></td></tr>";
          category= v.cat_id;
    
           
       }
       
       if(v.out_id !== outcome){
            row += "<tr><td colspan=7 ><b>"+v.out_name+"</b></td></tr>";
            outcome = v.out_id;
                 cc=1;
       }
       if(v.obj_id !== objective){           
           
      
       
            row += '<tr ><td rowspan="'+(parseInt(v.countme)+1)+'" style="color:red;max-width:100px;"><b>'+v.obj_name+'</b></td></tr>';
            objective = v.obj_id;
    
      
       }
        
        
        
        
        if(v.id !== indicator && v.indicator_name !== null){
            
            var inp = "";
            if(v.sub1_id === null){
                switch(v.type){
                    
            case 'quantity':
                inp ="<td > <input name='q1_q"+v.id+"'  type='number' class='form-control computable_q'/> </td>\n\
                    <td ><input name='q2_q"+v.id+"' type='number' class='form-control computable_q'/> </td>\n\
                    <td ><input name='q3_q"+v.id+"' type='number' class='form-control computable_q'/> </td>\n\
                    <td ><input name='q4_q"+v.id+"' type='number' class='form-control computable_q'/> </td>\n\
                    <td ><label>auto sum here</label></td>";
            break;
            case  'percentage':
                inp ="<td ><input name='q1_p"+v.id+"' type='number' min=1 max=100 class='form-control computable_p'/> </td>\n\
                    <td ><input name='q2_p"+v.id+"' type='number' min=1 max=100  class='form-control computable_p'/> </td>\n\
                    <td ><input name='q3_p"+v.id+"' type='number' min=1 max=100  class='form-control computable_p'/> </td>\n\
                    <td ><input name='q4_p"+v.id+"' type='number' min=1 max=100  class='form-control computable_p'/> </td>\n\
                    <td ><label>auto sum here</label></td>";
                break;
            case 'rating':
                  inp ="<td ><input name='q1_r"+v.id+"' type='number' min=1 max=5 class='form-control computable_r'/> </td>\n\
                    <td ><input name='q2_r"+v.id+"'  type='number' min=1 max=5  class='form-control computable_r'/> </td>\n\
                    <td ><input name='q3_r"+v.id+"' type='number' min=1 max=5  class='form-control computable_r'/> </td>\n\
                    <td ><input name='q4_r"+v.id+"' type='number' min=1 max=5  class='form-control computable_r'/> </td>\n\
                    <td ><label>auto sum here</label></td>";
                break;
            case 'boolean':
                  inp ="<td ><label ><input name='q1_b"+v.id+"'  type='checkbox' value='yes' /> YES</label></td>\n\
                    <td ><label ><input name='q2_b"+v.id+"' type='checkbox' value='yes' /> YES</label></td>\n\
                    <td ><label ><input name='q3_b"+v.id+"' type='checkbox' value='yes' /> YES</label></td>\n\
                    <td ><label ><input name='q4_b"+v.id+"' type='checkbox' value='yes' /> YES</label></td>\n\
                    <td ><label>auto sum here</label></td>";
                break;
                
    
    }
            }else{
                inp ="<td ></td>\n\
<td ></td>\n\
<td ></td>\n\
<td ></td>\n\
<td ></td>";
                
            }
            
         row += "<tr> \n\
     <td style='font-style:"+v.style+";font-weight:"+v.style+"'>"+v.indicator_name+" <input name='id[]' value='"+v.id+"'  type='number' class='form-control '/></td>"+inp+"</tr>";
         indicator = v.id;

}
         if(v.sub1_id !== indicator1&& v.sub1_indicator_name !== null){
               var inp = "";
            if(v.sub2_id === null){
             switch(v.sub1_type){
                    
            case 'quantity':
                inp ="<td ><input name='q1_q"+v.sub1_id+"'  type='number' class='form-control computable_q'/> </td>\n\
                    <td ><input name='q2_q"+v.sub1_id+"' type='number' class='form-control computable_q'/> </td>\n\
                    <td ><input name='q3_q"+v.sub1_id+"' type='number' class='form-control computable_q'/> </td>\n\
                    <td ><input name='q4_q"+v.sub1_id+"' type='number' class='form-control computable_q'/> </td>\n\
                    <td ><label>auto sum here</label></td>";
            break;
            case  'percentage':
                inp ="<td ><input name='q1_p"+v.sub1_id+"' type='number' min=1 max=100 class='form-control computable_p'/> </td>\n\
                    <td ><input name='q2_p"+v.sub1_id+"' type='number' min=1 max=100  class='form-control computable_p'/> </td>\n\
                    <td ><input name='q3_p"+v.sub1_id+"' type='number' min=1 max=100  class='form-control computable_p'/> </td>\n\
                    <td ><input name='q4_p"+v.sub1_id+"' type='number' min=1 max=100  class='form-control computable_p'/> </td>\n\
                    <td ><label>auto sum here</label></td>";
                break;
            case 'rating':
                  inp ="<td ><input name='q1_r"+v.sub1_id+"' type='number' min=1 max=5 class='form-control computable_r'/> </td>\n\
                    <td ><input name='q2_r"+v.sub1_id+"'  type='number' min=1 max=5  class='form-control computable_r'/> </td>\n\
                    <td ><input name='q3_r"+v.sub1_id+"' type='number' min=1 max=5  class='form-control computable_r'/> </td>\n\
                    <td ><input name='q4_r"+v.sub1_id+"' type='number' min=1 max=5  class='form-control computable_r'/> </td>\n\
                    <td ><label>auto sum here</label></td>";
                break;
            case 'boolean':
                  inp ="<td ><label ><input name='q1_b"+v.sub1_id+"'  type='checkbox' value='yes' /> YES</label></td>\n\
                    <td ><label ><input name='q2_b"+v.sub1_id+"' type='checkbox' value='yes' /> YES</label></td>\n\
                    <td ><label ><input name='q3_b"+v.sub1_id+"' type='checkbox' value='yes' /> YES</label></td>\n\
                    <td ><label ><input name='q4_b"+v.sub1_id+"' type='checkbox' value='yes' /> YES</label></td>\n\
                    <td ><label>auto sum here</label></td>";
                break;
                
    
    }
                
            }else{
                inp ="<td ></td>\n\
<td ></td>\n\
<td ></td>\n\
<td ></td>\n\
<td ></td>";
                
            }
            
         row += "<tr> <td style='font-style:"+v.sub1_style+";font-weight:"+v.sub1_style+"'>&nbsp;&nbsp;&nbsp;"+v.sub1_indicator_name+"      <input name='id[]' value='"+v.sub1_id+"'  type='number' class='form-control '/></td>"+inp+"</tr>";
         indicator1 = v.sub1_id;
     
        }
         if(v.sub2_id !== indicator2 && v.sub2_indicator_name !== null){
             var inp = "";
             
             switch(v.sub2_type){
                    
            case 'quantity':
                inp ="<td > <input name='q1_q"+v.id+"'  type='number' class='form-control computable_q'/> </td>\n\
                    <td ><input name='q2_q"+v.sub2_id+"' type='number' class='form-control computable_q'/> </td>\n\
                    <td ><input name='q3_q"+v.sub2_id+"' type='number' class='form-control computable_q'/> </td>\n\
                    <td ><input name='q4_q"+v.sub2_id+"' type='number' class='form-control computable_q'/> </td>\n\
                    <td ><label>auto sum here</label></td>";
            break;
            case  'percentage':
                inp ="<td ><input name='q1_p"+v.sub2_id+"' type='number' min=1 max=100 class='form-control computable_p'/> </td>\n\
                    <td ><input name='q2_p"+v.sub2_id+"' type='number' min=1 max=100  class='form-control computable_p'/> </td>\n\
                    <td ><input name='q3_p"+v.sub2_id+"' type='number' min=1 max=100  class='form-control computable_p'/> </td>\n\
                    <td ><input name='q4_p"+v.sub2_id+"' type='number' min=1 max=100  class='form-control computable_p'/> </td>\n\
                    <td ><label>auto sum here</label></td>";
                break;
            case 'rating':
                  inp ="<td ><input name='q1_r"+v.sub2_id+"' type='number' min=1 max=5 class='form-control computable_r'/> </td>\n\
                    <td ><input name='q2_r"+v.sub2_id+"'  type='number' min=1 max=5  class='form-control computable_r'/> </td>\n\
                    <td ><input name='q3_r"+v.sub2_id+"' type='number' min=1 max=5  class='form-control computable_r'/> </td>\n\
                    <td ><input name='q4_r"+v.sub2_id+"' type='number' min=1 max=5  class='form-control computable_r'/> </td>\n\
                    <td ><label>auto sum here</label></td>";
                break;
            case 'boolean':
                  inp ="<td ><label ><input name='q1_b"+v.sub2_id+"'  type='checkbox' value='yes' /> YES</label></td>\n\
                    <td ><label ><input name='q2_b"+v.sub2_id+"' type='checkbox' value='yes' /> YES</label></td>\n\
                    <td ><label ><input name='q3_b"+v.sub2_id+"' type='checkbox' value='yes' /> YES</label></td>\n\
                    <td ><label ><input name='q4_b"+v.sub2_id+"' type='checkbox' value='yes' /> YES</label></td>\n\
                    <td ><label>auto sum here</label></td>";
                break;
            default:
                    inp ="<td ></td>\n\
                    <td ></td>\n\
                    <td ></td>\n\
                    <td ></td>\n\
                    <td ></td>";
    
    }
  
             
             
         row += "<tr> <td style='font-style:"+v.sub2_style+";font-weight:"+v.sub2_style+"'    >&nbsp;&nbsp;&nbsp;&nbsp;"+v.sub2_indicator_name+"<input name='id[]' value='"+v.sub2_id+"'  type='number' class='form-control '/> </td>"+inp+"</tr>";
    
         indicator2= v.sub2_id;
       
        }
       
        
        
   
       
      
       
        
       });
       
      
       tbody.html($(row))
       
       
      
        
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