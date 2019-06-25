<style>
@media only screen and (max-width: 760px), (min-width: 768px) and (max-width: 1024px) {
	#name_sura{width:75%;}
	#revelation_sura{display:none !important;}
	#nom_arabe_sura{display:none !important;}
	#nbr_verse_sura{display:none !important;}
	#sura_quran_live{width:80%}
	#name_sura{display: block;}
	#verset_arabe{
	direction: rtl;
	font-size: 28px !important;
	margin-top: -7px !important;
	text-align:right !important;
	margin-right:2px;
	color:white;
	padding:10px;

	}
	#verset_trans{
	font-size: 18px !important;
	text-align:left !important;
	color:white;
	padding:5px !important;
	}
#refresh_sura{
	width:100%;
	height:auto;
	box-shadow:0 2px 2px rgba(0,0,0,0.8);
	background-image: url("<?=plugins_url(''.get_option('template_quran_live').'.jpg', __FILE__ );?>") ;
	background-repeat:repeat-x;
	background-size: auto 100%;
	z-index: 99;
	min-height:300px !important;
}
#bloc_live_quran {
    padding: 4px !important;
}	
#icon_fullscreen {

    padding: 5px;
    position: absolute;
    right: 30px;
    margin-top: 0px !important;
}
#player_quran_live {
position: absolute;
    left: 30px;
}
}
<?php echo get_option('quranlive_custum_css'); ?>

@font-face {
    font-family: "textQuran";
    src: url('<?php echo plugin_dir_url(__FILE__); ?>UthmanicHafs1Ver08.otf');
}

#refresh_sura{
	width:100%;
	height:auto;
	min-height:100%;
	box-shadow:0 2px 2px rgba(0,0,0,0.8);
	<?php 
	if(get_option('tpl_quran_live') == "disabled"){
		echo 'background:#'.get_option('background_quranlive_color').';';
	}else{?>
	background-image: url("<?=plugins_url(''.get_option('template_quran_live').'.jpg', __FILE__ );?>") ;
	background-repeat:repeat-x;
	background-size: auto 100%;	
	<?php	
	}
	?>

	z-index: 99;
	margin-bottom: 50px;
}
#bg_nature{
	width:100%;
	#box-shadow:0 2px 2px rgba(0,0,0,0.8);

	clear:both;
}
#bloc_live_quran{
	width: 90%;
	margin:auto;
	padding:20px;
	min-height: 300px;
}
#result{
	font-size:18px;
	width:100%;
}
#verset_arabe{
font-family:textQuran !important;
direction: rtl;
font-size: 35px;
margin-top: 5%;
line-height: inherit;
color:white;
}
#verset_trans{
	font-size: 24px;
	color:white;
	line-height: inherit;
}
#au{
	position:relative;
	width:50%;
	display:block;
	margin:auto;
	display:none;
}
#information_quran_live{
    width: 100%;
	height: 60px;
	border-bottom:1px solid #ffffff;
}
#info_quran_live{
	margin: 0 auto;
    width: auto;
    display: table;
}
#sura_quran_live{
	height:30px !important;
}
#audio_live_quran{display:none;}
#btnplay{display:none;cursor:pointer;}
#btnpause{display:none;cursor:pointer;}
#name_sura{height:48px;padding:10px;display:block;float:left;color:#FFFFFF;font-size: 18px;}
#nom_arabe_sura{height:48px;padding:10px;text-align:center;display:block;float:left;color:#FFFFFF;font-size: 18px;}
#revelation_sura{height:48px;padding:10px;display:block;float:left;float:left;color:#FFFFFF;font-size: 18px;}
#nbr_verse_sura{height:48px;padding:10px;display:block;float:left;color:#FFFFFF;font-size: 18px;}
#player_quran_live{display:block;float:left;}
#icon_fullscreen{width:48px;padding:5px;display:block !important;float:left;cursor:pointer;}
</style>