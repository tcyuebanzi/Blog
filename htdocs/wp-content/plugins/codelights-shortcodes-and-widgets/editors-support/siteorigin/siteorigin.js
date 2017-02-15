!function($){
	var initEForms = function(){
		$('.cl-eform:not(.inited)').each(function(index, eform){
			var $eform = $(eform);
			$eform.addClass('inited');
			new $cl.EForm($eform);
		});
	};
	var initSOWidgets = function(){
		$('.so-widget:not(.cl_inited)').each(function(index, widget){
			var $widget = $(widget);
			$widget.addClass('cl_inited').data('view').getEditDialog().on('form_loaded', initEForms);
		});
	};
	$(document).on('panels_setup', function(event, builderView){
		initSOWidgets();
		builderView.on('content_change display_builder', function(){
			$('.so-panels-dialog-wrapper').each(function(index, wrapper){
				$(wrapper).data('view').on('form_loaded', initEForms);
			});
		});
	});
	var $widgetsArea = $('#widgets-right');
	if ($widgetsArea.length){
		$widgetsArea.on('click', '.siteorigin-panels-display-builder', initSOWidgets);
	}
}(jQuery);
