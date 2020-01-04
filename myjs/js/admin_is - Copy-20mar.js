//Login for admin panel

function GetLogin(formID)
{
	j('#TransMsgDisplay').html('<img src="'+admin_fpath+'images/indicator.gif">');
	var retval1 = CheckEmpty('myusername','Username','Username');
	var retval2 = CheckEmpty('mypassword','Password','Password');	
	var frmID='#'+formID;
			var params ={
				'module': 'contact',
				'action': 'sendContactData'
			};
			var paramsObj = j(frmID).serializeArray();			
			j.each(paramsObj, function(i, field){
				params[field.name] = field.value;
			});

		if(retval1 && retval2)
		{
			
			
						
			j.ajax({

				type: "POST",
				url: base_url+'admin/login/login_process',
				data: params,
				dataType: 'json',				
				success: function(data){
					
					if (data.flag == 1)
					{						
							window.location.href= base_url+data.redirect;
					}
					else
					{				 
						j('#TransMsgDisplay').html(data.msg);				 
					}
				}
		});
		}
		
		j('#TransMsgDisplay').html('');		
}



//update field javascript..
function GetUpdate(formid,updateUrl)
{
	var frmID='#'+formid;
	var paramsObj = j(frmID).serializeArray();

	j('#myResponse').html('<img src="'+admin_fpath+'images/indicator.gif">');
	
	j.ajax({
			type: "POST",
			url: updateUrl,
			data: paramsObj,
			dataType: 'json',				
			success: function(data){		
					
					if(data.flag=="1"){
						j('#myResponse').html(data.msg);			
					}else{
						j('#myResponse').html(data.error_msg);
					}

				}

		});
}


//empty check javascript
function CheckEmpty(ErrField,myID,FieldName)
{
	var myVar=document.getElementById(myID).value;
	
	if(myVar=='Enter Username' || myVar=='Enter Password')
	myVar = '';
	
	if(myVar=="")
	{
		document.getElementById(ErrField).innerHTML = "Please enter <b>"+FieldName+"</b>";
		return 0;
	}else{
		document.getElementById(ErrField).innerHTML='';
		return 1;
	}
}




//function for ajax calls from admin section...
function ManagerGeneral(url){	
		j('#TransMsgDisplay').html('<img src="'+admin_fpath+'images/indicator.gif" align="center">');	
		j.ajax({
				type: "POST",
				url: url,				
				dataType: 'html',				
				success: function(data){						
						j('#records_listing').html(data);			
						if(j('#TransMsgDisplay')){
							j('#TransMsgDisplay').html('');
						}
				}
		});

}


function ManagerGeneralForm(url,formID){	
	var frmID='#'+formID;
	var params ={
		'module': 'contact'
	};
	var paramsObj = j(frmID).serializeArray();	
	j.each(paramsObj, function(i, field){
		params[field.name] = field.value;

	});		
		j('#TransMsgDisplay').html('<img src="'+admin_fpath+'images/indicator.gif" align="center">');			
		j.ajax({

				type: "POST",
				url: url+'page/0',
				data: params,
				dataType: 'html',				
				success: function(data){				
						j('#records_listing').html(data);
						if(j('#TransMsgDisplay')) 				
						{	
							j('#TransMsgDisplay').html('');				
						}
				}
		});
}




/* Delete Function Starts */

function ConfirmDelete(url,delete_id,delete_name,delete_lebel_name,delete_category_id) 
{						
		j.prompt("Delete "+delete_lebel_name+" "+delete_name+" ?",{
		  callback: function(v,m,f){
			    if(v){
		//+"/delete_category_id/"+delete_category_id
		url=url+'/record_id/'+delete_id+'/IsPreserved/Y';	
		j('#TransMsgDisplay').html('<img src="'+admin_fpath+'images/indicator.gif" align="center">');	
		var params ={
		'module': 'contact',
		'Is_Process':'Y',
		'action': 'delete'
		};
		j.ajax({
				type: "POST",
				url: url,
				data: params,
				dataType: 'text',
				success: function(data){
						j('#records_listing').html(data);
						if(j('#TransMsgDisplay')) 
						{										
							j('#TransMsgDisplay').html('');
						}				           
				}
		});
					}
				else
					return false;
		  },
		  buttons:{Ok:true,Cancel:false},
		  prefix:'extblue'
	}); 
	
}





function paginate_links(){

j('.paginate a').click(function(){
j('#TransMsgDisplay').html('<img src="'+admin_fpath+'images/indicator.gif" align="center">');	
var url = j(this).attr('href');
j.ajax({
url:url+'/Is_Process/Y',
type:'get',
dataType:'html',
success:function(response){
j('#records_listing').html(response);
j('#TransMsgDisplay').html('');
}
});
return false;
});

}






