<?php
class Changestatusmod extends CI_Model {
    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct(){
        parent::__construct();	// Call the Model constructor
    }

	//Get value of perticuler field requires by Changestatus library
    function get_FieldData($field,$change_status_id)
    {
		$this->db->select($field);
		
        $this->db->where('change_status_id', $change_status_id);
		$query =$this->db->get('change_status');
		$row = $query->row_array(); 
		$query->free_result(); 
        return $row[$field];
    }
	function set_ChangestatusSettings($ChangeStatusType,$TableName,$Pkey,$ChangeStatusName,$ChangeOtherStatusName,$IsOtherStatus,$IsOtherStatusMode,$ChangeOtherStatusDependency,$ChangeOtherStatusType,$record_id){

			if($ChangeStatusType=="Default")
			{	
				$this->db->trans_start();				
				$data = array(
				   $ChangeStatusName => 'N'
				);
				$this->db->update($TableName, $data); 

				if($IsOtherStatus=="Y")
				{
					if($ChangeOtherStatusDependency=="TO")
					{
						$this->db->select($ChangeOtherStatusName);
						$this->db->where($Pkey,$record_id);
						$query = $this->db->get($TableName);
						$row = $query->row_array(); 
						$query->free_result(); 
						$SelectOtherStatus = $row[$ChangeOtherStatusName];

						if($ChangeOtherStatusType=="OPPOSITE")						
							$ChangeOtherStatusValue=($SelectOtherStatus=="Y")?"N":"Y";						
						else						
							$ChangeOtherStatusValue=($SelectOtherStatus=="Y")?"Y":"N";	
					}
					else
					{
						$ChangeOtherStatusValue=($ChangeOtherStatusType=="OPPOSITE")?"N":"Y";													
					}
					$dataArr = array(
						$ChangeStatusName => 'Y',
						$ChangeOtherStatusName => $ChangeOtherStatusValue 
					);
					
				}
				else{
						$dataArr = array(
							$ChangeStatusName => 'Y'
						);
				}
				$this->db-where($Pkey,$record_id);
				$this->db->update($TableName, $dataArr); 
				$this->db->trans_complete();
			}		
			/* Default Setting Ends */
			
			/* Activate Setting Starts */
			if($ChangeStatusType=="Activate")
			{
				
				$this->db->select($ChangeStatusName);
				$this->db->where($Pkey,$record_id);
				$query = $this->db->get($TableName);
				$row = $query->row_array(); 
				$query->free_result(); 
				$SelectStatus = $row[$ChangeStatusName];			
				
				$ChangeToStatus=$SelectStatus=='Y'?'N':'Y';
				if($IsOtherStatus=="Y")
				{					
					if($ChangeOtherStatusDependency=="TO")
					{						
						$this->db->select($ChangeOtherStatusName);
						$this->db->where($Pkey,$record_id);
						$query = $this->db->get($TableName);
						$row = $query->row_array(); 
						$query->free_result(); 
						$SelectOtherStatus = $row[$ChangeOtherStatusName];

						if($ChangeOtherStatusType=="OPPOSITE")						
							$ChangeOtherStatusValue=($SelectOtherStatus=="Y")?"N":"Y";						
						else						
							$ChangeOtherStatusValue=($SelectOtherStatus=="Y")?"Y":"N";	
						if($IsOtherStatusMode==$ChangeOtherStatusValue || $IsOtherStatusMode=="B"){
							$dataUpdateArr = array(
								$ChangeStatusName => $ChangeOtherStatusValue
							);
						}	
						else{
							$dataUpdateArr = array(
								$ChangeStatusName => $ChangeToStatus
							);
						}
					}
					else
					{
						if($ChangeOtherStatusType=="OPPOSITE")						
							$ChangeOtherStatusValue=($SelectStatus=="Y")?"N":"Y";						
						else						
							$ChangeOtherStatusValue=($SelectStatus=="Y")?"Y":"N";	
						$dataUpdateArr = array(
							$ChangeStatusName => $ChangeToStatus,
							$ChangeOtherStatusName => $ChangeOtherStatusValue
						);
																		
					}
					
				}
				else{
						$dataUpdateArr = array(
							$ChangeStatusName => $ChangeToStatus
						);
				}
				$this->db->where($Pkey,$record_id);
				$this->db->update($TableName, $dataUpdateArr);
			}		
			
			/* Activate Setting Ends */

	}

}