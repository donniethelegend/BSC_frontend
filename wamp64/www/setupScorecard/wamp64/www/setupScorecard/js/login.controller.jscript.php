<script>
   


    

    
    $(document).ready(function(){
        
        
        
   
        
        
        
        
        
   var ajaxProcessResponse =  $(document).on('submit','form',function(e){
           e.preventDefault();

        
     


 

   //   var session =  $.cookie('PHPSESSID');
var redirect = "" ; // extract the redirect variable
         var method = $(this).attr('method');
         method = typeof method!='undefined'?method:"POST";
           var url = 'http://'+window.location.hostname+'/rest/?'+$(this).attr('action');
           var form =  $(this);
   
        
          var   request =  $.ajax({
                    method: method,
                    url: url,
                    data:"",
                    cache: false,
                    headers:{
                       "Authorization" : "Basic "+btoa((  $(this).serializeArray()[0].value)+":"+(  $(this).serializeArray()[1].value))
                       
                    },
                    contentType: false,
                    processData: false,
                    
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
           // console.log(myXhr)
            if (myXhr.upload) {
              
                myXhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        
                
                        //$('.progress-bar').html("Uploading "+parseInt(((e.loaded/e.total)*100))+"%");
                        
                        $('.progress-bar_global').css("width",parseInt(((e.loaded/e.total)*100))+"%");
                        $('.progress-bar_global').attr({
                           "aria-valueno": e.loaded,
                             "aria-valuemax": e.total
                             
                        });
                  
                    }
                } , false);
            }
            return myXhr;
        },
                    beforeSend: function(xhr){  
                 
  
         
                  var btn =form.find('[type=submit]').prop('disabled',true);
                           btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  Loading...') 
                  
                  
                    }
                    
                    
                  });
                  
                  request.fail(function(xhr){
                  
 $.notify({
	// options
	icon: 'bi bi-emoji-angry',
	title: 'Error Code 404',
	message: 'Command Not found',
	url: 'https://en.wikipedia.org/wiki/HTTP_404',
	target: '_blank'
},{
	// settings
	type: 'danger',
        z_index: '1090',
        icon_type: 'class',
        mouse_over:'pause',
	template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
		'<button  aria-hidden="true" class="btn-close " data-notify="dismiss">×</button>' +
		'<h3><span data-notify="icon"></span> ' +
		'<span data-notify="title">{1}</span></h3> ' +
		'<span data-notify="message">{2}</span>' +
		'<div class="progress" data-notify="progressbar">' +
			'<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
		'</div>' +
		'<a href="{3}" target="{4}" data-notify="url"></a>' +
	'</div>' 
});     





      
                     var btn=  form.find('[type=submit]').removeAttr('disabled');
       
                           btn.html('Save') 
                      
                  });
                  
                  request.done(function(xhr){
                       
                          
         
                     
                        
                               $.cookie('notif',JSON.stringify(xhr))
                                
                    
                            
                        
                           window.location.reload();
                            
                     
                   
                    
                
                        
                        
             
           
                  });
               return request;
           
    });
  


  



});






    </script>