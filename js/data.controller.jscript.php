<script>
   

function findJSON(obj,needle){
   var s = [];
Object.keys(obj).map(function(key, index) {
    if(JSON.stringify(obj[key]).search(needle)>0){
s.push(obj[key]);
    }
});
return s
   }
     $(document).bind("keyup keydown", function(e){
    if(e.ctrlKey && e.keyCode == 80){
        $('button.printtable').click();
    }
});
    

    var serverData =  function(urlname,data){
       



         var   request =  $.ajax({
                    method: 'POST',
                    url: "../rest/?"+urlname,
                    data: data,
                    cache: false,
                    headers:{
                        "Authorization" : "Basic <?php  echo base64_encode($ser_u.":".$ser_p); ?>"
                    },
                   
                    
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
           // console.log(myXhr)
            if (myXhr.upload) {
              
                myXhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        
                
                    //    $('.progress-bar').html("Uploading "+parseInt(((e.loaded/e.total)*100))+"%");
                        
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
                 
//Place a statement before sending here
         
                
                  
                    }, done: function(xhr){
                        
                 
                        //Place a statement after sending here
                        
                    }
                    
                    
                  })
                  
                          return request;
        
    }
    var downloadfile =  function(urlname,data){
       



         var   request =  $.ajax({
                    method: 'POST',
                    url: "../rest/?"+urlname,
                    data: data,
                  
                    headers:{
                        "Authorization" : "Basic <?php  echo base64_encode($ser_u.":".$ser_p); ?>"
                    },
                          
       success: function(blob){
           console.log(blob);
   var myWindow=window.open('','Print','width=2000');
    
        myWindow.document.write(blob);
        myWindow.focus();
        myWindow.print();
        myWindow.close();

      }            
        
                    
                    
                  })
                  
                          return request;
        
    }





    </script>