

/* Check numbersonly starts */

/* Note: Use In Control Attribute as onKeyPress="return numbersonly(this, event)" */

function numbersonly(myfield, e, dec)

{

	var key;

	var keychar;

	if (window.event)

	key = window.event.keyCode;

	else if (e)

	key = e.which;

	else

	return true;

	keychar = String.fromCharCode(key);

	// control keys

	if ((key==null) || (key==0) || (key==8) || 

	(key==9) || (key==13) || (key==27))

	return true;

	// numbers

	else if ((("0123456789").indexOf(keychar) > -1))

	return true;

	// decimal point jump

	else if (dec && (keychar == "."))

	{

	myfield.form.elements[dec].focus();

	return false;

	}

	else

	return false;

}

/* Check numbersonly ends */

/* Check floatnumbersonly starts */

/* Note: Use In Control Attribute as onKeyPress="return floatnumbersonly(this, event)" */

function floatnumbersonly(myfield, e, dec)

{

	var key;

	var keychar;

	if (window.event)

	key = window.event.keyCode;

	else if (e)

	key = e.which;

	else

	return true;

	keychar = String.fromCharCode(key);

	// control keys

	if ((key==null) || (key==0) || (key==8) || 

	(key==9) || (key==13) || (key==27)|| (key==46))

	return true;

	// numbers

	else if ((("0123456789").indexOf(keychar) > -1))

	return true;

	// decimal point jump

	else if (dec && (keychar == "."))

	{

	myfield.form.elements[dec].focus();

	return false;

	}

	else

	return false;

}

function signedfloatnumbersonly(myfield, e, dec)

{

	var key;

	var keychar;

	if (window.event){

	key = window.event.keyCode;

	

	}

	else if (e)

	{

		key = e.which;

	}

	else

	return true;

	keychar = String.fromCharCode(key);

	// control keys

	if ((key==null) || (key==0) || (key==8) || 

	(key==9) || (key==13) || (key==27)|| (key==46))

	return true;

	// numbers

	else if ((("-0123456789").indexOf(keychar) > -1))

	return true;

	// decimal point jump

	else if (dec && (keychar == "."))

	{

	myfield.form.elements[dec].focus();

	return false;

	}

	else

	return false;

}

/* Check floatnumbersonly ends */



/* Check Numeric Starts */

function NumericCheck(vVal)

	{	

		

		if(vVal!="")

		{

			var vVal=parseFloat(vVal);

			if(isNaN(vVal))

			{

				return 0;

			}

			else

			{

				return parseFloat(vVal);

				

			}

		}

		else

		{

			return 0;

		}

	}

/* Check Numeric Ends */



/* Removes leading whitespaces Starts */

		function LTrim( value ) {

			

			var re = /\s*((\S+\s*)*)/;

			return value.replace(re, "$1");

			

		}

		// Removes ending whitespaces

		function RTrim( value ) {

			

			var re = /((\s*\S+)*)\s*/;

			return value.replace(re, "$1");

			

		}

		

		// Removes leading and ending whitespaces

		function trim( value ) {

			

			return LTrim(RTrim(value));

			

		}

/* Removes leading whitespaces Ends */



/*------------------General functions-----------------------*/





function CheckEmpty(ErrField,myID,FieldName)
{
	var myVar=document.getElementById(myID).value;
	myID='#'+myID;
	var myVar=j(myID).val();
	
	
	
	if(myVar=="")
	{
		
		ErrField='#'+ErrField;	
		j(ErrField).html('Please enter <b>'+FieldName+'</b>');

	}else{
		
		ErrField='#'+ErrField;		
		j(ErrField).html('');

	}
}











function CheckEmpty_Old(ErrField,myID,FieldName)

{

	var myVar=document.getElementById(myID).value;

	if(myVar=="")

	{

		document.getElementById(ErrField).innerHTML = "Please enter <b>"+FieldName+"</b>";

	}else{

		document.getElementById(ErrField).innerHTML='';

	}

}

/*------------------General functions-----------------------*/



/*------------------Image Load functions Starts -----------------------*/



var BASE_MAP_ID = '';

var BASE_MAP_IMAGE = '';

var BASE_MAP_IMAGE_HOVER = '';



function MM_goToURL() { //v3.0

  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;

  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");

}

function MM_findObj(n, d) { //v4.01

  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {

    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}

  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];

  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);

  if(!x && d.getElementById) x=d.getElementById(n); return x;

}



function MM_swapImgRestore() { //v3.0

  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;

  

  if(BASE_MAP_IMAGE_HOVER!='')

  {	  

	if(eval("document.getElementById('"+BASE_MAP_ID+"')")!=null )

	{	 			 

		eval("document.getElementById('"+BASE_MAP_ID+"').src='"+BASE_MAP_IMAGE_HOVER+"'");

	}

  }

}



function MM_preloadImages() { //v3.0

  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();

    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)

    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}

}



function MM_swapImage() { //v3.0

  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)

   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}

}





function swapBaseMap(map_id,map_image,map_image_hover) 

{	

	if(eval("document.getElementById('"+BASE_MAP_ID+"')")!=null )

	{	 			 

		eval("document.getElementById('"+BASE_MAP_ID+"').src='"+BASE_MAP_IMAGE+"'");

	}

	BASE_MAP_ID = 'sublink_'+map_id;

	BASE_MAP_IMAGE = map_image;	

	BASE_MAP_IMAGE_HOVER = map_image_hover;		

}

/*------------------Image Load functions Starts -----------------------*/

