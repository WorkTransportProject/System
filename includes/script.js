var flag = false;

function show() {
	var element;
	
    element = document.getElementById("navList");
    
    if(flag == false){
    	element.className = "show";
    	flag = true;
    }
    else {
    	element.className = "hide";
    	flag = false;
    }
    	
}