function showDept(region_id) {
    var httpxml;
    try {
        // Firefox, Opera 8.0+, Safari
        httpxml=new XMLHttpRequest();
    } catch (e){
        // Internet Explorer
        try {
            httpxml=new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
            
                httpxml=new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                alert(e.toString());
                alert("Your browser does not support AJAX!");
                return false;
            }
        }
    }
    
    function stateck() {
        if(httpxml.readyState==4 && httpxml.status == 200) {

            var myarray=eval(httpxml.responseText);
            
            // Before adding new we must remove previously loaded elements
            for(var j = document.myForm.dept.options.length-1; j >= 0; j--) {
                document.testform.subcat.remove(j);
            }

            for (var i = 0, length = myarray.length; i < length; i++) {
                var optn = document.createElement("option");
                optn.text  = myarray[i];
                optn.value = myarray[i];
                document.myForm.dept.options.add(optn);

            } 
        }
    }
    
    var url="script.php";
    url=url+"?reg_id="+region_id;
    url=url+"&sid="+Math.random();
    httpxml.onreadystatechange=stateck;
    httpxml.open("GET",url,true);
    httpxml.send(null);
}
//(function(){
//    var selObj = document.getElementById('region'),
//    selIndex = selObj.selectedInde;
//    
//    selObj.onchange = function() {
//        selIndex = selObj.selectedIndex
//        alert(selObj[selIndex].text);
//    };   
//})();