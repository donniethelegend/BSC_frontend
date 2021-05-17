<script>
   


    

    
    $(document).ready(function(){
        
        
        
   
        
        
        
        
        
   var ajaxProcessResponse =  $(document).on('submit','form',function(e){
           e.preventDefault();

        
     


 

   //   var session =  $.cookie('PHPSESSID');
var redirect = "" ; // extract the redirect variable
         var method = $(this).attr('method');
         method = typeof method!='undefined'?method:"POST";
           var url = 'http://'+window.location.hostname+'/rest/?'+$(this).attr('action');
           
                 var form= $(this);
                 var formdata= $(this)[0];
           
        
          var   request =  $.ajax({
                    method: method,
                    url: url,
                    data: new FormData(formdata),
                    cache: false,
                    headers:{
                        "Authorization" : "Basic <?php  echo base64_encode($ser_u.":".$ser_p); ?>"
                        
                    },
                    contentType: false,
                    processData: false,
                    
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
           // console.log(myXhr)
            if (myXhr.upload) {
              
                myXhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        
                
                     $('.progress-bar').html("Uploading "+parseInt(((e.loaded/e.total)*100))+"%");
                        
                     $('.progress-bar').css("width",parseInt(((e.loaded/e.total)*100))+"%");
                 $('.progress-bar').attr({
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
        delay: 1000,
	timer: 1000,
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
                   
                               var btn=  form.find('[type=submit]').removeAttr('disabled');
       
                           btn.html('Save') 
               
        
                     
                        
                        if(typeof xhr.redirect != 'undefined'){
                         
                             $.cookie('notif',JSON.stringify(xhr))
                                

                           
                         
                            
                        
                           window.location.replace(xhr.redirect);
                            
                     
                            
                        }
                        else{
                        $.notify({
	// options
	icon: 'bi bi-emoji-laughing',
	title: xhr.title,
	message: xhr.message,
	url: xhr.url,
	target: '_blank'
},{
	// settings
	type: 'success',
        z_index: '1090',
        delay: 500,
	timer: 1000,
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
}




      
                     var btn=  form.find('[type=submit]').removeAttr('disabled');
       
                           btn.html('Save') 
              
                      
                  });

                       
                        
                    
                    
                
                        
                        
             
           
                 
               return request;
           
    });
    });
  
    
    $(document).ready(function(){
        
        
        




//NOTIFICATION AFTER REDIRECT
var notif = $.cookie('notif');

if(typeof notif != 'undefined'){


var notif_json =  JSON.parse(notif);
console.log(notif_json)
var title = typeof notif_json.title != 'undefined'?notif_json.title:"";
var url = typeof notif_json.url != 'undefined'?notif_json.url:"";
var message = typeof notif_json.message != 'undefined'?notif_json.message:"";
var type = typeof notif_json.type != 'undefined'?notif_json.type:"info";

                        $.notify({
	// options
	icon: 'bi bi-emoji-laughing',
	title: title,
	message: message,
	url: url,
	target: '_blank'
},{
	// settings
	type: type,
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



$.removeCookie('notif')




}

  



});












    </script>