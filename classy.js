// JavaScript Document
function classy() {
	try{
	var allTags = document.getElementsByTagName("*"); //provides all tags
	var fields = "";
	var editable = [];
	for (var i=0; i<allTags.length; i++) {
		var allClasses = allTags[i].className.split(" ");
		for(var p=0; p<allClasses.length; p++) {
				if(allClasses[p].indexOf('classy-field-') > -1) {
					editable.push(allTags[i]);
					if(fields) {
						fields += "_" + allClasses[p].substring(13);
					} else {
						fields = allClasses[p].substring(13);
					}
				}
		}
	}
	var xmlhttp;
	if (window.XMLHttpRequest)
 	{// code for IE7+, Firefox, Chrome, Opera, Safari
 	 	xmlhttp=new XMLHttpRequest();
  	}
	else
  	{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	//for async this makes a method that acts when the request is done
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    	{
    		var xmlDoc = xmlhttp.responseXML;
			var txt = "";
			var x = xmlDoc.getElementsByTagName("Content");
			for (i=0;i<x.length;i++)
			  {
				txt = x[i].childNodes[0].nodeValue;
				var thisTag = editable[i];
				if(thisTag.nodeName == "DIV" || thisTag.nodeName == "P" || thisTag.nodeName.indexOf("h") == 0) {
					thisTag.innerHTML = txt;
				} else if(thisTag.nodeName == "IMG") {
					thisTag.src = txt;
				} else {
					thisTag.value = txt;
				}
			  } //for i
    	}//if
  	}//readystate function
	
	//uses GET to access a file on the server, use a random so the file isn't cached
	xmlhttp.overrideMimeType('text/xml');
	xmlhttp.open("GET","classy.php?fields=" + fields,true);
	xmlhttp.send();
	}//try
	catch(err){
		alert(err.message);	
	}	
}