function createContent($selected){
    $maincontiner = document.getElementById("searchmainbody");
   
    if($selected==="Action Details"){
        document.getElementById("iddiv").style.display="block";
        document.getElementById("itemid").innerHTML="Enter author id";
        document.getElementById("itemdiv").style.display="none";
        document.getElementById("datediv").style.display="block";
        document.getElementById("companydiv").style.display="none";
        
    }
    if($selected==="Batch Details"){
        document.getElementById("iddiv").style.display="block";
        document.getElementById("itemid").innerHTML="Enter author id";
        document.getElementById("itemdiv").style.display="block";
        document.getElementById("datediv").style.display="block";
        document.getElementById("companydiv").style.display="none";
       
    }
    if($selected==="Employee Details"){      
        document.getElementById("iddiv").style.display="none";
        document.getElementById("itemdiv").style.display="block";
        document.getElementById("datediv").style.display="block";
        document.getElementById("companydiv").style.display="block";
    }
    if($selected==="Item Details"){
        document.getElementById("iddiv").style.display="block";
        document.getElementById("itemid").innerHTML="Enter amployee id";
        document.getElementById("itemdiv").style.display="block";
        document.getElementById("datediv").style.display="block";
        document.getElementById("companydiv").style.display="block";
    }
}
      
