 var clickedTime; var createdTime; var reactionTime;
     
 function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}     
            
    function makebox() {
                      
     var time = Math.random();           //let time be a random number (0 to 1)
     
    time = 5000 * time;                  // set the random time to be from 0 to 5000.
               
     setTimeout(function() {
         
         if (Math.random()>0.5) {                     
             document.getElementById("box").style.borderRadius = "100px"; 
         } else {
             document.getElementById("box").style.borderRadius = "0"; 
         }
             
         var top = Math.random();
         top = top*300;
         var left = Math.random();
         left = left*600;
        document.getElementById("box").style.top= top +"px";
         document.getElementById("box").style.left= left +"px";
        document.getElementById("box").style.backgroundColor=getRandomColor();
        document.getElementById("box").style.display="block";              
        
         createdTime=Date.now();   
        
     }, time);
     
     }
     
     
       document.getElementById("box").onclick=function() {
           
           clickedTime = Date.now();
           
           reactionTime=(clickedTime-createdTime)/1000;
           
                    
           document.getElementById("time").innerHTML=reactionTime;
           
         
         this.style.display="none";
           
        makebox();   
     }
       
       makebox();
     
     
     
        
     