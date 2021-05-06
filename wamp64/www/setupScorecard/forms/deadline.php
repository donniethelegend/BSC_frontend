<?php    if ($_SESSION[base64_encode("role")] == base64_encode('administrator')||$_SESSION[base64_encode("role")] == base64_encode('moderator') ){ ?>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Deadline/s</h1>
           <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
              
            
            <button accesskey="q" type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_adddeadline">  <i class="bi bi-plus"></i> Update</button>
           
            
          </div>
      
        </div>
      </div>


 <div class="container">
   <div class="row">
      <div class='col-sm-6'>
          YEAR
         
         <select  class="form-control year-select">
             <option value="2020">2020</option>
             <option value="2021">2021</option>
             <option value="2022">2022</option>
             <option value="2023">2023</option>
             <option value="2024">2024</option>
             <option value="2025">2025</option>
             <option value="2026">2026</option>
             <option value="2027">2027</option>
             <option value="2028">2028</option>
             <option value="2029">2029</option>
             <option value="2030">2030</option>
             <option value="2031">2031</option>
             <option value="2032">2032</option>
             
         </select>
      </div>
     
   
   </div>
</div>
 
      <div class="table-responsive">
          
         
        <table id ="tbl_deadline" class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Date Open</th>
              <th>Deadline</th>
          
              
            </tr>
          </thead>
          <tbody>
         
          </tbody>
        </table>
         
      </div>
 
  <script>
   

$(document).ready(function(){
    
  $('.reportrange').daterangepicker({
    timePicker: true,
    showDropdowns: true,
    startDate: moment().startOf('hour'),
    endDate: moment().startOf('hour').add(32, 'hour'),
    locale: {
      format: 'YYYY-MM-DD HH:mm:ss'
    }
  });
  
  $('#modal_adddeadline').on('show.bs.modal',function(){
      
  $(this).find('input[name="input_start[]"]').val( moment().startOf('hour').format('YYYY-MM-DD HH:mm:ss'))
  $(this).find('input[name="input_end[]"]').val(  moment().startOf('hour').add(32, 'hour').format('YYYY-MM-DD HH:mm:ss'))    
  
  
  
  var rows = $('#tbl_deadline>tbody>tr');
  
  $.each(rows,function(i,v){
      
      
     var n =  $(v).find('td:eq(1)').text().toLowerCase();
     
     var s = $(v).find('td:eq(2)').text();
     var e = $(v).find('td:eq(3)').text();
     
      
        
   $('.'+n).daterangepicker({
      startDate: s,
      endDate: e,
      locale: {
      format: 'YYYY-MM-DD HH:mm:ss'
    }
  });
  
  $('.'+n).find('input[name="input_start[]"]').val(s);
  $('.'+n).find('input[name="input_end[]"]').val(e);
  
      
      
      
  })
  
      
  })
  
  
  
 
  
  
  
    $('.reportrange').on('apply.daterangepicker', function(ev, picker) {
     //console.log(picker.startDate.format('YYYY-MM-DD hh:mm A') + ' - ' + picker.endDate.format('YYYY-MM-DD hh:mm A'));
    
    
  var pick = $(this)
    var yrs = JSON.parse(localStorage.getItem('yeardata'));
    
    var ln = yrs.length;
    
   
   var currentyr = yrs[(ln-1)].year;
   var chooseyr =picker.startDate.format('YYYY');
   if(parseInt(currentyr)>parseInt(chooseyr)){
       
       var c = confirm('You have existing schedule on year '+currentyr+'!. Do you want to override the data?');
       if(c){
           
       pick.find('input[name="input_start[]"]').val(picker.startDate.format('YYYY-MM-DD hh:mm:ss'))
       pick.find('input[name="input_end[]"]').val(picker.endDate.format('YYYY-MM-DD hh:mm:ss'))
       }
       else{
       pick.find('input[name="input_start[]"]').val("")
       pick.find('input[name="input_end[]"]').val("")
       }
       
   }
   else{
       pick.find('input[name="input_start[]"]').val(picker.startDate.format('YYYY-MM-DD hh:mm:ss'))
       pick.find('input[name="input_end[]"]').val(picker.endDate.format('YYYY-MM-DD hh:mm:ss'))
   }

    
  });
  //---------------------------------------------------------------------------
    
   
    
    
    
    
var year2 =     new serverData("<?php /*URL in based64*/ echo base64_encode('beans=json/getyear_from_deadlines'); ?>",null)

year2.done(function(xhr){
       localStorage.setItem('yeardata',JSON.stringify(xhr))
       
       
       var d = new Date();

var yn = d.getFullYear();
    $.cookie('year', yn);
       
       
       var year_sel_dd = $('.year-select').empty();
       $.each(xhr,function(i,v){
           year_sel_dd.append('<option '+(v.year==yn?"selected":"")+' value="'+v.year+'">'+v.year+'</option>')
           
       })
       
         var d = new Date();

    $.cookie('year', d.getFullYear());
    
})
    
    
    
    
    
    $('.year-select').change(function(){
        var year = $(this).val();

        if(year!=null){
        
        $.cookie('year',year);
        loadTable();
    }
    else{
        $.removeCookie('year');
        
    }
        
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
      
        var year = "";
        var search = "";
        
     
        if(typeof $.cookie('search') != 'undefined'){
        search =     $.cookie('search');
         $('.search-bar').val(search);
            
        }
        if(typeof $.cookie('year') != 'undefined'){
        year =     $.cookie('year');
         $('.year-select').val(year);
            
        }
        
        
                            
    var d = new serverData("<?php /*URL in based64*/ echo base64_encode('beans=json/getdeadlines'); ?>",
    
    // use the folowing format for sending data in http request
                                                                        [
                                                                          
                                                                            {
                                                                             name:"search",
                                                                             value:search
                                                                         },
                                                                            {
                                                                             name:"year",
                                                                             value:year
                                                                            }
                                                                        ]
                                                                                );// 1st parameter is the beans name; 2nd parameter is the data, in serializedArray format
    
    
    d.done(function(xhr){
       var tbody = $('#tbl_deadline').find('tbody').empty();
       
     
       
        var  item_no = 0;
    
      
 
     
     
       $.each(xhr,function(i,v){
           
       
           item_no++;
           tbody.append('<tr><td>\n\
    '+item_no+'</td><td>'+v.name+'</td><td>'+v.open_date+'</td><td>'+v.end_date+'</td></tr>')
           
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
    
    
    

    
    })
      

    
  




    </script>
             
   
<?php 

include_once './includes/deadlines.modals.php';
  }
?>