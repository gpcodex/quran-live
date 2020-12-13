<?php

class Render_Quran_Live{
	
	static function load_sura_quran_live($sura=null,$lang,$cheikh){
		
		if($sura == null){$sura = rand ( 1 , 114 );}

		if($sura != 9){
		echo '<p id="audio_live_quran">
				<audio controls id="au" autoplay="autoplay" style="display:block;" src="//islamaudio.fr/verset/Shuraym/1/1.mp3" type="audio/mpeg">
				 Your browser does not support this audio format.
				</audio>
			</p>';			
		}
		
		$tab_info_sura =  Render_Quran_Live::information_sura_quran_live($sura);
		$nbr_verse = $tab_info_sura["number_verse"];
		$tab_all_verse = Render_Quran_Live::load_verse_quran_live($sura,$nbr_verse,$lang);

		Render_Quran_Live::render_verse_quran_live($tab_info_sura,$tab_all_verse,$sura,$cheikh,$lang);		
		
		
	}
	
	//fonction qui charge le verset traduit
	static function load_verse_quran_live($s,$num_verse,$lang){


	$sura_data = $s."|";
	$matches = array();
	$line = 0;		
	if($lang == null){
		$lang = get_option('quran_live_languages');
	}
	
	$handle = @fopen(''.QURAN_LIVE_PLUGIN_URL.'/data/'.$lang.'.txt', 'r');
	
	if ($handle)
	{

	

		while (!feof($handle))
		{
			
				$buffer = fgets($handle);
					
			   if(strpos($buffer, $sura_data) === 0){
			   $p[] = $line;
					$verse_t = explode('|', $buffer);
					$matches[] = array("translate" => trim($verse_t[2]));
					
				}
		$line++;
		

		}
		
		fclose($handle);
	}
					$tast[] = @fileToObject("".QURAN_LIVE_PLUGIN_URL."/data/data.xml");
					$object_info 	  = $tast[0]->root->children[0]->children;
					$sura_info		  = $s-1;
					$name_sura        = $object_info[$sura_info]->attributes['tname'];
					$revelation_sura  = $object_info[$sura_info]->attributes['type'];
					$name_arabic_sura = $object_info[$sura_info]->attributes['name'];
					$nbr_verse_sura   = $object_info[$sura_info]->attributes['ayas'];	
	
	
	
			$lines_ar = file(''.QURAN_LIVE_PLUGIN_URL.'/data/arabe.txt');
			$info = array();
			

			foreach($p as $l){
				
			foreach($lines_ar as $cle=>$line_ar) {
				if($l == $cle){
				$line_ar = trim($line_ar);
				$info[$cle] =  $line_ar;
				$tab[] = str_replace('بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ', '', $info[$cle]);
				}

			}		
			
			}
		$i=0;	
		foreach($matches as $verse){
		$verse_translate = $verse['translate'];
		$tab_all_verse[] = array("verse_translate" => trim($verse_translate), "verse_arabic" => trim($tab[$i]));
		$i++;	
		}	
	return $tab_all_verse;
	}
	

	
	//function qui récupère les infomations de la sourate
	
	static function information_sura_quran_live($sura){
		
		$sura = $sura -1;
		
		$tast[] = fileToObject("".QURAN_LIVE_PLUGIN_URL."/data/data.xml");
		
		$object_info = $tast[0]->root->children[0]->children;
		
		$name_sura        = $object_info[$sura]->attributes['tname'];
		$revelation_sura  = $object_info[$sura]->attributes['type'];
		$name_arabic_sura = $object_info[$sura]->attributes['name'];
		$nbr_verse_sura   = $object_info[$sura]->attributes['ayas'];
		
		$tab_info_sura    = array(
							"name_sura" => $name_sura, 
							"revelation_sura" => $revelation_sura, 
							"name_arabic_sura" => $name_arabic_sura, 
							"number_verse" => $nbr_verse_sura
							);
		return $tab_info_sura;
	}
	
	
	static function render_verse_quran_live($info_sura,$tab_all_verse,$sura,$cheikh,$lang){

		$number_verset = $info_sura['number_verse'];

	?>
		
		<script>
		jQuery("#sura_quran_live option[value='<?=$sura;?>']").attr("selected","selected");
		jQuery("#data_verse").html("<?php
		$i=0;
		foreach($tab_all_verse as $data_verse){
			$i++;
			$verse_translate = trim($data_verse['verse_translate']);
			$verse_translate = str_replace('"', "'", $verse_translate);
			$verse_arabic = trim($data_verse['verse_arabic']);

			
			echo "<p id='versetranslate-".$i."'>".$verse_translate."</p>";
			echo "<p id='versearabic-".$i."'>".$verse_arabic."</p>";

			
		}
			$revelation_sura = $info_sura['revelation_sura'];
			$name_sura = $info_sura['name_arabic_sura'];
			$number_verse = $info_sura['number_verse'];		
			echo "<p id='revelation_sura-".$sura."'>".$revelation_sura."</p>";
			echo "<p id='nom_arabe_sura-".$sura."'>".$name_sura."</p>";
			echo "<p id='nbr_verse_sura-".$sura."'>".$number_verse."</p>";		
		?>");
		
		var c=1;
		var f=<?=$number_verset;?>;
		var sura=<?=$sura;?>;
		
		var revelation_sura = jQuery("#revelation_sura-"+sura+"").text();
		var name_sura = jQuery("#nom_arabe_sura-"+sura+"").text();	
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
  		jQuery('#revelation_sura').html(""+revelation_sura+"");
  		jQuery('#nom_arabe_sura').html(""+name_sura+"");
  		jQuery('#nbr_verse_sura').html("1 - <?=$number_verset;?>");	
		jQuery('#name_sura').css("width", "100%");
		jQuery('#name_sura').css("margin-bottom", "5px");
		jQuery('#information_quran_live').css("height", "70px");
		jQuery('#nbr_verse_sura').css("width", "30%");
		jQuery('#nom_arabe_sura').css("width", "30%");
		jQuery('#icon_fullscreen').css("width", "33px");
		jQuery('#icon_fullscreen').css("margin-top", "10px");
}else{
  		jQuery('#revelation_sura').html("Révélation : "+revelation_sura+"");
  		jQuery('#nom_arabe_sura').html("Sura : "+name_sura+"");
  		jQuery('#nbr_verse_sura').html("verse : 1 - <?=$number_verset;?>");	
}	


		var a=document.getElementById("au");
		if(sura == 9 || sura ==1){
			document.getElementById("au").src="//islamaudio.fr/verset/no.mp3";
			a.load();
		}
		
		a.addEventListener('ended', function(){
			
		if(c<=f){

		<?php
		if($cheikh == null){$cheikh = get_option('quran_live_recitator');}
		?>
		document.getElementById("au").src="//islamaudio.fr/verset/<?=$cheikh;?>/"+sura+"/"+c+".mp3";
		
		a.load();

		var verse_translate = jQuery("#versetranslate-"+c+"").text();
		var verse_arabic = jQuery("#versearabic-"+c+"").text();
		var number_verse = jQuery("#nbr_verse_sura-"+sura+"").text();
		
		jQuery('#verset_trans').html(""+verse_translate+"");
		jQuery('#verset_arabe').html(""+verse_arabic+"");
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
  		jQuery('#nbr_verse_sura').html(""+c+" - <?=$number_verset;?>");
		}else{
		jQuery('#nbr_verse_sura').html("verse : "+c+" - <?=$number_verset;?>");	
		}

		}
		else{
			jQuery("#verset_trans").html('');
			jQuery("#verset_arabe").html('<p style="text-align:center;"><img src="<?=plugins_url('quran-live').'/template/images/ajax-loader.gif';?>"></p>');
			
			jQuery.post(
              ajaxurl,
              {
                    'action': 'qtm_quranlive_load',
					'lang'  : '<?=$lang;?>',
					'cheikh': '<?=$cheikh;?>'
              },
            function(response){

			jQuery("#callback_quran_live").html(response);
		
            }
          );
		}	
		c++;	
	


		
		});
jQuery(document).ready(function($){
      $('#sura_quran_live').on("change", function(){
		$("#verset_arabe").html('<p style="text-align:center;"><img src="'+livequran.pluginsUrl+'/template/images/ajax-loader.gif"></p>');

        var sura = $(this).val();
		
		$("#verset_trans").html('');
		
          jQuery.post(
              ajaxurl,
              {
                    'action': 'qtm_changelivesura',
                    'sura': sura,
					'lang'  : '<?=$lang;?>',
					'cheikh': '<?=$cheikh;?>'
              },
            function(response){
				$('audio').each(function(){
					this.pause(); // Stop playing
					this.currentTime = 0; // Reset time
				}); 
				$("#callback_quran_live").html(response);
            }
          );
				  
		  
      });	
      });	
		</script>
		
		<?php
	

	}
}
?>