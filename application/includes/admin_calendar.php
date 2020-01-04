<?php

/*
 * Turns $booking_array[$b]['booking_status'] into wanted booking class for color coding in admin calendar
 * jere, mireiawen
 */
function booking_status_class($book_status) 
{
	$booking_class='';
	
	switch($book_status)
	{
		case '2':
			$booking_class = 'pending';
			break;
		
		case '7':
			$booking_class = 'scheduled';
			break;
		
		case '8':
			$booking_class = 'late';
			break;
		
		case '9':
			$booking_class = 'noshow';
			break;
		
		default:
			$booking_class = 'unknown';
			break;
	}
	
	return $booking_class;
} 


/*
 * Turns $booking_array[$b]['booking_status'] into wanted booking style text for color coding in admin calendar, 
 * Implementation changed to php file in order to allow taking colors from database.
 * jere
 */
function booking_status_style($book_status) 
{
	$booking_style='';
	
	switch($book_status)
	{
		case '2': //pending
			$booking_style =   'background-image: linear-gradient(bottom, #66C2FF 10%, #0099FF 55%) !important;
								background-image: -o-linear-gradient(bottom, #66C2FF 10%, #0099FF 55%) !important;
								background-image: -moz-linear-gradient(bottom, #66C2FF 10%, #0099FF 55%) !important;
								background-image: -webkit-linear-gradient(bottom, #66C2FF 10%, #0099FF 55%) !important;
								background-image: -ms-linear-gradient(bottom, #66C2FF 10%, #0099FF 55%) !important;';
			break;
		
		case '7': //scheduled
			$booking_style =   'background-image: linear-gradient(bottom, #FF9FFF 10%, #FF66FF 55%) !important;
								background-image: -o-linear-gradient(bottom, #FF9FFF 10%, #FF66FF 55%) !important;
								background-image: -moz-linear-gradient(bottom, #FF9FFF 10%, #FF66FF 55%) !important;
								background-image: -webkit-linear-gradient(bottom, #FF9FFF 10%, #FF66FF 55%) !important;
								background-image: -ms-linear-gradient(bottom, #FF9FFF 10%, #FF66FF 55%) !important;';
			break;
		
		case '8': //late
			$booking_style =   'background-image: linear-gradient(bottom, #AD855C 10%, #966C43 55%) !important;
								background-image: -o-linear-gradient(bottom, #AD855C 10%, #966C43 55%) !important;
								background-image: -moz-linear-gradient(bottom, #AD855C 10%, #966C43 55%) !important;
								background-image: -webkit-linear-gradient(bottom, #AD855C 10%, #966C43 55%) !important;
								background-image: -ms-linear-gradient(bottom, #AD855C 10%, #966C43 55%) !important;';
			break;
		
		case '9': //noshow
			$booking_style =   'background-image: linear-gradient(bottom, #FFFFAD 10%, #FFFF99 55%) !important;
								background-image: -o-linear-gradient(bottom, #FFFFAD 10%, #FFFF99 55%) !important;
								background-image: -moz-linear-gradient(bottom, #FFFFAD 10%, #FFFF99 55%) !important;
								background-image: -webkit-linear-gradient(bottom, #FFFFAD 10%, #FFFF99 55%) !important;
								background-image: -ms-linear-gradient(bottom, #FFFFAD 10%, #FFFF99 55%) !important;';
			break;
		
		default: //unknown
			$booking_style =   'background-image: linear-gradient(bottom, #8CFF8C 10%, #19FF19 55%) !important;
								background-image: -o-linear-gradient(bottom, #8CFF8C 10%, #19FF19 55%) !important;
								background-image: -moz-linear-gradient(bottom, #8CFF8C 10%, #19FF19 55%) !important;
								background-image: -webkit-linear-gradient(bottom, #8CFF8C 10%, #19FF19 55%) !important;
								background-image: -ms-linear-gradient(bottom, #8CFF8C 10%, #19FF19 55%) !important;';
			break;
	}
	
	return $booking_style;
} 




?>