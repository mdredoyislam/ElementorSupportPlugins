;(function(jQuery){
    jQuery(document).ready(function(){
        //jQuery("input:hidden[value='style_select_hidden']").parents('.elementor-control').prev().find('select').hide();
    });
    elementor.hooks.addAction("panel/open_editor/widgets/pricingWidget", function(panel,model,view){
        jQuery("input:hidden[value='style_select_hidden']").parents('.elementor-control').prev().find('select').on('click', function(){
            if('blue' == jQuery(this).val()){
                jQuery("input:hidden[value='items_hidden_selector']").parents(".elementor-control").prev().hide();
            }else{
                jQuery("input:hidden[value='items_hidden_selector']").parents(".elementor-control").prev().show();
            }
        });
        if('blue' == jQuery("input:hidden[value='style_select_hidden']").parents('.elementor-control').prev().find('select').val()){
            jQuery("input:hidden[value='items_hidden_selector']").parents(".elementor-control").prev().hide();
        }else{
            jQuery("input:hidden[value='items_hidden_selector']").parents(".elementor-control").prev().show();
        }
    });
})(jQuery);