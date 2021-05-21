<?php    if ($_SESSION[base64_encode("role")] == base64_encode('administrator')||$_SESSION[base64_encode("role")] == base64_encode('moderator') ){ ?>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Target/Commitment Management</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          
              
             <div class="col-md-6 form-floating">
 
    <select id="province_dd" class="form-control">
                  
              </select>
              
              <label for="province_dd">Select Province:</label>
  </div>
         <div class="form-floating col-md-6 ">
              
              <select id="year_dd" class="form-control">
                  
              </select>
               <label for="year_dd">Select Year:</label>
          </div>
          
        
              
              <button class="form-control btn btn-success loadcontent" > Load Content</button>
        
        
      
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
    
      $(document).on('click', '.loadcontent',function(){
     
        loadTable();
    })
    
    
     var province_list    = new serverData("<?php /*URL in based64*/ echo base64_encode('beans=json/getprovinces'); ?>"  );// 1st parameter is the beans name; 2nd parameter is the data, in serializedArray format
     var year_list    = new serverData("<?php /*URL in based64*/ echo base64_encode('beans=json/getyear_from_deadlines'); ?>"  );// 1st parameter is the beans name; 2nd parameter is the data, in serializedArray format
    
    
    province_list.done(function(xhr){
    var sel =  $('#province_dd').empty();
    var selected =  $.cookie('province_selection');
    $.each(xhr,function(i,v){
        
        sel.append('<option '+(v.id == selected?"selected":"")+' value='+v.id+'>'+v.province_name+'</option>')
        
    })
        
    })
    year_list.done(function(xhr){
       

    var sel =  $('#year_dd').empty();
    var selected =  $.cookie('year_selection');
    
    $.each(xhr,function(i,v){
        
        sel.append('<option '+(v.year == selected?"selected":"")+' value='+v.year+'>'+v.year+'</option>')
        
    })
        
    })
    
    
    $('#province_dd').change(function(){
        
        $.cookie('province_selection',$(this).val())
    })
    $('#year_dd').change(function(){
        
        $.cookie('year_selection',$(this).val())
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


    
    $(document).on('focus','.computable_q,.computable_p, .computable_r, .computable_b',function(){
         $(this).removeClass('is-invalid').next('div.invalid-feedback').remove();
    })
    $(document).on('change','.computable_q,.computable_p, .computable_r, .computable_b',function(){
       var ind_id = $(this).parents('tr').find('input').eq(0).val();
       var prov_id = $('#province_dd').val();
       var year_s = $('#year_dd').val();
      var quarter = $(this).data('quarter')
      var inp_el = $(this)
      var inp_val = null;
     
      var inp_type = $(this)[0].type
      if(inp_type === 'checkbox'){
          inp_val = inp_el.is(':checked')?"YES":"NO";
          
      }
      else{
       inp_val= $(this).val()
  }
      
     var save = new serverData("<?php /*URL in based64*/ echo base64_encode('beans=post/update_target'); ?>",
    
    // use the folowing format for sending data in http request
                                                                        [
                                                                          
                                                                            {
                                                                             name:"indicator",
                                                                             value:ind_id
                                                                            },
                                                                            {
                                                                             name:"province",
                                                                             value:prov_id
                                                                            },
                                                                            {
                                                                             name:"year",
                                                                             value:year_s
                                                                            },
                                                                            {
                                                                             name:"quarter",
                                                                             value:quarter
                                                                            },
                                                                            {
                                                                             name:"value",
                                                                             value:inp_val
                                                                            }
                                                                        ]
                                                                                );
                                                                        
  save.done(function(xhr){

 
 if(xhr.status){
 inp_el.addClass('is-valid').after('<div class="valid-feedback">Saved</div>');
 setTimeout(function(){ 
 inp_el.removeClass('is-valid').next('div.valid-feedback').remove();
    }, 1000);
  }else{
      inp_el.addClass('is-invalid').after('<div class="invalid-feedback">Failed</div>');

      
  }
  
  
 })
      
    });
    
    
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
 
    res  += $(v).val()!=''? parseInt($(v).val()):0;// devided by 4 for 4 quarters
    
    row.find('label').text(res+"%")
    
    
})
    })
    $(document).on('change','.computable_r',function(){
        
var row = $(this).parent('td').parent('tr');        
var inpt = row.find('input.computable_r');
var res = 0;
$.each(inpt,function(i,v){
 
    res  += $(v).val()!=''? parseInt($(v).val()):0;// devided by 4 for 4 quarters
    
    row.find('label').text(res/4 +"Ave")
    
    
})
    })
    
    
  
    
    function loadTable(){
      
        var search = "";
        
     
        if(typeof $.cookie('search') != 'undefined'){
        search =     $.cookie('search');
         $('.search-bar').val(search);
            
        }
        
          var prov_id = $.cookie('province_selection');
          var year_s = $.cookie('year_selection');
       
                            
    var d = new serverData("<?php /*URL in based64*/ echo base64_encode('beans=json/getindicators_with_target_commitment'); ?>",
    
    // use the folowing format for sending data in http request
                                                                        [
                                                                          
                                                                            {
                                                                             name:"province",
                                                                             value:prov_id
                                                                            },
                                                                            {
                                                                             name:"year",
                                                                             value:year_s
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
           row += "<tr><td colspan=7  style='background-color:#a8b9e3'><b>"+v.cat_name+"</b><br/><i>Goal: "+v.goal+"</i></td></tr>";
          category= v.cat_id;
    
           
       }
       
       if(v.out_id !== outcome){
            row += "<tr><td colspan=7 style='background-color:#aeb0b5;' ><b>"+v.out_name+"</b></td></tr>";
            outcome = v.out_id;
                 cc=1;
       }
       if(v.obj_id !== objective){           
           
      
       
            row += '<tr ><td rowspan="'+(parseInt(v.countme)+1)+'" style="background-color:#b9bdc4;max-width:100px;"><b>'+v.obj_name+'</p></b></td>'+(parseInt(v.countme)>=1?(parseInt(v.countme)<=5?"<td colspan=6>":""):"")+'</tr>';
            objective = v.obj_id;
    
      
       }
        
    
        if(v.id!==null&&v.id !== indicator && v.indicator_name !== null){
            
            var inp = "";
            
            if(v.sub1_id === null){
                
                switch(v.type){
                    
            case 'quantity':
                inp ="<td > <input data-quarter ='q1'  type='number' class='form-control  computable_q' value='"+v.q1target+"' /></td>\n\
                    <td ><input data-quarter ='q2' type='number' class='form-control computable_q' value='"+v.q2target+"'  /> </td>\n\
                    <td ><input data-quarter ='q3' type='number' class='form-control computable_q' value='"+v.q3target+"' /> </td>\n\
                    <td ><input data-quarter ='q4' type='number' class='form-control computable_q' value='"+v.q4target+"' /> </td>\n\
                    <td ><label> "+((v.q1target!=null?parseInt(v.q1target):0)+
                                (v.q2target!=null?parseInt(v.q2target):0)+
                                (v.q3target!=null?parseInt(v.q3target):0)+
                                (v.q4target!=null?parseInt(v.q4target):0))+" </label></td>";
            break;
            case  'percentage':
                inp ="<td ><input data-quarter ='q1' type='number' min=1 max=100 class='form-control computable_p' value='"+v.q1target+"' /> </td>\n\
                    <td ><input data-quarter ='q2' type='number' min=1 max=100  class='form-control computable_p' value='"+v.q2target+"' /> </td>\n\
                    <td ><input data-quarter ='q3' type='number' min=1 max=100  class='form-control computable_p' value='"+v.q3target+"' /> </td>\n\
                    <td ><input data-quarter ='q4' type='number' min=1 max=100  class='form-control computable_p' value='"+v.q4target+"' /> </td>\n\
                    <td ><label> "+((v.q1target!=null?parseInt(v.q1target):0)+
                                (v.q2target!=null?parseInt(v.q2target):0)+
                                (v.q3target!=null?parseInt(v.q3target):0)+
                                (v.q4target!=null?parseInt(v.q4target):0))+"%</label></td>";
                break;
            case 'rating':
                  inp ="<td ><input data-quarter ='q1' type='number' min=1 max=5 class='form-control computable_r'  value='"+v.q1target+"' /> </td>\n\
                    <td ><input data-quarter ='q2'  type='number' min=1 max=5  class='form-control computable_r' value='"+v.q2target+"' /> </td>\n\
                    <td ><input data-quarter ='q3' type='number' min=1 max=5  class='form-control computable_r' value='"+v.q3target+"' /> </td>\n\
                    <td ><input data-quarter ='q4' type='number' min=1 max=5  class='form-control computable_r' value='"+v.q4target+"' /> </td>\n\
                    <td ><label> "+(((v.q1target!=null?parseInt(v.q1target):0)+
                                (v.q2target!=null?parseInt(v.q2target):0)+
                                (v.q3target!=null?parseInt(v.q3target):0)+
                                (v.q4target!=null?parseInt(v.q4target):0))/4)+" Ave</label></td>";
                break;
            case 'boolean':
                  inp ="<td >  <label class='form-check form-switch' ><input data-quarter ='q1' class='form-check-input computable_b' type='checkbox' "+(v.q1target=="YES"?"checked":"")+"  /> </label></td>\n\
                   <td >  <label class='form-check form-switch' ><input data-quarter ='q2' class='form-check-input computable_b' type='checkbox' "+(v.q2target=="YES"?"checked":"")+" /> </label></td>\n\
                    <td >  <label class='form-check form-switch' ><input data-quarter ='q3' class='form-check-input computable_b' type='checkbox' "+(v.q3target=="YES"?"checked":"")+" /> </label></td>\n\
                    <td >  <label class='form-check form-switch' ><input data-quarter ='q4' class='form-check-input computable_b' type='checkbox' "+(v.q4target=="YES"?"checked":"")+" /> </label></td>\n\
                    <td ><label>-</label></td>";
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
     <td style='font-style:"+v.style+";font-weight:"+v.style+"'>"+v.indicator_name+" <input name='id' value='"+v.id+"'  type='number' class='visually-hidden '/></td>"+inp+"</tr>";
         indicator = v.id;

}
         if(v.sub1_id!==null&&v.sub1_id !== indicator1&& v.sub1_indicator_name !== null){
               var inp = "";
            if(v.sub2_id === null){
             switch(v.sub1_type){
                    
            case 'quantity':
                inp ="<td > <input data-quarter ='q1'  type='number' class='form-control  computable_q' value='"+v.sub1_q1target+"' /></td>\n\
                    <td ><input data-quarter ='q2' type='number' class='form-control computable_q' value='"+v.sub1_q2target+"'  /> </td>\n\
                    <td ><input data-quarter ='q3' type='number' class='form-control computable_q' value='"+v.sub1_q3target+"' /> </td>\n\
                    <td ><input data-quarter ='q4' type='number' class='form-control computable_q' value='"+v.sub1_q4target+"' /> </td>\n\
                    <td ><label> "+((v.sub1_q1target!=null?parseInt(v.sub1_q1target):0)+
                                (v.sub1_q2target!=null?parseInt(v.sub1_q2target):0)+
                                (v.sub1_q3target!=null?parseInt(v.sub1_q3target):0)+
                                (v.sub1_q4target!=null?parseInt(v.sub1_q4target):0))+" </label></td>";
            break;
            case  'percentage':
                inp ="<td ><input data-quarter ='q1' type='number' min=1 max=100 class='form-control computable_p' value='"+v.sub1_q1target+"' /> </td>\n\
                    <td ><input data-quarter ='q2' type='number' min=1 max=100  class='form-control computable_p' value='"+v.sub1_q2target+"' /> </td>\n\
                    <td ><input data-quarter ='q3' type='number' min=1 max=100  class='form-control computable_p' value='"+v.sub1_q3target+"' /> </td>\n\
                    <td ><input data-quarter ='q4' type='number' min=1 max=100  class='form-control computable_p' value='"+v.sub1_q4target+"' /> </td>\n\
                    <td ><label> "+((v.sub1_q1target!=null?parseInt(v.sub1_q1target):0)+
                                (v.sub1_q2target!=null?parseInt(v.sub1_q2target):0)+
                                (v.sub1_q3target!=null?parseInt(v.sub1_q3target):0)+
                                (v.sub1_q4target!=null?parseInt(v.sub1_q4target):0))+"%</label></td>";
                break;
            case 'rating':
                  inp ="<td ><input data-quarter ='q1' type='number' min=1 max=5 class='form-control computable_r'  value='"+v.sub1_q1target+"' /> </td>\n\
                    <td ><input data-quarter ='q2'  type='number' min=1 max=5  class='form-control computable_r' value='"+v.sub1_q2target+"' /> </td>\n\
                    <td ><input data-quarter ='q3' type='number' min=1 max=5  class='form-control computable_r' value='"+v.sub1_q3target+"' /> </td>\n\
                    <td ><input data-quarter ='q4' type='number' min=1 max=5  class='form-control computable_r' value='"+v.sub1_q4target+"' /> </td>\n\
                    <td ><label> "+(((v.sub1_q1target!=null?parseInt(v.sub1_q1target):0)+
                                (v.sub1_q2target!=null?parseInt(v.sub1_q2target):0)+
                                (v.sub1_q3target!=null?parseInt(v.sub1_q3target):0)+
                                (v.sub1_q4target!=null?parseInt(v.sub1_q4target):0))/4)+" Ave</label></td>";
                break;
            case 'boolean':
                  inp ="<td >  <label class='form-check form-switch' ><input data-quarter ='q1' class='form-check-input computable_b' type='checkbox' "+(v.sub1_q1target=="YES"?"checked":"")+"  /> </label></td>\n\
                   <td >  <label class='form-check form-switch' ><input data-quarter ='q2' class='form-check-input computable_b' type='checkbox' "+(v.sub1_q2target=="YES"?"checked":"")+" /> </label></td>\n\
                    <td >  <label class='form-check form-switch' ><input data-quarter ='q3' class='form-check-input computable_b' type='checkbox' "+(v.sub1_q3target=="YES"?"checked":"")+" /> </label></td>\n\
                    <td >  <label class='form-check form-switch' ><input data-quarter ='q4' class='form-check-input computable_b' type='checkbox' "+(v.sub1_q4target=="YES"?"checked":"")+" /> </label></td>\n\
                    <td ><label>-</label></td>";
                break;
                
                
    
    }
                
            }else{
                inp ="<td ></td>\n\
<td ></td>\n\
<td ></td>\n\
<td ></td>\n\
<td ></td>";
                
            }
            
         row += "<tr> <td style='font-style:"+v.sub1_style+";font-weight:"+v.sub1_style+"'>&nbsp;&nbsp;&nbsp;"+v.sub1_indicator_name+"      <input name='id' value='"+v.sub1_id+"'  type='number' class='visually-hidden '/></td>"+inp+"</tr>";
         indicator1 = v.sub1_id;
     
        }
         if(v.sub2_id!==null&&v.sub2_id !== indicator2 && v.sub2_indicator_name !== null){
             var inp = "";
             
             switch(v.sub2_type){//ssdsdsd
                    
           case 'quantity':
                inp ="<td > <input data-quarter ='q1'  type='number' class='form-control  computable_q' value='"+v.sub2_q1target+"' /></td>\n\
                    <td ><input data-quarter ='q2' type='number' class='form-control computable_q' value='"+v.sub2_q2target+"'  /> </td>\n\
                    <td ><input data-quarter ='q3' type='number' class='form-control computable_q' value='"+v.sub2_q3target+"' /> </td>\n\
                    <td ><input data-quarter ='q4' type='number' class='form-control computable_q' value='"+v.sub2_q4target+"' /> </td>\n\
                    <td ><label> "+((v.sub2_q1target!=null?parseInt(v.sub2_q1target):0)+
                                (v.sub2_q2target!=null?parseInt(v.sub2_q2target):0)+
                                (v.sub2_q3target!=null?parseInt(v.sub2_q3target):0)+
                                (v.sub2_q4target!=null?parseInt(v.sub2_q4target):0))+" </label></td>";
            break;
            case  'percentage':
                inp ="<td ><input data-quarter ='q1' type='number' min=1 max=100 class='form-control computable_p' value='"+v.sub2_q1target+"' /> </td>\n\
                    <td ><input data-quarter ='q2' type='number' min=1 max=100  class='form-control computable_p' value='"+v.sub2_q2target+"' /> </td>\n\
                    <td ><input data-quarter ='q3' type='number' min=1 max=100  class='form-control computable_p' value='"+v.sub2_q3target+"' /> </td>\n\
                    <td ><input data-quarter ='q4' type='number' min=1 max=100  class='form-control computable_p' value='"+v.sub2_q4target+"' /> </td>\n\
                    <td ><label> "+((v.sub2_q1target!=null?parseInt(v.sub2_q1target):0)+
                                (v.sub2_q2target!=null?parseInt(v.sub2_q2target):0)+
                                (v.sub2_q3target!=null?parseInt(v.sub2_q3target):0)+
                                (v.sub2_q4target!=null?parseInt(v.sub2_q4target):0))+"%</label></td>";
                break;
            case 'rating':
                  inp ="<td ><input data-quarter ='q1' type='number' min=1 max=5 class='form-control computable_r'  value='"+v.sub2_q1target+"' /> </td>\n\
                    <td ><input data-quarter ='q2'  type='number' min=1 max=5  class='form-control computable_r' value='"+v.sub2_q2target+"' /> </td>\n\
                    <td ><input data-quarter ='q3' type='number' min=1 max=5  class='form-control computable_r' value='"+v.sub2_q3target+"' /> </td>\n\
                    <td ><input data-quarter ='q4' type='number' min=1 max=5  class='form-control computable_r' value='"+v.sub2_q4target+"' /> </td>\n\
                    <td ><label> "+(((v.sub2_q1target!=null?parseInt(v.sub2_q1target):0)+
                                (v.sub2_q2target!=null?parseInt(v.sub2_q2target):0)+
                                (v.sub2_q3target!=null?parseInt(v.sub2_q3target):0)+
                                (v.sub2_q4target!=null?parseInt(v.sub2_q4target):0))/4)+" Ave</label></td>";
                break;
            case 'boolean':
                  inp ="<td >  <label class='form-check form-switch' ><input data-quarter ='q1' class='form-check-input computable_b' type='checkbox' "+(v.sub2_q1target=="YES"?"checked":"")+"  /> </label></td>\n\
                   <td >  <label class='form-check form-switch' ><input data-quarter ='q2' class='form-check-input computable_b' type='checkbox' "+(v.sub2_q2target=="YES"?"checked":"")+" /> </label></td>\n\
                    <td >  <label class='form-check form-switch' ><input data-quarter ='q3' class='form-check-input computable_b' type='checkbox' "+(v.sub2_q3target=="YES"?"checked":"")+" /> </label></td>\n\
                    <td >  <label class='form-check form-switch' ><input data-quarter ='q4' class='form-check-input computable_b' type='checkbox' "+(v.sub2_q4target=="YES"?"checked":"")+" /> </label></td>\n\
                    <td ><label>-</label></td>";
                break;
                
            default:
                    inp ="<td ></td>\n\
                    <td ></td>\n\
                    <td ></td>\n\
                    <td ></td>\n\
                    <td ></td>";
    
    }
  
             
             
         row += "<tr> <td style='font-style:"+v.sub2_style+";font-weight:"+v.sub2_style+"'    >&nbsp;&nbsp;&nbsp;&nbsp;"+v.sub2_indicator_name+"<input name='id' value='"+v.sub2_id+"'  type='number' class='visually-hidden '/> </td>"+inp+"</tr>";
    
         indicator2= v.sub2_id;
       
        }
       
        
        
   
       
      
       
        
       });
       
      
       tbody.html($(row))
       
       
      
        
    })
    
    } 
    
       loadTable();
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
    $(document).ajaxComplete(function( event, xhr, settings ) {
    var json_rs = xhr.responseJSON;
 if(json_rs){
if(typeof json_rs.close_modal!=='undefined'){
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