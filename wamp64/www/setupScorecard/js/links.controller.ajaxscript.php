<script>
  
    $(document).ready(function(){
          
 

        
        $(window).on('load', function(e){


var link =getParameterByName('form',("?"+atob((window.location.search).substr(1)))) ;
         



        if(typeof $.cookie('url_pageform') != 'undefined'){
            
           
            if($.cookie('url_pageform')!=btoa(link)){
                $.removeCookie('offset')
                $.removeCookie('limit')
                $.removeCookie('totalpage')
              $.cookie('url_pageform',btoa(link));
                    
            }
        }
        else{
            $.cookie('url_pageform',btoa(link));
                $.removeCookie('offset')
                $.removeCookie('limit')
                $.removeCookie('totalpage')
        }

});
    })
    
        function quickprint_from_link(link) {
 
var css = "<style>@page { size: A4; }</style>";


 $.post(link,function(data,status){
 
    var h = "<html><head>"+css+"</head><body>"+data+"</body></html>";  
    
    var myWindow=window.open('','Print','width=2000');
    
    myWindow.document.write(h);
    
  
myWindow.focus();
myWindow.print();
myWindow.close();
    });
 
 
  

  
 

}
        function quickprint(orientation) {
 
 var css ="";
 if(typeof orientation != "undefined"){
     
     
     css = "<style>@page { size: "+orientation+"; }</style>";
 }
 else{
     
     css = "";
 }
 

 
 var h = "<html><head>"+css+"</head><body>"+$("#table_wrapper").html()+"</body></html>";
 
  

  
   
    var myWindow=window.open('','Print','width=2000');
    
    myWindow.document.write(h);
    
  
myWindow.focus();
myWindow.print();
myWindow.close();

}

    function getParameterByName(name,url) {
 
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
    

    
   
    


/*

  $.fn.ajaxReload = function(url){ 

      
   
      
  
      
        $.ajax({url: url,
        type: 'POST'
        , success: function(data, status, xhr){
           
            
            if(xhr.status != 404){
                 var title = $(data).filter('title').text();
                 var data = $(data).find('#skjghsdjkfghshgsgfdskfgkdsgfrgudjgvbdbfjbvyuagsrhfvwefgcarvjhce6rfbdfv67erfvy').html();
                   processAjaxData(data,title,url);
                   
            }
            else{
                  $.get('./forms/404.php',function(data){
                      
                    
                   processAjaxData(data,"404 not Found",url)
                })
                
            }
            
      
        }
        ,complete: function(){
            
              NProgress.done();
              $('.progress_global').slideUp();
        },
           xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
           // console.log(myXhr)
            if (myXhr.upload) {
              
                myXhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        
                
                        //$('.progress-bar_global').html("Uploading "+parseInt(((e.loaded/e.total)*100))+"%");
                        
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
                        
                  NProgress.start();
                  $('.progress_global').slideDown();
                  
                    }
     }
            
              )
        
  
      
    
    };

*/
   


    </script>