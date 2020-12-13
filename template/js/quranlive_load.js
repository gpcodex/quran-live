
jQuery(document).ready(function($){

if (document.addEventListener)
{
    document.addEventListener('webkitfullscreenchange', exitHandler, false);
    document.addEventListener('mozfullscreenchange', exitHandler, false);
    document.addEventListener('fullscreenchange', exitHandler, false);
    document.addEventListener('MSFullscreenChange', exitHandler, false);
}

function exitHandler()
{
    if (!document.webkitIsFullScreen && !document.mozFullScreen && !document.msFullscreenElement)
    {
								$('#bloc_live_quran').css("min-height", "" );
								$('#bloc_live_quran').css("display", "" );
								$('#bloc_live_quran').css("flex-direction", "" );
								$('#bloc_live_quran').css("justify-content", "" );
								$('#bloc_live_quran').css("align-items", "" );
								$('#verset_arabe').css("font-size", "" );
								$('#verset_trans').css("font-size", "" );
    }
}	
		$(function () {
		$('.icon_fullscreenkb').click(function () {

		screenfull.toggle($('#refresh_sura')[0]);
						if (screenfull.isFullscreen) {
								$('#bloc_live_quran').css("min-height", "" );
								$('#bloc_live_quran').css("display", "" );
								$('#bloc_live_quran').css("flex-direction", "" );
								$('#bloc_live_quran').css("justify-content", "" );
								$('#bloc_live_quran').css("align-items", "" );
								$('#verset_arabe').css("font-size", "" );
								$('#verset_trans').css("font-size", "" );					
			
						}
					
						else{
								$('#bloc_live_quran').css("min-height", "100vh" );
								$('#bloc_live_quran').css("display", "flex" );
								$('#bloc_live_quran').css("flex-direction", "column" );
								$('#bloc_live_quran').css("justify-content", "center" );
								$('#bloc_live_quran').css("align-items", "center" );
								$('#verset_arabe').css("font-size", "60px" );
								$('#verset_trans').css("font-size", "40px" );
								$('#verset_arabe').css("margin-top", "0px");	
					
						}
						
						


		});
		});
		jQuery('#btnplay').hide();
		jQuery('#btnpause').show();
		jQuery('#btnpause').click(function(){
		jQuery('#btnpause').hide();
		jQuery('#btnplay').show();
		  document.getElementById('au').pause();
		  return false;
		});

		jQuery('#btnplay').click(function(){
		jQuery('#btnplay').hide();
		jQuery('#btnpause').show();
		  document.getElementById('au').play();
		  return false;
		});

	 
});