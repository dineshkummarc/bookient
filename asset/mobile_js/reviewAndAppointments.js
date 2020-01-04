function appointmentsFn(){
	pr_popup_close()
	hideAllContent();
	$(".topMenul").removeClass("ui-btn-active");
	$(".start-popup").remove();
	$(".myAppointmentContent").show('slow');
	//---------------------------------------//
}