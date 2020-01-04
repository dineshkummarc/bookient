<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('displayMessage')){
 function displayMessage($messg)  {
	  if($messg == 1)
		   $msg = "<span class=\"white\">Add operation unsuccessful. Try again.</span>";
	  elseif($messg == 2)
		   $msg = "<span class=\"green\">".lang('add_success')."</span>";
	  elseif($messg == 3)
		   $msg = "<span class=\"white\">Change operation unsuccessful. Try again.</span>";
	  elseif($messg == 4)
		   $msg = "<span class=\"green\">".lang('update_success')."</span>";
	  elseif($messg == 5)
		   $msg = "<span class=\"white\">Delete operation unsuccessful. Try again.</span>";
	  elseif($messg == 6)
		   $msg = "<span class=\"green\">Delete operation successful.</span>";
	  elseif($messg == 7)
		   $msg = "<span class=\"white\">Record not found.</span>";
	  elseif($messg == 8)
		   $msg = "<span class=\"white\">Delete unsuccessful. Record exists under this section.</span>";
	  elseif($messg == 9)
		   $msg = "<br><span class=\"green\">Mail has been successfully sent to the subscribers.</span>";
	  elseif($messg == 10)
		   $msg = "<span class=\"white\">Image upload operation unsuccessful. Try again.</span>";
	  elseif($messg == 11)
		   $msg = "<br><span class=\"green\">Image upload operation successful.</span>";
	  elseif($messg == 12)
		   $msg = "<span class=\"white\">Size delete operation unsuccessful. Try again.</span>";
	  elseif($messg == 13)
		   $msg = "<span class=\"green\">Size deleted Successfully.</span>";
	  elseif($messg >= 100&&$messg <= 102)
	  {
	  		switch($messg)
			{
				case 100: $DeleteItemName="Modality(s)";
							break;
				case 101: $DeleteItemName="News";
							break;
			}
	  		$msg = "<span class=\"white\">$DeleteItemName Exist Under This Section. Hence Delete Unsuccessful.</span>";
	  }
	   elseif($messg == 103)
	  		$msg = "<span class=\"white\">This one is a Monthly Winner. Hence Delete Unsuccessful.</span>";
	  return $msg;
  }
  function displayTopMessage($messg) {
	  if($messg == 1)
		   $msg = "<span class=\"white\">Add Operation Unsuccessful. Try again.</span>";
	  elseif($messg == 2)
		   $msg = "<span class=\"white\">Add Operation Successful.</span>";
	  elseif($messg == 3)
		   $msg = "<span class=\"white\">Change Operation Unsuccessful. Try again.</span>";
	  elseif($messg == 4)
		   $msg = "<span class=\"white\">Change Operation Successful.</span>";
	  return $msg;
  }
}
function notify_Message($messg)  {
	  if($messg == 1)
		   $msg = "<span class=\"white\">Add operation unsuccessful. Try again.</span>";
	  elseif($messg == 2)
		   $msg = "<span class=\"green\">".lang('add_success')."</span>";
	  elseif($messg == 3)
		   $msg = "<span class=\"white\">Change operation unsuccessful. Try again.</span>";
	  elseif($messg == 4)
		   $msg = "<span class=\"green\">".lang('update_success')."</span>";
  }