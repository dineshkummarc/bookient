<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class email_mktg_model extends CI_Model
{
    function sendMailCsv($email_send)
    {
        $this->load->database();
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('*');
        $this->db->from('app_eml_mrktn_templt_local_admin_temp');
        $this->db->where('status',1);
        $this->db->where('local_admin_id',$local_admin_id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0)
        {
            $row=$query->row();
            $tmplt_subject=$row->tmplt_subject;
            $html='
                   <html>
                   <head>
                   <title>'.$this->lang->line("email_verificatn").'</title>
         
                   </head>
                   <body>';
                       $html.='<div style="border:5px solid #ccc">';                                                     
                         $html.='<div  style="background-color:'.$row->tmplt_header_bgcolor.'">';
                              $html.='<div class="email_preview_header" >';
                                 $html.= $this->global_mod->show_to_control($row->tmplt_header_content) ;  
                              $html.='</div>';               
                         $html.='</div>';
                         $html.='<div   style="background-color:'.$row->tmplt_body_bgcolor.'">';
                              $html.='<div class="email_preview_content" >';
                                 $html.= $this->global_mod->show_to_control($row->tmplt_body_content);
                              $html.='</div>';                
                         $html.='</div>';
                         $html.='<div style="background-color:'.$row->tmplt_footer_bgcolor.'">'; 
                             $html.='<div class="email_preview_footer" >';
                                 $html.=$this->global_mod->show_to_control($row->tmplt_footer_content);  
                             $html.='</div>';           
                         $html.='</div>';                    
                     $html.='</div>';

                   $html.='</body>
               </html>';
           $to  = $email_send; 
           $subject = $tmplt_subject;
           $headers  = 'MIME-Version: 1.0' . "\r\n";
           $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
           $headers .= 'From: Sandipan Mandal <sandipancitytech@gmail.com>' . "\r\n";
           mail($to, $subject, $html, $headers);
           if(mail($to, $subject, $html, $headers))
           {
               return $this->lang->line("succ_mail_send");
           }
           else
           {
               return $this->lang->line('errr_snding');
           }             
        }  
    }
    
    
    function showAllTemplate($eml_mrktn_templt_cat_id=0){
       $LocalAdminId = $this->session->userdata('local_admin_id');
    	$html ='';
    	if($eml_mrktn_templt_cat_id == 0){
			$sql = "SELECT
							temp.app_emlmrktn_tem_id AS tem_id,
							rela.app_emlmrktn_rel_id AS rel_id,
							cate.emlMrktn_cat_id AS cat_id,
							cate.emlMrktn_cat_name AS cat_name,
							temp.app_emlmrktn_tem_subject AS tem_subject,
							temp.app_emlmrktn_tem_content AS tem_body
					FROM 
							app_emlmrktn_template AS temp,
							app_emlmrktn_category AS cate,	
							app_emlmrktn_relation AS rela
					WHERE
							rela.app_emlmrktn_rel_localadmin_id IN (0,'".$LocalAdminId."')
							AND
							rela.app_emlmrktn_rel_cat_id = cate.emlMrktn_cat_id
							AND
							rela.app_emlmrktn_rel_tmp_id = temp.app_emlmrktn_tem_id
					ORDER BY
							cat_id"; 
		
		}else{
			$sql = "SELECT
							temp.app_emlmrktn_tem_id AS tem_id,
							rela.app_emlmrktn_rel_id AS rel_id,
							cate.emlMrktn_cat_id AS cat_id,
							cate.emlMrktn_cat_name AS cat_name,
							temp.app_emlmrktn_tem_subject AS tem_subject,
							temp.app_emlmrktn_tem_content AS tem_body
					FROM 
							app_emlmrktn_template AS temp,
							app_emlmrktn_category AS cate,	
							app_emlmrktn_relation AS rela
					WHERE
							rela.app_emlmrktn_rel_localadmin_id IN (0,'".$LocalAdminId."')
							AND
							rela.app_emlmrktn_rel_cat_id = cate.emlMrktn_cat_id
							AND
							rela.app_emlmrktn_rel_tmp_id = temp.app_emlmrktn_tem_id
							AND
							cate.emlMrktn_cat_id ='".$eml_mrktn_templt_cat_id."'
					ORDER BY
							cat_id"; 
		}
    	
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return  $result;       
    }
	
    function myTemplate($eml_mrktn_templt_cat_id=0)
    {
    	
        $this->load->database();
        $local_admin_id = $this->session->userdata('local_admin_id');
        $html="";
        $this->db->select('*');
        $this->db->from('app_eml_mrktn_templt_local_admin');
        $this->db->where('status',1);
        $this->db->where('local_admin_id',$local_admin_id);
        if($eml_mrktn_templt_cat_id !=0)
        {
        $this->db->where('eml_mrktn_templt_cat_id',$eml_mrktn_templt_cat_id);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {

                foreach ($query->result() as $row)
                {
                        $html.='<div class="tmplt">';
                                $html.='<div class="tmplt-header" style="background-color:'.$row->tmplt_header_bgcolor.'">';
                                        $html.=$this->global_mod->show_to_control($row->tmplt_header_content) ;
                                $html.='</div>';
                                $html.='<div class="tmplt-content" style="background-color:'.$row->tmplt_body_bgcolor.'">';
                                        $html.=$this->global_mod->show_to_control($row->tmplt_body_content);
                                $html.='</div>';
                                $html.='<div class="tmplt-footer" style="background-color:'.$row->tmplt_footer_bgcolor.'">';
                                        $html.= $this->global_mod->show_to_control($row->tmplt_footer_content);
                                $html.='</div class="tmplt-footer">';
                                $html.='<div class="tmplt-name">';
                                        $html.= $this->global_mod->show_to_control($row->tmplt_name);
                                $html.='</div>';
                                $html.='<div class="use-this">';
                                        $html.='<input type="button" class="use-bt" onclick="select_my_template('.$row->eml_mrktn_templt_local_admin_id.')" value="'.$this->global_mod->db_parse($this->lang->line("use_this")).'" >';
                                $html.='</div>';
                        $html.='</div>';

                }

        }
        else{
           $html= $this->global_mod->db_parse($this->lang->line('u_dnt_hv_any_sv_tmplt')); 
        }

        return $html;
    }
		
    function showAllCategory(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $sql = " SELECT
							DISTINCT cate.emlMrktn_cat_id AS cat_id,
							cate.emlMrktn_cat_name AS cat_name
					FROM 
							app_emlmrktn_category AS cate,	
							app_emlmrktn_relation AS rela
					WHERE
							rela.app_emlmrktn_rel_localadmin_id IN (0,'".$local_admin_id."')
							AND
							rela.app_emlmrktn_rel_cat_id = cate.emlMrktn_cat_id
					ORDER BY
							cat_id";
    	
		$query = $this->db->query($sql);
		$result = $query->result_array();		
		return $result;        
    }
	
    function selectTemplate($eml_mrktn_templt_id,$clicked_category)
    {
    	
    	$this->db->select('*');
        $this->db->from('app_emlmrktn_template');
        $this->db->where('app_emlmrktn_tem_id',$eml_mrktn_templt_id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0){
            $row=$query->row();
        }    
    	
    	$html="";

			$html.='<div class="total-pop-height">';
			$html.='<span class="email_head">'.$this->global_mod->db_parse($this->lang->line("edit_tmplt"));
			if($clicked_category == 0){
				$html .= '<span style="color:#FF0000;"> '.$this->global_mod->db_parse($this->lang->line('you_can_not_save')).'</span>';
			}
			$html .= '</span>';
			$html .='<div id="sendTestTemplate" class="allPopupdiv"  style="display: none; margin-bottom:8px;"> 
                <div id="msg" style="color: green;text-align: center;"></div>
                <label for="testemail">'.$this->global_mod->db_parse($this->lang->line("email")).'</label>
                <input type="text" name="test-email" maxlength="500" id="testemail" 
                       style="border:1px solid #B7B7B7;width:400px;border-radius: 3px 3px 3px 3px;">
                <input type="button" style="cursor:pointer" onclick="sendTestMail();" value="'.$this->global_mod->db_parse($this->lang->line("send")).'">
            </div> '; 
			$html.='<ul class="email_menu">';
        if($clicked_category != 0){
			$html.='<li><a href="javascript:void(0);" onclick="SaveAsNew('.$eml_mrktn_templt_id.','.$clicked_category.')">'.$this->global_mod->db_parse($this->lang->line("save_as_new")).'</a></li>';
		}    
            $html.='<li><a href="javascript:void(0);" onclick="ShowMailArea()">'.$this->global_mod->db_parse($this->lang->line("send")).'</a></li>';
            $html.='<li><a href="javascript:void(0);" onclick="PreviewMailBody('.$eml_mrktn_templt_id.')">'.$this->global_mod->db_parse($this->lang->line("preview")).'</a></li>';
            
			$html.='</ul>';
			$html.='</br>';
			
			
			$html .= '<ul id="TestMailArea" style="display:none;"><li style="float:right;" onclick=""><a href="javascript:void(0);" onclick="ShowMailAreaRev()">Back</a></li><li><b>Send mail by</b> : <input type="radio" name="bygroup" value="1" onchange="openList(this)"/>Customer Type &nbsp <input type="radio" name="bygroup" value="2" onchange="openList(this)" />Single</li></ul>';
			$html .= '</br>';
			$html .= '<ul id="listarea" style="display:none;"></ul>';
			$html .= '</br>';
			$html .= '<ul id="searchlistingArea" style="display:none;"></ul>';
		
			$html.='</br>';
			$html.='<ul class="email_sender_menu">';
            $html.='<li>'.$this->global_mod->db_parse($this->lang->line("subject")).':</li><li><input type="text" name="tmplt_subject" id="tmplt_subject" value="'.$row->app_emlmrktn_tem_subject.'"><span id="sub_err"></span></li>';
           
			$html.='</ul>';
			$html.='</br>';
            $html.='<div class="select-tmplt">';
            
            $html.=' <textarea cols="80" id="tmplt_body" name="tmplt_body" rows="10">'.$row->app_emlmrktn_tem_content.'</textarea>
                                                                <script type="text/javascript">
                                                                	if(CKEDITOR.instances["tmplt_body"]) { 
   																		 delete CKEDITOR.instances["tmplt_body"]; 
																	};
            	                                                    
                                                                        CKEDITOR.replace( "tmplt_body",{
																						    skin : "kama",
																						    height:"450",
																						    width:"96%"
																						 });
																		CKEDITOR.instances["tmplt_body"];
                                                                </script>';
            $html.='</div></div>';                                                    
             
              
        return $html;
    }
    function selectMyTemplate($eml_mrktn_templt_id)
    {
        $this->load->database();
        $this->db->empty_table('app_eml_mrktn_templt_local_admin_temp'); 
        $local_admin_id = $this->session->userdata('local_admin_id');
        $html="";
        $this->db->select('*');
        $this->db->from('app_eml_mrktn_templt_local_admin');
        $this->db->where('status',1);
        $this->db->where('eml_mrktn_templt_local_admin_id',$eml_mrktn_templt_id);
        //$this->db->where('local_admin_id',$local_admin_id);
        $uniq_id=uniqid();

        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            $row=$query->row();
            $eml_mrktn_templt_cat_id_check=$row->eml_mrktn_templt_cat_id;
            $insert_app_eml_mrktn_templt_local_admin_temp = array(
                                        'eml_mrktn_templt_local_admin_id'   => $row->eml_mrktn_templt_local_admin_id,
						'eml_mrktn_templt_id'       => $row->eml_mrktn_templt_id,
						'local_admin_id'            => $local_admin_id,
						'eml_mrktn_templt_cat_id'   => $row->eml_mrktn_templt_cat_id,
						'tmplt_name'                => $row->tmplt_name,
                                                'tmplt_subject'             => $row->tmplt_subject,
						'tmplt_header_content'      => $row->tmplt_header_content,
						'tmplt_header_bgcolor'      => $row->tmplt_header_bgcolor,
						'tmplt_body_content'        => $row->tmplt_body_content,
						'tmplt_body_bgcolor'        => $row->tmplt_body_bgcolor,
						'tmplt_footer_content'      => $row->tmplt_footer_content,                                               
						'tmplt_footer_bgcolor'      => $row->tmplt_footer_bgcolor,
						'status'                    => $row->status,
                                                'active'                    => $row->active
                                                );
            $insert_app_eml_mrktn_templt_local_admin_temp = $this->global_mod->db_parse($insert_app_eml_mrktn_templt_local_admin_temp);
            $this->db->trans_begin();
            $this->db->insert('app_eml_mrktn_templt_local_admin_temp ',$this->db->escape($insert_app_eml_mrktn_templt_local_admin_temp));           
            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback(); 
            }
            else
            {
                    $this->db->trans_commit();
            }  	
            
            $saveHeader = "onclick=\"saveHeader('".$row->eml_mrktn_templt_id."','".$uniq_id."')\"";
            $saveContent = "onclick=\"saveContent('".$row->eml_mrktn_templt_id."','".$uniq_id."')\"";
            $saveFooter = "onclick=\"saveFooter('".$row->eml_mrktn_templt_id."','".$uniq_id."')\"";
            $html.='<span ><a href="javascript:void(0);" onclick="closeAll();">close</a></span><br/><br/>';
            $html.='<a href="javascript:void(0);" onclick="saveTemplate('.$row->eml_mrktn_templt_id.')">'.$this->global_mod->db_parse($this->lang->line("save_as_new")).'</a>&nbsp';
            $html.='<a href="javascript:void(0);" onclick="updateTemplate('.$row->eml_mrktn_templt_local_admin_id.')">'.$this->global_mod->db_parse($this->lang->line("update_btn")).'</a>&nbsp';
            $html.='<a href="javascript:void(0);" onclick="sendTestTemplate('.$row->eml_mrktn_templt_id.')">'.$this->global_mod->db_parse($this->lang->line("send_test")).'</a>&nbsp';
            $html.=' <a href="javascript:void(0);" onclick="previewTemplate('.$row->eml_mrktn_templt_id.')">'.$this->global_mod->db_parse($this->lang->line("Preview")).'</a>&nbsp';
            $html.='<a href="javascript:void(0);" onclick="sendTemplate('.$row->eml_mrktn_templt_id.')">'.$this->global_mod->db_parse($this->lang->line("send")).'</a><br/><br/>';
            $html.= $this->global_mod->db_parse($this->lang->line("template_name")).':&nbsp; <input type="text" name="template_name" id="template_name" value="'.$row->tmplt_name.'"> &nbsp;&nbsp;';
            $html.= $this->global_mod->db_parse($this->lang->line("subject")).':&nbsp; <input type="text" name="tmplt_subject" id="tmplt_subject" value="'.$row->tmplt_subject.'"> &nbsp;&nbsp;';
            $html.=	$this->global_mod->db_parse($this->lang->line("tmplt_ctgory")).':&nbsp; <select name="template_cat" id="template_cat">';
                    $html.='<option value="">select</option>';
                    $this->db->select('*');
                    $this->db->from('app_eml_mrktn_templt_cat');
                    $this->db->where('status',1);
                    $query_cat = $this->db->get();
                    if ($query_cat->num_rows() > 0)
                    {
                   
                            foreach ($query_cat->result() as $row_cat)
                            {
                               if($eml_mrktn_templt_cat_id_check == $row_cat->eml_mrktn_templt_cat_id)
                               {
                                   $checked ='selected="selected"';
                                   
                               }
                               else 
                               {
                                   $checked ="";
                               }
                               
                                 $html.='<option value="'.$row_cat->eml_mrktn_templt_cat_id.'" '.$checked.'>'.$this->global_mod->show_to_control($row_cat->cat_name).'</option>';
                            }
                    }
                
            $html.='</select> <br/>';
            $html.='<div class="select-tmplt">';
             
                    $html.='<div id="email_mktg_header" >'; //header area
                        $html.=' <input type="hidden" value="'.$uniq_id.'" id="uniq_id_header">';
                        $html.='<div class="select-tmplt-header" id="header_show" style="background-color:'.$row->tmplt_header_bgcolor.'">';
                                $html.='<table width="100%">';
                                    $html.='<tr>';
                                        $html.='<td align="left">';
                                            $html.='<span ><a href="javascript:void(0);" onclick="editHeader();">'.$this->global_mod->db_parse($this->lang->line("edit_btn")).'</a></span>';
                                        $html.='</td><td align="right">';                                                
                                            $html.='<div id="colorSelector_header"><div style="background-color:'.$row->tmplt_header_bgcolor.';border:3px solid mediumblue;width:15px;height:15px;"></div></div>';
                                         $html.='</td><td></tr><tr><td colspan="2">';    
                                            $html.= $this->global_mod->show_to_control($row->tmplt_header_content) ;
                                         $html.='</td></tr>';
                                $html.='</table>';
                        $html.='</div>';
                        $html.='<div id="header_editor" class="select-tmplt-header"  style="display:none;">';
                                $html.='<span ><a href="javascript:void(0);" onclick="cancelHeader();">'.$this->global_mod->db_parse($this->lang->line("cancel_btn")).'</a></span>&nbsp;';
                                $html.='<span ><a href="javascript:void(0);" '.$saveHeader.'>'.$this->global_mod->db_parse($this->lang->line("save_btn")).'</a></span>';
                                        $html.=' <textarea cols="80" id="header_area'.$uniq_id.'" name="header_area'.$uniq_id.'" rows="10">'.$row->tmplt_header_content.'</textarea>
                                                                <script type="text/javascript">
                                                                        CKEDITOR.replace( "header_area'.$uniq_id.'",
                                                                                                {
                                                                                                        skin : "kama",
                                                                                                        height:"200",
                                                                                                        width:"98%"
                                                                                                });
                                                                </script>';

                        $html.='</div>';
                    $html.='</div>';    
                    $html.='<div id="email_mktg_content" >'; //content area
                        $html.=' <input type="hidden" value="'.$uniq_id.'" id="uniq_id_content">';
                        $html.='<div class="select-tmplt-content" id="content_show"  style="background-color:'.$row->tmplt_body_bgcolor.'">';
                            $html.='<table width="100%">';
                                    $html.='<tr>';
                                        $html.='<td align="left">';
                                            $html.='<span ><a href="javascript:void(0);" onclick="editContent();">'.$this->global_mod->db_parse($this->lang->line("edit_btn")).'</a></span>';
                                         $html.='</td><td align="right">';     
                                            $html.='<div id="colorSelector_content"><div style="background-color:'.$row->tmplt_body_bgcolor.';border:3px solid mediumblue;width:15px;height:15px;"></div></div>';
                                         $html.='</td><td></tr><tr><td colspan="2">';
                                            $html.= $this->global_mod->show_to_control($row->tmplt_body_content);
                                         $html.='</td></tr>';
                                $html.='</table>';
                                
                               
                        $html.='</div>';
                        $html.='<div id="content_editor"   style="display:none;">';
                                $html.='<span ><a href="javascript:void(0);" onclick="cancelContent();">'.$this->global_mod->db_parse($this->lang->line("cancel_btn")).'</a></span>&nbsp;';
                                $html.='<span ><a href="javascript:void(0);" '.$saveContent.'>'.$this->global_mod->db_parse($this->lang->line("save_btn")).'</a></span>';
                                        $html.=' <textarea cols="80" id="content'.$uniq_id.'" name="content'.$uniq_id.'" rows="10">'.$this->global_mod->show_to_control($row->tmplt_body_content).'</textarea>
                                                                <script type="text/javascript">
                                                                        CKEDITOR.replace( "content'.$uniq_id.'",
                                                                                                {
                                                                                                        skin : "kama",
                                                                                                        height:"600",
                                                                                                        width:"98%"
                                                                                                });
                                                                </script>';

                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div id="email_mktg_footer" >'; //footer area
                        $html.=' <input type="hidden" value="'.$uniq_id.'" id="uniq_id_footer">';
                        $html.='<div class="select-tmplt-footer" id="footer_show" style="background-color:'.$row->tmplt_footer_bgcolor.'">';
                            $html.='<table width="100%">';
                               $html.='<tr>';
                                   $html.='<td align="left">';
                                       $html.='<span ><a href="javascript:void(0);" onclick="editFooter();">'.$this->global_mod->db_parse($this->lang->line("edit_btn")).'</a></span>';
                                   $html.='</td><td align="right">';     
                                       $html.='<div id="colorSelector_footer"><div style="background-color:'.$row->tmplt_footer_bgcolor.';border:3px solid mediumblue;width:15px;height:15px;"></div></div>';
                                   $html.='</td><td></tr><tr><td colspan="2">';
                                       $html.=$row->tmplt_footer_content;
                                   $html.='</td></tr>';
                            $html.='</table>';
                        $html.='</div class="tmplt-footer">';
                        $html.='<div id="footer_editor"   style="display:none;">';
                                $html.='<span ><a href="javascript:void(0);" onclick="cancelFooter();">'.$this->global_mod->db_parse($this->lang->line("cancel_btn")).'</a></span>&nbsp;';
                                $html.='<span ><a href="javascript:void(0);" '.$saveFooter.'">'.$this->global_mod->db_parse($this->lang->line("save_btn")).'</a></span>';
                                        $html.=' <textarea cols="80" id="footer_area'.$uniq_id.'" name="footer_area'.$uniq_id.'" rows="10">'.$row->tmplt_footer_content.'</textarea>
                                                                <script type="text/javascript">
                                                                        CKEDITOR.replace( "footer_area'.$uniq_id.'",
                                                                                                {
                                                                                                        skin : "kama",
                                                                                                        height:"200",
                                                                                                        width:"98%"
                                                                                                });
                                                                </script>';

                        $html.='</div>';
                    $html.='</div>';    
                    $html.='<div class="select-tmplt-name">';
                            $html.= $this->global_mod->show_to_control($row->tmplt_name);
                    $html.='</div>';

            $html.='</div>';
                

        }
        return $html;
    }
    function saveHeader($eml_mrktn_templt_id, $tmplt_header_content)
    {
            $this->load->database();
            $local_admin_id = $this->session->userdata('local_admin_id');
            $data = array(
            'tmplt_header_content' => $this->global_mod->db_parse($tmplt_header_content),
            );
            $this->db->trans_begin();
            $this->db->where('local_admin_id',$local_admin_id);
            $this->db->where('eml_mrktn_templt_id',$eml_mrktn_templt_id);
            $this->db->update('app_eml_mrktn_templt_local_admin_temp', $data);
            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
            }
            else
            {
                    $this->db->trans_commit();
            } 
            
      
        $html='';
        $uniq_id = uniqid();
        $this->db->select('*');
        $this->db->from('app_eml_mrktn_templt_local_admin_temp');      
        $this->db->where('eml_mrktn_templt_id',$eml_mrktn_templt_id);
       
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            $row=$query->row();           
         
           
            $saveHeader = "onclick=\"saveHeader('".$row->eml_mrktn_templt_id."','".$uniq_id."')\"";
        
                   
             $html.=' <input type="hidden" value="'.$uniq_id.'" id="uniq_id_header">';
                        $html.='<div class="select-tmplt-header" id="header_show" style="background-color:'.$row->tmplt_header_bgcolor.'">';
                                $html.='<table width="100%">';
                                    $html.='<tr>';
                                        $html.='<td align="left">';
                                            $html.='<span ><a href="javascript:void(0);" onclick="editHeader();">'.$this->global_mod->db_parse($this->lang->line("edit_btn")).'</a></span>';
                                        $html.='</td><td align="right">';                                                
                                            $html.='<div id="colorSelector_header"><div style="background-color:'.$row->tmplt_header_bgcolor.';border:3px solid mediumblue;width:15px;height:15px;"></div></div>';
                                         $html.='</td><td></tr><tr><td colspan="2">';    
                                            $html.= $this->global_mod->show_to_control($row->tmplt_header_content) ;
                                         $html.='</td></tr>';
                                $html.='</table>';
                        $html.='</div>';
            $html.='<div id="header_editor" class="select-tmplt-header"  style="display:none;">';
                    $html.='<span ><a href="javascript:void(0);" onclick="cancelHeader();">'.$this->global_mod->db_parse($this->lang->line("cancel_btn")).'</a></span>&nbsp;';
                    $html.='<span ><a href="javascript:void(0);" '.$saveHeader.'>'.$this->global_mod->db_parse($this->lang->line("save_btn")).'</a></span>';
                            $html.=' <textarea cols="80" id="header_area'.$uniq_id.'" name="header_area'.$uniq_id.'" rows="10">'.$this->global_mod->show_to_control($row->tmplt_header_content).'</textarea>
                                                    <script type="text/javascript">
                                                            CKEDITOR.replace( "header_area'.$uniq_id.'",
                                                                                    {
                                                                                            skin : "kama",
                                                                                            height:"200",
                                                                                            width:"98%"
                                                                                    });
                                                    </script>';

                        
                    

          
                

        }
        return $html;
        
    }
	
    function saveContent($eml_mrktn_templt_id, $tmplt_body_content)
    {
            $this->load->database();
            $local_admin_id = $this->session->userdata('local_admin_id');
            $data = array(
            'tmplt_body_content' => $this->global_mod->db_parse($tmplt_body_content),
            );
            $this->db->trans_begin();
            $this->db->where('local_admin_id',$local_admin_id);
            $this->db->where('eml_mrktn_templt_id',$eml_mrktn_templt_id);
            $this->db->update('app_eml_mrktn_templt_local_admin_temp', $data);
            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
            }
            else
            {
                    $this->db->trans_commit();
            } 
            
      
        $html='';
        $uniq_id = uniqid();
        $this->db->select('*');
        $this->db->from('app_eml_mrktn_templt_local_admin_temp');      
        $this->db->where('eml_mrktn_templt_id',$eml_mrktn_templt_id);
       
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            $row=$query->row();           
         
           
            $saveContent = "onclick=\"saveContent('".$row->eml_mrktn_templt_id."','".$uniq_id."')\"";
          
            
          
                    $html='<input type="hidden" value="'.$uniq_id.'" id="uniq_id_content">';
                    $html.='<div class="select-tmplt-content" id="content_show"  style="background-color:'.$row->tmplt_body_bgcolor.'">';
                             $html.='<table width="100%">';
                                    $html.='<tr>';
                                        $html.='<td align="left">';
                                            $html.='<span ><a href="javascript:void(0);" onclick="editContent();">'.$this->global_mod->db_parse($this->lang->line("edit_btn")).'</a></span>';
                                         $html.='</td><td align="right">';     
                                            $html.='<div id="colorSelector_content"><div style="background-color:'.$row->tmplt_header_bgcolor.';border:3px solid mediumblue;width:15px;height:15px;"></div></div>';
                                         $html.='</td><td></tr><tr><td colspan="2">';
                                            $html.=$this->global_mod->show_to_control($row->tmplt_body_content);
                                         $html.='</td></tr>';
                                $html.='</table>';
                    $html.='</div>';
                    $html.='<div id="content_editor"   style="display:none;">';
                            $html.='<span ><a href="javascript:void(0);" onclick="cancelContent();">'.$this->global_mod->db_parse($this->lang->line("cancel_btn")).'</a></span>&nbsp;';
                            $html.='<span ><a href="javascript:void(0);" '.$saveContent.'>'.$this->global_mod->db_parse($this->lang->line("save_btn")).'</a></span>';
                                    $html.=' <textarea cols="80" id="content'.$uniq_id.'" name="content'.$uniq_id.'" rows="10">'.$this->global_mod->show_to_control($row->tmplt_body_content).'</textarea>
                                                            <script type="text/javascript">
                                                                    CKEDITOR.replace( "content'.$uniq_id.'",
                                                                                            {
                                                                                                    skin : "kama",
                                                                                                    height:"600",
                                                                                                    width:"98%"
                                                                                            });
                                                            </script>';

                    $html.='</div>';
                    

          
                

        }
        return $html;
    }
    
    function saveFooter($eml_mrktn_templt_id, $tmplt_footer_content)
    {
            $this->load->database();
            $local_admin_id = $this->session->userdata('local_admin_id');
            $data = array(
            'tmplt_footer_content' => $this->global_mod->db_parse($tmplt_footer_content),
            );
            $this->db->trans_begin();
            $this->db->where('local_admin_id',$local_admin_id);
            $this->db->where('eml_mrktn_templt_id',$eml_mrktn_templt_id);
            $this->db->update('app_eml_mrktn_templt_local_admin_temp', $data);
            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
            }
            else
            {
                    $this->db->trans_commit();
            } 
            
      
        $html='';
        $uniq_id = uniqid();
        $this->db->select('*');
        $this->db->from('app_eml_mrktn_templt_local_admin_temp');      
        $this->db->where('eml_mrktn_templt_id',$eml_mrktn_templt_id);
       
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            $row=$query->row();           
         
           	
            $saveFooter = "onclick=\"saveContent('".$row->eml_mrktn_templt_id."','".$uniq_id."')\"";
          
            
            $html.=' <input type="hidden" value="'.$uniq_id.'" id="uniq_id_footer">';
               $html.='<div class="select-tmplt-footer" id="footer_show" style="background-color:'.$row->tmplt_footer_bgcolor.'">';
                      $html.='<table width="100%">';
                               $html.='<tr>';
                                   $html.='<td align="left">';
                                       $html.='<span ><a href="javascript:void(0);" onclick="editFooter();">'.$this->global_mod->db_parse($this->lang->line("edit_btn")).'</a></span>';
                                   $html.='</td><td align="right">';     
                                       $html.='<div id="colorSelector_footer"><div style="background-color:'.$row->tmplt_footer_bgcolor.';border:3px solid mediumblue;width:15px;height:15px;"></div></div>';
                                   $html.='</td><td></tr><tr><td colspan="2">';
                                       $html.= $this->global_mod->show_to_control($row->tmplt_footer_content);
                                   $html.='</td></tr>';
                            $html.='</table>';
               $html.='</div class="tmplt-footer">';
               $html.='<div id="footer_editor"   style="display:none;">';
                       $html.='<span ><a href="javascript:void(0);" onclick="cancelFooter();">'.$this->global_mod->db_parse($this->lang->line("cancel_btn")).'</a></span>&nbsp;';
                       $html.='<span ><a href="javascript:void(0);" '.$saveFooter.'">'.$this->global_mod->db_parse($this->lang->line("save_btn")).'</a></span>';
                               $html.=' <textarea cols="80" id="footer_area'.$uniq_id.'" name="footer_area'.$uniq_id.'" rows="10">'.$row->tmplt_footer_content.'</textarea>
                                                       <script type="text/javascript">
                                                               CKEDITOR.replace( "footer_area'.$uniq_id.'",
                                                                                       {
                                                                                               skin : "kama",
                                                                                               height:"200",
                                                                                               width:"98%"
                                                                                       });
                                                       </script>';

           $html.='</div>';

        }
        return $html;
    }
    
    
     function saveHeaderColor($eml_mrktn_templt_id, $tmplt_header_bgcolor)
    {
            $this->load->database();
            $local_admin_id = $this->session->userdata('local_admin_id');
            $data = array(
            'tmplt_header_bgcolor' => $tmplt_header_bgcolor,
            );
            $this->db->trans_begin();
            $this->db->where('local_admin_id',$local_admin_id);
            //$this->db->where('eml_mrktn_templt_id',$eml_mrktn_templt_id);
            $this->db->update('app_eml_mrktn_templt_local_admin_temp', $data);
            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
            }
            else
            {
                    $this->db->trans_commit();
            } 
    }   
    
     function saveContentColor($eml_mrktn_templt_id, $tmplt_body_bgcolor)
    {
        
            $this->load->database();
            $local_admin_id = $this->session->userdata('local_admin_id');
            $data = array(
            'tmplt_body_bgcolor' => $tmplt_body_bgcolor,
            );
            $this->db->trans_begin();
            $this->db->where('local_admin_id',$local_admin_id);
            //$this->db->where('eml_mrktn_templt_id',$eml_mrktn_templt_id);
            $this->db->update('app_eml_mrktn_templt_local_admin_temp', $data);
            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
            }
            else
            {
                    $this->db->trans_commit();
            } 
    }   
     function saveFooterColor($eml_mrktn_templt_id, $tmplt_footer_bgcolor)
    {
            $this->load->database();
            $local_admin_id = $this->session->userdata('local_admin_id');
            $data = array(
            'tmplt_footer_bgcolor' => $tmplt_footer_bgcolor,
            );
            $this->db->trans_begin();
            $this->db->where('local_admin_id',$local_admin_id);
            //$this->db->where('eml_mrktn_templt_id',$eml_mrktn_templt_id);
            $this->db->update('app_eml_mrktn_templt_local_admin_temp', $data);
            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
            }
            else
            {
                    $this->db->trans_commit();
            } 
    }   
    
    
    function previewTemplate($eml_mrktn_templt_id)
    {
            $html='';
            $this->load->database();
            $local_admin_id = $this->session->userdata('local_admin_id');
            $this->db->select('*');
            $this->db->from(' app_eml_mrktn_templt_local_admin_temp');
            $this->db->where('status',1);
            $this->db->where('eml_mrktn_templt_id',$eml_mrktn_templt_id);
            $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            $row=$query->row();

             $html.='<div style="border:5px solid #ccc">';                                                     
                $html.='<div  style="background-color:'.$row->tmplt_header_bgcolor.'">';
                     $html.='<div class="email_preview_header" >';
                        $html.= $this->global_mod->show_to_control($row->tmplt_header_content) ;  
                     $html.='</div>';               
                $html.='</div>';
                $html.='<div   style="background-color:'.$row->tmplt_body_bgcolor.'">';
                     $html.='<div class="email_preview_content" >';
                        $html.= $this->global_mod->show_to_control($row->tmplt_body_content);
                     $html.='</div>';                
                $html.='</div>';
                $html.='<div style="background-color:'.$row->tmplt_footer_bgcolor.'">'; 
                    $html.='<div class="email_preview_footer" >';
                        $html.=$row->tmplt_footer_content;  
                    $html.='</div>';           
                $html.='</div>';                    
            $html.='</div>';
            return $html;
        }
            
    }  
    
    function saveTemplate($eml_mrktn_templt_id, $eml_mrktn_templt_cat_id,$tmplt_name,$tmplt_subject)
    {
       
         $local_admin_id = $this->session->userdata('local_admin_id');

         $this->db->select('*');
         $this->db->from('app_eml_mrktn_templt_local_admin_temp');
         $this->db->where('status',1);
         $this->db->where('eml_mrktn_templt_id',$eml_mrktn_templt_id);


         $query = $this->db->get();

         if ($query->num_rows() > 0)
         {
             $row=$query->row();
             $insert_app_eml_mrktn_templt_local_admin_temp = array(
                                                 'eml_mrktn_templt_id'       => $eml_mrktn_templt_id,
                                                 'local_admin_id'            => $local_admin_id,
                                                 'eml_mrktn_templt_cat_id'   => $eml_mrktn_templt_cat_id,
                                                 'tmplt_name'                => $tmplt_name,
                                                 'tmplt_subject'             => $tmplt_subject,
                                                 'tmplt_header_content'      => $row->tmplt_header_content,
                                                 'tmplt_header_bgcolor'      => $row->tmplt_header_bgcolor,
                                                 'tmplt_body_content'        => $row->tmplt_body_content,
                                                 'tmplt_body_bgcolor'        => $row->tmplt_body_bgcolor,
                                                 'tmplt_footer_content'      => $row->tmplt_footer_content,                                               
                                                 'tmplt_footer_bgcolor'      => $row->tmplt_footer_bgcolor,
                                                 'status'                    => $row->status,
                                                 'active'                    => $row->active
                                                 );
               $insert_app_eml_mrktn_templt_local_admin_temp = $this->global_mod->db_parse($insert_app_eml_mrktn_templt_local_admin_temp);                                 

             $this->db->trans_begin();
             $this->db->insert('app_eml_mrktn_templt_local_admin',$this->db->escape($insert_app_eml_mrktn_templt_local_admin_temp));           
             if ($this->db->trans_status() === FALSE)
             {
                     $this->db->trans_rollback(); 
             }
             else
             {
                     $this->db->trans_commit();
             }  
         }
    }
    function updateTemplate($eml_mrktn_templt_local_admin_id, $eml_mrktn_templt_cat_id,$tmplt_name,$tmplt_subject)
    {
         //echo "hii";
         $this->load->database();

         $local_admin_id = $this->session->userdata('local_admin_id');

         $this->db->select('*');
         $this->db->from('app_eml_mrktn_templt_local_admin_temp');
         $this->db->where('status',1);
         $this->db->where('eml_mrktn_templt_local_admin_id',$eml_mrktn_templt_local_admin_id);


         $query = $this->db->get();
         //echo $this->db->last_query();
         if ($query->num_rows() > 0)
         {
             $row=$query->row();
             $update_app_eml_mrktn_templt_local_admin = array(
                                                 'eml_mrktn_templt_id'       => $row->eml_mrktn_templt_id,
                                                 'local_admin_id'            => $local_admin_id,
                                                 'eml_mrktn_templt_cat_id'   => $eml_mrktn_templt_cat_id,
                                                 'tmplt_name'                => $tmplt_name,
                                                 'tmplt_subject'             => $tmplt_subject,
                                                 'tmplt_header_content'      => $row->tmplt_header_content,
                                                 'tmplt_header_bgcolor'      => $row->tmplt_header_bgcolor,
                                                 'tmplt_body_content'        => $row->tmplt_body_content,
                                                 'tmplt_body_bgcolor'        => $row->tmplt_body_bgcolor,
                                                 'tmplt_footer_content'      => $row->tmplt_footer_content,                                               
                                                 'tmplt_footer_bgcolor'      => $row->tmplt_footer_bgcolor,
                                                 'status'                    => $row->status,
                                                 'active'                    => $row->active
                                                );
             
             $update_app_eml_mrktn_templt_local_admin = $this->global_mod->db_parse($update_app_eml_mrktn_templt_local_admin);                                 

             $this->db->trans_begin();
             $this->db->where('eml_mrktn_templt_local_admin_id',$eml_mrktn_templt_local_admin_id);
             $this->db->update('app_eml_mrktn_templt_local_admin',$update_app_eml_mrktn_templt_local_admin);  
              //echo $this->db->last_query();
              
             if ($this->db->trans_status() === FALSE)
             {
                     $this->db->trans_rollback(); 
             }
             else
             {
                     $this->db->trans_commit();
             } 
             echo $this->db->last_query();
         }
         //echo $tmplt_subject;
    }
         
    
    function sendTestMail($testemail,$tmplt_subject)
    {
       
         $this->load->database();

         $local_admin_id = $this->session->userdata('local_admin_id');

         $this->db->select('*');
         $this->db->from('app_eml_mrktn_templt_local_admin_temp');
         $this->db->where('status',1);
         $this->db->where('local_admin_id',$local_admin_id);


         $query = $this->db->get();
         //echo $this->db->last_query();
         if ($query->num_rows() > 0)
         {
             
			 $row=$query->row();
             $html='
                    <html>
                    <head>
                    <title>Email Verification</title>
                    <style>
                        .email_preview_header img
                        {
                        width: 600px; height: 200px;
                        }
                        .email_preview_content{width: 488px;padding: 8px; }
                        .email_preview_content img{ width: 488px;}
                        .email_preview_footer img{ width: 488px;}
                        .email_preview_footer{width: 488px;}

                       </style>
                    </head>
                    <body>';
                        $html.='<div style="border:5px solid #ccc">';                                                     
                          $html.='<div  style="background-color:'.$row->tmplt_header_bgcolor.'">';
                               $html.='<div class="email_preview_header" >';
                                  $html.= $this->global_mod->show_to_control($row->tmplt_header_content) ;  
                               $html.='</div>';               
                          $html.='</div>';
                          $html.='<div   style="background-color:'.$row->tmplt_body_bgcolor.'">';
                               $html.='<div class="email_preview_content" >';
                                  $html.= $this->global_mod->show_to_control($row->tmplt_body_content);
                               $html.='</div>';                
                          $html.='</div>';
                          $html.='<div style="background-color:'.$row->tmplt_footer_bgcolor.'">'; 
                              $html.='<div class="email_preview_footer" >';
                                  $html.=$row->tmplt_footer_content;  
                              $html.='</div>';           
                          $html.='</div>';                    
                      $html.='</div>';
                
                    $html.='</body>
                </html>';	
            
            
            
            $to  = $testemail;
            $subject = $tmplt_subject;
			$from = $this->session->userdata('ladmin_email');
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From:'.$from. "\r\n";
            if(mail($to, $subject, $html, $headers))
            {
                echo $this->global_mod->db_parse($this->lang->line("succ_mail_send"));
            }
            else
            {
                echo $this->global_mod->db_parse($this->lang->line("errr_snding"));
            }             
         }
    }
    function allUser()
    {
    $this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$sql1=$this->db->query(" Select * from (
		 SELECT distinct c1.user_id as  user_id,
        c2.local_admin_id as local_admin_id ,
		c1.date_creation as date_inserted,
		c3.country_name as country_name,
		c4.city_name as city_name,
		c5.region_name as region_name,
		c1.user_email as user_email,
                c1.user_name as user_name,
               
		
       ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_fname'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS cus_fname

     ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_lname'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS cus_lname
	   ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_address'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS cus_address
	  
	   ,
	   ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_status'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customer_status
	   ,
	   ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_zip'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customer_zip
	   ,
	 ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_mob'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS cus_mob
	   ,
	 ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_phn1'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS cus_phn1
	   ,
	 ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_phn2'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS cus_phn2
	    ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'customer_tag'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customer_tag
	   ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'customer_info'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customer_info
	    ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'time_zone_id'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS time_zone_id
  FROM app_password_manager c1 INNER JOIN
       app_local_customer_details c2 LEFT JOIN
	   app_countries c3 ON c3.country_id=( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_countryid'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       )
	   LEFT JOIN
	   app_cities c4 ON c4.city_id=( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_cityid'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       )
	  LEFT JOIN app_regions c5 ON c5.region_id=( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_regionid'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       )

	   where c1.user_type ='1' and 
	         c1.user_id=c2.customer_id and
			 c2.local_admin_id  ='".$local_admin_id."'
			
		
	   ) as maintable where 1=1");
		
		
		
		$html='';
                $html.='<table class="cus-listing-tabl ">
                          <tr>
                            <th><a href="javascript:void(0)" onclick="selectAll()">'.$this->global_mod->db_parse($this->lang->line("all")).'</a>/
                                <a href="javascript:void(0)" onclick="selectNone()">'.$this->global_mod->db_parse($this->lang->line("None")).'</a>
                            </th>
                            <th>'.$this->global_mod->db_parse($this->lang->line("user_name")).'</th>
                            <th>'.$this->global_mod->db_parse($this->lang->line("frst_name")).'</th>
                            <th>'.$this->global_mod->db_parse($this->lang->line("last_name")).'</th>
                            <th>City</th>
                          </tr> 
                            ';
		$count=0;
		if ($sql1->num_rows() > 0)
		{
			foreach ($sql1->result() as $row)
			{
                            $count=$count+1;
                            $html.='
                             <tr>
                               
                               <td><input type="checkbox" id="cus_chkbox" class="user_chk_cls" onclick="checkSelectedUser()" name="cus_chkbox" value="'.$row->user_id.'"></td>
                               <td>'.$user_name=$row->user_name.'</td>
                               <td>'.$cus_fname=$row->cus_fname.'</td>
                               <td>'.$cus_lname=$row->cus_lname.'</td>
                               <td>'.$cus_city=$row->city_name;
                               if($cus_city=$row->region_name !='')
                               {
                                   $html.=','.$cus_city=$row->region_name;
                               }
                           
                            $html.= '</td></tr>';
				
                        }
                }
                
                $html.='</table>';
                $arr=array(
                    'html' => $html,
                    'count' => $count
                    
                );
                $ret_array=  json_encode($arr);
                return $ret_array;
    }
    function sendMail($cuss_arr,$tmplt_subject)
    {
         $this->load->database();
         $local_admin_id = $this->session->userdata('local_admin_id');
         foreach($cuss_arr as $cuss_id)
         {
            $this->db->select('user_email');
            $this->db->from('app_password_manager');
            $this->db->where('user_id',$cuss_id);
            //$this->db->where('local_admin_id',$local_admin_id);
            $email = $this->db->get();
            //echo $this->db->last_query();
            if ($email->num_rows() > 0)
            {
                $row1=$email->row();
                $email_send=$row1->user_email;
            }
            $this->db->select('*');
            $this->db->from('app_eml_mrktn_templt_local_admin_temp');
            $this->db->where('status',1);
            $this->db->where('local_admin_id',$local_admin_id);
            $query = $this->db->get();
            //echo $this->db->last_query();
            if ($query->num_rows() > 0)
            {
                $row=$query->row();
                $html='
                       <html>
                       <head>
                       <title>Email Verification</title>
                       <style>
                           .email_preview_header img
                           {
                           width: 488px; height: 100px;
                           }
                           .email_preview_content{width: 488px;padding: 8px; }
                           .email_preview_content img{ width: 488px;}
                           .email_preview_footer img{ width: 488px;}
                           .email_preview_footer{width: 488px;}

                          </style>
                       </head>
                       <body>';
                           $html.='<div style="border:5px solid #ccc">';                                                     
                             $html.='<div  style="background-color:'.$row->tmplt_header_bgcolor.'">';
                                  $html.='<div class="email_preview_header" >';
                                     $html.= $this->global_mod->show_to_control($row->tmplt_header_content) ;  
                                  $html.='</div>';               
                             $html.='</div>';
                             $html.='<div   style="background-color:'.$row->tmplt_body_bgcolor.'">';
                                  $html.='<div class="email_preview_content" >';
                                     $html.= $this->global_mod->show_to_control($row->tmplt_body_content);
                                  $html.='</div>';                
                             $html.='</div>';
                             $html.='<div style="background-color:'.$row->tmplt_footer_bgcolor.'">'; 
                                 $html.='<div class="email_preview_footer" >';
                                     $html.=$row->tmplt_footer_content;  
                                 $html.='</div>';           
                             $html.='</div>';                    
                         $html.='</div>';

                       $html.='</body>
                   </html>';	



               $to  = $email_send; 
               $subject = $tmplt_subject;


               $headers  = 'MIME-Version: 1.0' . "\r\n";
               $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
               $headers .= 'From: Sandipan Mandal <sandipancitytech@gmail.com>' . "\r\n";
               mail($to, $subject, $html, $headers);
               if(mail($to, $subject, $html, $headers))
               {
                   echo $this->global_mod->db_parse($this->lang->line("succ_mail_send"));
               }
               else
               {
                   echo $this->global_mod->db_parse($this->lang->line("errr_snding"));
               }             
            }
         }       
    }
    
    
    
    
    
    
    
    function saveSubject($tmplt_subject)
    {
            $local_admin_id = $this->session->userdata('local_admin_id');
            $data = array(
            'tmplt_subject' => $this->global_mod->db_parse($tmplt_subject)
            );
            $this->db->trans_begin();
            $this->db->where('local_admin_id',$local_admin_id);
            //$this->db->where('eml_mrktn_templt_id',$eml_mrktn_templt_id);
            $this->db->update('app_eml_mrktn_templt_local_admin_temp', $data);
            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
            }
            else
            {
                    $this->db->trans_commit();
            } 
        
    }
    
    
    public function check_display_customer($registration_start_date,$registration_end_date,$customer_tag,$customer_status)
    {
		$local_admin_id = $this->session->userdata('local_admin_id');
                                
                if($customer_status != "")
                {
                        $UserStatusQryPlgIn = " and c1.email_veri_status='".$customer_status."' ";
                }
                else {
                        $UserStatusQryPlgIn = "";
                }
		
		//echo ">>>>>>>>>>>>>>>>>>>>>>>>".$local_admin_id."<<<<<<<<<<<<<<<<";
		
		$rtn='<h1 align="center" style="border-bottom:thick;border-bottom-color:#000000">'.$this->global_mod->db_parse($this->lang->line("clients_list")).'</h1><BR/>
<form name="ExportExcel" id="ExportExcel" action="" method="post">
<div class="print"><a href="#" onClick="printon()"><img src="/images/print.png" />'.$this->global_mod->db_parse($this->lang->line("print_page")).'</a> <a href="#" onClick="exporton()"><img src="/images/export_excel.png" />'.$this->global_mod->db_parse($this->lang->line("xport_2_excl")).'</a> </div>
</form><table class="client-list" cellspacing="0" cellpadding="0" width="98%"><thead><tr><th>'.$this->global_mod->db_parse($this->lang->line("sr_no")).'</th><th>'.$this->global_mod->db_parse($this->lang->line("client_name")).'</th><th>'.$this->global_mod->db_parse($this->lang->line("cntact_info")).'</th><th>'.$this->global_mod->db_parse($this->lang->line("other_info")).'</th></tr></thead><tbody>';
			
			$date_sql="Select * from (
		 SELECT distinct c1.user_id as  user_id,
        c2.local_admin_id as local_admin_id ,
		c1.date_creation as date_inserted,
		c3.country_name as country_name,
		c4.city_name as city_name,
		c5.region_name as region_name,
		c1.user_email as user_email,
                c1.user_name as user_name,
       ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_fname'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS Firstname

     ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_lname'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customerLastName
	   ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'customer_tag'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customer_tag
	   ,
	   ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_status'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customer_status
	   ,
	   ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_zip'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customer_zip
	   ,
	 ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_mob'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customer_mobile
	   ,
	   ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_address'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customer_address
	   
	 

  FROM app_password_manager c1, app_local_customer_details c2,app_countries c3,app_cities c4,app_regions c5 
  where c1.user_type ='1'  and c1.user_id=c2.customer_id       ".$UserStatusQryPlgIn."        and c2.local_admin_id  = '$local_admin_id' and c3.country_id=( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_countryid'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) and c4.city_id=( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_cityid'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) and  c5.region_id=( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_regionid'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) ) as maintable where  1=1 ";
	   $date_sql1=$this->db->query($date_sql);
	   $search_result= $date_sql1->num_rows();
		
		
		if(!empty($registration_start_date))
		{
			$registration_start_date_format=$this->changeDtFrmat($registration_start_date);
			$date_sql.= " AND maintable.date_inserted  >='".$registration_start_date_format."'";
		}
		
		if(!empty($registration_end_date))
		{
		$registration_end_date_format=$this->changeDtFrmat($registration_end_date);
		
		
		//$date_sql.= " AND date_inserted  <='".$registration_end_date."'";
		$date_sql.= " AND maintable.date_inserted <='".$registration_end_date_format."'";
		}
		if(!empty($customer_tag)){
		$customer_tag1=mysql_real_escape_string($customer_tag);
		 $date_sql.= " AND maintable.customer_tag  like '%".$customer_tag1."%'";
		}
		/*if(!empty($customer_status)){
		 $date_sql.= " AND maintable.customer_status  = '".$customer_status."'";
		}*/
		$date_sql.="ORDER BY date_inserted desc";	
		
		$date_sql1=$this->db->query($date_sql);
		$search_result= $date_sql1->num_rows();
		
		//exit;
		$temp='';
		
		$m='1';
		
                
                $html='';
                $html.='<table class="cus-listing-tabl ">
                          <tr>
                            <th><a href="javascript:void(0)" onclick="selectAll()">'.$this->global_mod->db_parse($this->lang->line("all")).'</a>/
                                <a href="javascript:void(0)" onclick="selectNone()">'.$this->global_mod->db_parse($this->lang->line("none")).'</a>
                            </th>
                            <th>'.$this->global_mod->db_parse($this->lang->line("user_name")).'</th>
                            <th>'.$this->global_mod->db_parse($this->lang->line("frst_name")).'</th>
                            <th>'.$this->global_mod->db_parse($this->lang->line("last_name")).'</th>
                            <th>'.$this->global_mod->db_parse($this->lang->line("city")).'</th>
                          </tr> 
                            ';
		$count=0;
		if($search_result>0)
		{
		foreach ($date_sql1->result() as $row1)
			{
                            $count=$count+1;
                            $html.='
                             <tr>
                               
                               <td><input type="checkbox" id="cus_chkbox" class="user_chk_cls" onclick="checkSelectedUser()" name="cus_chkbox" value="'.$row1->user_id.'"></td>
                               <td>'.$user_name=$row1->user_name.'</td>
                               <td>'.$cus_fname=$row1->Firstname.'</td>
                               <td>'.$cus_lname=$row1->customerLastName.'</td>
                               <td>'.$cus_city=$row1->city_name;
                               if($cus_city=$row1->region_name !='')
                               {
                                   $html.=','.$cus_city=$row1->region_name;
                               }
                           
                            $html.= '</td></tr>';
				
                        }
                }
                
                $html.='</table>';
                $arr=array(
                    'html' => $html,
                    'count' => $count
                    
                );
                $ret_array=  json_encode($arr);
                return $ret_array;
    }
    function customerStatus()
    {
        $this->load->database();
        //$local_admin_id = $this->session->userdata('local_admin_id');
        /*$sql=$this->db->query("SELECT ct.* from  app_pardco_code_code cc and app_pardco_code_type_master ct where cc.app_pardco_code_type_master=ct.app_pardco_code_type_master and ct.code='Customer_Status'");*/


        $customerStatus='<select name="clientStatus" id="clientStatus" class="text-input required" >
                                  <option value="" >All</option>';

        $this->load->database();

       $sql=$this->db->query("SELECT cc . *
    FROM app_pardco_code_code cc, app_pardco_code_type_master ct
    WHERE cc.code_type_master_id = ct.code_type_master_id
    AND ct.code = 'Customer_Status' order by cc.code_order");

        foreach ($sql->result() as $row)
        {
            $status_value=$row->code_code;
            $status_show_value=$row->code_value;

            $customerStatus.="<option value=".$status_value.">".$status_show_value."</option>";

        }

        $customerStatus.='</select>';	
        return $customerStatus;		
    }
    public function changeDtFrmat($date)
    {
        $oldDate = $date;
        $arr = explode('/', $oldDate);
        return $newDate = $arr[2].'-'.$arr[0].'-'.$arr[1];
    }
    
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////   
    
    public function SaveCategory($category_name){
    	$data = array(
		   'emlMrktn_cat_name' 		=> $category_name,
		   'emlMrktn_cat_isdefult'  => '0',
		   'emlMrktn_cat_status'   	=> '1',
		   'emlMrktn_cat_addDate'	=> date("y-m-d"),
		   'emlMrktn_cat_editDAte'	=> date("y-m-d")
		);
		$data = $this->global_mod->db_parse($data);
		$this->db->insert('app_emlmrktn_category', $data);
		$CatInsertId = $this->db->insert_id();
		$LocalAdminId = $this->session->userdata('local_admin_id');
		$data = array(
			'app_emlmrktn_rel_cat_id'			=> $CatInsertId,
			'app_emlmrktn_rel_tmp_id'			=> 1,
			'app_emlmrktn_rel_localadmin_id'	=> $LocalAdminId,
			'app_emlmrktn_rel_adddate'			=> date("y-m-d"),
			'app_emlmrktn_rel_editdate'			=> date("y-m-d")
		);
		$data = $this->global_mod->db_parse($data);
		$this->db->insert('app_emlmrktn_relation',$data);
		if( $this->db->insert_id() >0){
			return 1;
		}else{
			return 0;
		}
	}
	
	
	public function SaveAsNewTemplate($CategoryId,$Subject,$Body){
		$LocalAdminId = $this->session->userdata('local_admin_id');
		$data = array(
					'app_emlmrktn_tem_subject'	=> trim($Subject),
					'app_emlmrktn_tem_content'	=> trim($Body),
					'app_emlmrktn_tem_status'	=> 1,
					'app_emlmrktn_tem_adddate'	=> date("y-m-d")
				);
		$data = $this->global_mod->db_parse($data);		
		$this->db->insert('app_emlmrktn_template', $data);
		$TemplateId = $this->db->insert_id();
		
		$data1 = array(
					'app_emlmrktn_rel_cat_id'			=> $CategoryId,
					'app_emlmrktn_rel_tmp_id'			=> $TemplateId,
					'app_emlmrktn_rel_localadmin_id'	=> $LocalAdminId,
					'app_emlmrktn_rel_adddate'			=> date("y-m-d")
				 );	
		$data1 = $this->global_mod->db_parse($data1);		 
		$this->db->insert('app_emlmrktn_relation', $data1);	
		return 1;	 		
	}
	
	public function PreviewBodyContent($tmplt_id){
		
		$this->db->select("app_emlmrktn_tem_content");
		$this->db->from('app_emlmrktn_template');
		$this->db->where('app_emlmrktn_tem_id',$tmplt_id);
		$query = $this->db->get();
		$row=$query->row();
		return $row->app_emlmrktn_tem_content;
		
	}
	
	public function GetMailContent($tmplt_id){
		$this->db->select("*");
		$this->db->from('app_emlmrktn_template');
		$this->db->where('app_emlmrktn_tem_id',$tmplt_id);
		$query = $this->db->get();
		$row=$query->row();
		return $row;
	}
	
	public function getvaluebySendvalue(){
		$getvalue = $this->input->post('sendValue');
		$local_admin_id = $this->session->userdata('local_admin_id');
		if($getvalue == 1){
			$this->db->select('customertype_id,customertype_name');
	        $this->db->from('app_customertype');
	        $this->db->where('customertype_localadmin ',$local_admin_id);
	        $this->db->where('customertype_status ','Y');
	        $query = $this->db->get();
	        $Ret_Arr = $query->result_array();
	        
	        if(count($Ret_Arr)>0){
	        	$string = '';
	        	$string .= '<li><span><b>Customer Type list :</b></span></li>';
				foreach($Ret_Arr as $val){
					$string .= '<li style="padding-left:50px;"><input type="checkbox" class="typelistclass" name="typelist[]" value="'.$val['customertype_id'].'"> '.$val['customertype_name'].'</li>';
				}
				$string .= '<br><li style="padding-left:50px;cursor:pointer;"><input type="button" name="orimailsend" id="orimailsend" value="Send Mail to Customer group" onclick="sendmailtocusgroup()" /></li>';
				echo $string;
			}
	        
		}else{
			$string = '<li><span><b>Search Customer by Name :</b></span> <input type="text" name="searchkey" id="searchkey" /> <input type="button" value="Search" onclick="searchCustomer()" /></li>';
			echo $string;
			
		}
		
	}
	
	public function getCuslistBygroup($cusGroup){
		$local_admin_id = $this->session->userdata('local_admin_id');
		$sql = 'SELECT DISTINCT
     				  user.user_email
				FROM
				    app_password_manager user
				JOIN
				    app_customer_type_relation rel
				ON
				    rel.typerelation_customer_id=user.user_id
				WHERE
				    rel.typerelation_localadmin=372
				AND
				    rel.typerelation_customertype_id IN('.$cusGroup.')
    		   ';
    		   
    		  $query = $this->db->query($sql);
        	  $Arr = $query->result_array();
        	  return $Arr;
	}
	
	
    
}
?>


