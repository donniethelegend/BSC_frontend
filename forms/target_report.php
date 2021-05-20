<?php    if ($_SESSION[base64_encode("role")] == base64_encode('administrator')||$_SESSION[base64_encode("role")] == base64_encode('moderator') ){ ?>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Print Target or Commitment</h1>
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
          
        
            <div class="btn-group col-12" role="group">
              <button class="form-control btn btn-success loadcontent" > <span data-feather="refresh-ccw"></span> Load Content</button>
              <button class="form-control btn btn-warning printtable" > <span data-feather="printer"></span> Print </button>
        
        
      
        </div>
        </div>
      </div>

 
 
      <div id="table_content" class="table-responsive">
         
         
        
        
              
         
        <table id ="tbl_indicatorslist" style="border-collapse:collapse;border-spacing:0" border="1" class="table table-sm">
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
      $(document).on('click', '.printtable',function(){
     quickprint('portrait','#table_content');
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
           row += "<tr><td colspan=7  ><b>"+v.cat_name+"</b><br/><i>Goal: "+v.goal+"</i></td></tr>";
          category= v.cat_id;
    
           
       }
       
       if(v.out_id !== outcome){
            row += "<tr><td colspan=7  ><b>"+v.out_name+"</b></td></tr>";
            outcome = v.out_id;
                 cc=1;
       }
       if(v.obj_id !== objective){           
           
      
       
            row += '<tr ><td rowspan="'+(parseInt(v.countme)+1)+'" style="max-width:100px;"><b>'+v.obj_name+'</b></td></tr>';
            objective = v.obj_id;
    
      
       }
        
    
        if(v.id !== indicator && v.indicator_name !== null){
            
            var inp = "";
            
            if(v.sub1_id === null){
                
                switch(v.type){
                    
            case 'quantity':
                inp ="<td > "+(v.q1target!=null?v.q1target:'-')+" </td>\n\
                    <td >"+(v.q2target!=null?v.q2target:'-')+"   </td>\n\
                    <td >"+(v.q3target!=null?v.q3target:'-')+" </td>\n\
                    <td >"+(v.q4target!=null?v.q4target:'-')+"  </td>\n\
                    <td >"+((v.q1target!=null?parseInt(v.q1target):0)+
                                (v.q2target!=null?parseInt(v.q2target):0)+
                                (v.q3target!=null?parseInt(v.q3target):0)+
                                (v.q4target!=null?parseInt(v.q4target):0))+" </td>";
            break;
            case  'percentage':
                inp ="<td >"+(v.q1target!=null?v.q1target:'-')+" </td>\n\
                    <td >"+(v.q2target!=null?v.q2target:'-')+" </td>\n\
                    <td >"+(v.q3target!=null?v.q3target:'-')+" </td>\n\
                    <td >"+(v.q4target!=null?v.q4target:'-')+" </td>\n\
                    <td > "+((v.q1target!=null?parseInt(v.q1target):0)+
                                (v.q2target!=null?parseInt(v.q2target):0)+
                                (v.q3target!=null?parseInt(v.q3target):0)+
                                (v.q4target!=null?parseInt(v.q4target):0))+"%</td>";
                break;
            case 'rating':
                  inp ="<td >"+(v.q1target!=null?v.q1target:'-')+" </td>\n\
                    <td >"+(v.q2target!=null?v.q2target:'-')+" </td>\n\
                    <td >"+(v.q3target!=null?v.q3target:'-')+"  </td>\n\
                    <td >"+(v.q4target!=null?v.q4target:'-')+" </td>\n\
                    <td > "+((v.q1target!=null?parseInt(v.q1target):0)+
                                (v.q2target!=null?parseInt(v.q2target):0)+
                                (v.q3target!=null?parseInt(v.q3target):0)+
                                (v.q4target!=null?parseInt(v.q4target):0))+"Ave</td>";
                break;
            case 'boolean':
                  inp ="<td > "+(v.q1target!=null?v.q1target:'-')+" </td>\n\
                   <td >   "+(v.q2target!=null?v.q2target:'-')+"</td>\n\
                    <td >  "+(v.q3target!=null?v.q3target:'-')+"</td>\n\
                    <td >   "+(v.q4target!=null?v.q4target:'-')+" </td>\n\
                    <td ><label>-</label></td>";
                break;
                 default:
                    inp ="<td ></td>\n\
                    <td ></td>\n\
                    <td ></td>\n\
                    <td ></td>\n\
                    <td ></td>";
    
    }
            }else{
                inp ="<td ></td>\n\
<td ></td>\n\
<td ></td>\n\
<td ></td>\n\
<td ></td>";
                
            }
            
         row += "<tr> \n\
     <td style='font-style:"+v.style+";font-weight:"+v.style+"'>"+v.indicator_name+" </td>"+inp+"</tr>";
         indicator = v.id;

}
         if(v.sub1_id !== indicator1&& v.sub1_indicator_name !== null){
               var inp = "";
            if(v.sub2_id === null){
             switch(v.sub1_type){
                    
            case 'quantity':
                inp ="<td > "+(v.sub1_q1target!=null?v.sub1_q1target:'-')+" </td>\n\
                    <td >"+(v.sub1_q2target!=null?v.sub1_q2target:'-')+"  </td>\n\
                    <td >"+(v.sub1_q3target!=null?v.sub1_q3target:'-')+" </td>\n\
                    <td >"+(v.sub1_q4target!=null?v.sub1_q4target:'-')+"</td>\n\
                    <td > "+((v.sub1_q1target!=null?parseInt(v.sub1_q1target):0)+
                                (v.sub1_q2target!=null?parseInt(v.sub1_q2target):0)+
                                (v.sub1_q3target!=null?parseInt(v.sub1_q3target):0)+
                                (v.sub1_q4target!=null?parseInt(v.sub1_q4target):0))+" </td>";
            break;
            case  'percentage':
                inp ="<td >"+(v.sub1_q1target!=null?v.sub1_q1target:'-')+"  </td>\n\
                    <td >"+(v.sub1_q2target!=null?v.sub1_q2target:'-')+" </td>\n\
                    <td >"+(v.sub1_q3target!=null?v.sub1_q3target:'-')+"  </td>\n\
                    <td >"+(v.sub1_q4target!=null?v.sub1_q4target:'-')+"  </td>\n\
                    <td > "+((v.sub1_q1target!=null?parseInt(v.sub1_q1target):0)+
                                (v.sub1_q2target!=null?parseInt(v.sub1_q2target):0)+
                                (v.sub1_q3target!=null?parseInt(v.sub1_q3target):0)+
                                (v.sub1_q4target!=null?parseInt(v.sub1_q4target):0))+"%</td>";
                break;
            case 'rating':
                  inp ="<td >"+(v.sub1_q1target!=null?v.sub1_q1target:'-')+"  </td>\n\
                    <td >"+(v.sub1_q2target!=null?v.sub1_q2target:'-')+"  </td>\n\
                    <td >"+(v.sub1_q3target!=null?v.sub1_q3target:'-')+"  </td>\n\
                    <td >"+(v.sub1_q4target!=null?v.sub1_q4target:'-')+"  </td>\n\
                    <td ><label> "+(((v.sub1_q1target!=null?parseInt(v.sub1_q1target):0)+
                                (v.sub1_q2target!=null?parseInt(v.sub1_q2target):0)+
                                (v.sub1_q3target!=null?parseInt(v.sub1_q3target):0)+
                                (v.sub1_q4target!=null?parseInt(v.sub1_q4target):0))/4)+" Ave</td>";
                break;
            case 'boolean':
                  inp ="<td > "+(v.sub1_q1target!=null?v.sub1_q1target:'-')+"</td>\n\
                   <td >   "+(v.sub1_q2target!=null?v.sub1_q2target:'-')+"</td>\n\
                    <td >  "+(v.sub1_q3target!=null?v.sub1_q3target:'-')+"</td>\n\
                    <td >   "+(v.sub1_q4target!=null?v.sub1_q4target:'-')+"</td>\n\
                    <td ><label>-</label></td>";
                break;
                 default:
                    inp ="<td ></td>\n\
                    <td ></td>\n\
                    <td ></td>\n\
                    <td ></td>\n\
                    <td ></td>";
                
    
    }
                
            }else{
                inp ="<td ></td>\n\
<td ></td>\n\
<td ></td>\n\
<td ></td>\n\
<td ></td>";
                
            }
            
         row += "<tr> <td style='font-style:"+v.sub1_style+";font-weight:"+v.sub1_style+"'>&nbsp;&nbsp;&nbsp;"+v.sub1_indicator_name+"      </td>"+inp+"</tr>";
         indicator1 = v.sub1_id;
     
        }
         if(v.sub2_id !== indicator2 && v.sub2_indicator_name !== null){
             var inp = "";
             
             switch(v.sub2_type){//ssdsdsd
                    
           case 'quantity':
                inp ="<td > "+(v.sub2_q1target!=null?v.sub2_q1target:'-')+" </td>\n\
                    <td >"+(v.sub2_q2target!=null?v.sub2_q2target:'-')+"   </td>\n\
                    <td >"+(v.sub2_q3target!=null?v.sub2_q3target:'-')+"  </td>\n\
                    <td >"+(v.sub2_q4target!=null?v.sub2_q4target:'-')+"  </td>\n\
                    <td > "+((v.sub2_q1target!=null?parseInt(v.sub2_q1target):0)+
                                (v.sub2_q2target!=null?parseInt(v.sub2_q2target):0)+
                                (v.sub2_q3target!=null?parseInt(v.sub2_q3target):0)+
                                (v.sub2_q4target!=null?parseInt(v.sub2_q4target):0))+" </td>";
            break;
            case  'percentage':
                inp ="<td >"+(v.sub2_q1target!=null?v.sub2_q1target:'-')+"  </td>\n\
                    <td >"+(v.sub2_q2target!=null?v.sub2_q2target:'-')+"  </td>\n\
                    <td >"+(v.sub2_q3target!=null?v.sub2_q3target:'-')+"  </td>\n\
                    <td >"+(v.sub2_q4target!=null?v.sub2_q4target:'-')+"  </td>\n\
                    <td > "+((v.sub2_q1target!=null?parseInt(v.sub2_q1target):0)+
                                (v.sub2_q2target!=null?parseInt(v.sub2_q2target):0)+
                                (v.sub2_q3target!=null?parseInt(v.sub2_q3target):0)+
                                (v.sub2_q4target!=null?parseInt(v.sub2_q4target):0))+"%</td>";
                break;
            case 'rating':
                  inp ="<td >"+(v.sub2_q1target!=null?v.sub2_q1target:'-')+"  </td>\n\
                    <td >"+(v.sub2_q2target!=null?v.sub2_q2target:'-')+"  </td>\n\
                    <td >"+(v.sub2_q3target!=null?v.sub2_q3target:'-')+"  </td>\n\
                    <td >"+(v.sub2_q4target!=null?v.sub2_q4target:'-')+"  </td>\n\
                    <td ><label> "+(((v.sub2_q1target!=null?parseInt(v.sub2_q1target):0)+
                                (v.sub2_q2target!=null?parseInt(v.sub2_q2target):0)+
                                (v.sub2_q3target!=null?parseInt(v.sub2_q3target):0)+
                                (v.sub2_q4target!=null?parseInt(v.sub2_q4target):0))/4)+" Ave</label></td>";
                break;
            case 'boolean':
                  inp ="<td > "+(v.sub2_q1target!=null?v.sub2_q1target:'-')+"</td>\n\
                   <td >   "+(v.sub2_q2target!=null?v.sub2_q2target:'-')+"</td>\n\
                    <td >  "+(v.sub2_q3target!=null?v.sub2_q3target:'-')+"</td>\n\
                    <td >   "+(v.sub2_q4target!=null?v.sub2_q4target:'-')+"</td>\n\
                    <td ><label>-</label></td>";
                break;
                
            default:
                    inp ="<td ></td>\n\
                    <td ></td>\n\
                    <td ></td>\n\
                    <td ></td>\n\
                    <td ></td>";
    
    }
  
             
             
         row += "<tr> <td style='font-style:"+v.sub2_style+";font-weight:"+v.sub2_style+"'    >&nbsp;&nbsp;&nbsp;&nbsp;"+v.sub2_indicator_name+" </td>"+inp+"</tr>";
    
         indicator2= v.sub2_id;
       
        }
       
        
        
   
       
      
       
        
       });
       
      
       tbody.html($(row))
       
       
      
        
    })
    
    } 
    
       loadTable();
     
     
     
     
     
     
     
     
     
     
     
     
     
    
    
    })
      

    
  




    </script>
             
    
<?php 

include_once './includes/objective.modals.php';
  }
?>