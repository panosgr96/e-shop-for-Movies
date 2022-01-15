/*/////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////<!-------------myjs.js------------->//////////////////
///////////////////////////////////////////////////////////////////////////////////////*/



//Star-submit
function StarRate(element){
   document.getElementById('submittedRate').value =1;
   document.getElementById('total').value = element.value;
   document.getElementById('formRate').submit(); 
}

//Pop-up
function popupdiv(elem,cover,descr){
    var popupdiv = document.getElementById("popupdiv");
    
    var rect = elem.getBoundingClientRect();
    if (popupdiv) {
        popupdiv.style.top = (rect.top - 50) + "px";
        popupdiv.style.left = (rect.right + 20) + "px";
    }
    
    
   popupimg = document.getElementById("popupimg");
   if (popupimg){popupimg.src=cover;}
   popupdescr = document.getElementById("popupdescr");
   if (popupdescr){popupdescr.innerText = descr;}
   popupdiv.style.display="block";
   elem.onmouseout = function(){display();};
   popupdiv.focus();
   
   function display() {
    popupdiv.style.display="none";
    }
}



