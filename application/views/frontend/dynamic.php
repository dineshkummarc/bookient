<?php

	$local_admin_id = $this->session->userdata('local_admin_id');
	
	$LiqLayOutData=$this->dynamic_mod->get_theme_details($local_admin_id);
?>

<?php //echo $LiqLayOutData->background_color;?>

<style>
/* ########################## FOR ADMIN UPDATE AREA ################################ */
.backgroundchange { background:url(images/none.png) no-repeat #<?php echo $LiqLayOutData->background_color;?>} /* DOCUMENT BACKGROUND COLOR CHANGE */
.row {max-width: 950px;}  /* DOCUMENT WIDTH CHANGE */

.aside, .greentheme .aside, .orangetheme .aside, .violettheme .aside, .greentheme .aside ul li:hover, .orangetheme .aside ul li:hover, .violettheme .aside ul li:hover {background:#<?php echo $LiqLayOutData->aside_color;?>;} /* CHANGE ASIDE COLOR */

.default .content_panel, .greentheme .content_panel, .orangetheme .content_panel, .vi0olettheme .content_panel, .default .content_tab ul li a, .greentheme .content_tab ul li a, .orangetheme .content_tab ul li a, .violettheme .content_tab ul li a {background:#<?php echo $LiqLayOutData->content_panel_blok_bg_color;?>; color:#<?php echo $LiqLayOutData->content_panel_blok_color;?>} /* To Change content panel block */

.default .content_tab ul li a:hover, .greentheme .content_tab ul li a:hover, .orangetheme .content_tab ul li a:hover, .violettheme .content_tab ul li a:hover {background:#<?php echo $LiqLayOutData->tab_hover_color;?>} /* To Change Tab hover color */

.default .content, .greentheme .content, .orangetheme .content, .violettheme .content {border:2px solid #<?php echo $LiqLayOutData->content_panel_outer_color;?>} /* Content Outer Color */
.default .content .top_heading, .greentheme .content .top_heading, .orangetheme .content .top_heading, .violettheme .content .top_heading {border-bottom:2px solid #<?php echo $LiqLayOutData->content_panel_head_brdr_color;?>; background:#<?php echo $LiqLayOutData->content_panel_head_bg_col;?>} /* To CHANGE CONTENT PANEL TOP HEADING BG COLOR AND BORDER COLOR */

.default .content .bottom_heading, .greentheme .content .bottom_heading, .orangetheme .content .bottom_heading, .violettheme .content .bottom_heading {border-top:2px solid #<?php echo $LiqLayOutData->content_panel_btm_brdr_color;?>; background:#<?php echo $LiqLayOutData->content_panel_btm_bg_color;?> } /* To CHANGE CONTENT PANEL BOTTOM HEADING BG COLOR AND BORDER COLOR */

.aside, .greentheme .aside, .orangetheme .aside, .violettheme .aside, .default .content_panel, .greentheme .content_panel, .orangetheme .content_panel, .violettheme .content_panel {
-webkit-border-radius: 5px 0px 0px 5px; /* PRINT SAME Value for all */
-moz-border-radius: 5px 0px 0px 5px;/* PRINT SAME Value for all */
border-radius: 5px 0px 0px 5px;/* PRINT SAME Value for all##################### To CHANGE BLOCK ROUNDS */        
}
/* ########################## FOR ADMIN UPDATE AREA ################################ */

/* ########################## @ MEDIA HANDLED, FOR ADMIN UPDATE AREA ################################ */

@media handheld, only screen and (max-width: 767px)
{
	
	.backgroundchange { background:url(images/none.png) no-repeat #<?php echo $LiqLayOutData->background_color;?>} /* DOCUMENT BACKGROUND COLOR CHANGE */
.row {max-width: 100%;} /* width will be 100% [FIXED] for Mobile Devices */

.aside, .greentheme .aside, .orangetheme .aside, .violettheme .aside, .greentheme .aside ul li:hover, .orangetheme .aside ul li:hover, .violettheme .aside ul li:hover {background:#<?php echo $LiqLayOutData->aside_color;?>;} /* CHANGE ASIDE COLOR */

.default .content_panel, .greentheme .content_panel, .orangetheme .content_panel, .vi0olettheme .content_panel, .default .content_tab ul li a, .greentheme .content_tab ul li a, .orangetheme .content_tab ul li a, .violettheme .content_tab ul li a {background:#<?php echo $LiqLayOutData->content_panel_blok_bg_color;?>; color:#<?php echo $LiqLayOutData->content_panel_blok_color;?>} /* To Change content panel block */

.default .content_tab ul li a:hover, .greentheme .content_tab ul li a:hover, .orangetheme .content_tab ul li a:hover, .violettheme .content_tab ul li a:hover {background:#<?php echo $LiqLayOutData->tab_hover_color;?>} /* To Change Tab hover color */

.default .content, .greentheme .content, .orangetheme .content, .violettheme .content {border:2px solid #<?php echo $LiqLayOutData->content_panel_outer_color;?>} /* Content Outer Color */
.default .content .top_heading, .greentheme .content .top_heading, .orangetheme .content .top_heading, .violettheme .content .top_heading {border-bottom:2px solid #<?php echo $LiqLayOutData->content_panel_head_brdr_color;?>; background:#<?php echo $LiqLayOutData->content_panel_head_bg_col;?>} /* To CHANGE CONTENT PANEL TOP HEADING BG COLOR AND BORDER COLOR */

.default .content .bottom_heading, .greentheme .content .bottom_heading, .orangetheme .content .bottom_heading, .violettheme .content .bottom_heading {border-top:2px solid #<?php echo $LiqLayOutData->content_panel_btm_brdr_color;?>; background:#<?php echo $LiqLayOutData->content_panel_btm_bg_color;?> } /* To CHANGE CONTENT PANEL BOTTOM HEADING BG COLOR AND BORDER COLOR */

.aside, .greentheme .aside, .orangetheme .aside, .violettheme .aside, .default .content_panel, .greentheme .content_panel, .orangetheme .content_panel, .violettheme .content_panel {
-webkit-border-radius: 5px 0px 0px 5px; /* PRINT SAME Value for all */
-moz-border-radius: 5px 0px 0px 5px;/* PRINT SAME Value for all */
border-radius: 5px 0px 0px 5px;/* PRINT SAME Value for all##################### To CHANGE BLOCK ROUNDS */        
}
}
/* ########################## @ MEDIA HANDLED, FOR ADMIN UPDATE AREA ################################ */
</style>
