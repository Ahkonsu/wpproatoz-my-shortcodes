<div style="padding: 3px 0 10px;">
    <button type="button" onclick="msc_addJSLibrary();" class="cbutton"><i class="icon-plus"></i> Add JavaScript Library</button>
    <button type="button" onclick="msc_addCSSLibrary();" class="cbutton"><i class="icon-plus"></i> Add CSS Library</button>
</div>
<div id="jslibraryPane">
<?php
    if(!empty($Element['_jsLib'])){
        foreach($Element['_jsLib'] as $key=>$var){

            $foot = '';
            $head = 'selected="selected"';
            if(!empty($Element['_jsLibLoc'][$key])){
                if($Element['_jsLibLoc'][$key] == 2){
                    $head = '';
                    $foot = 'selected="selected"';
                }
            }

            echo '<div class="librow" id="'.$key.'">';
                echo '<div class="libItem" id="row'.$key.'" style="padding:3px 0;">';
                    echo '<label>Library</label><input type="text" value="'.$var.'" class="jslib" id="jslib'.$key.'" name="data[_jsLib]['.$key.']" style="width: 450px;" />';
                echo '</div>';
                echo '<div class="libItem liblocation" id="row'.$key.'" style="padding:3px 0;">';
                    echo '<label>Location</label> <select id="header_radio_'.$key.'" name="data[_jsLibLoc]['.$key.']">';
                    echo '<option value="1" '.$head.'>Header</option>';
                    echo '<option value="2" '.$foot.'>Footer</option>';
                    echo '</select></span>';
                echo '&nbsp;<a class="confirm cbutton cbutton-sml" href="#" onclick="jQuery(\'#'.$key.'\').remove();"><i class="icon-remove"></i></a></div>';
                echo '<p class="description">Asset slug, Wordpress script handle or URL</p>';
            echo '</div>';
        }
    }
?>
</div>
<div id="csslibraryPane">
<?php
//vardump($Element);
    if(!empty($Element['_cssLib'])){
        foreach($Element['_cssLib'] as $key=>$var){
            echo '<div id="'.$key.'" style="padding:3px 0;">';
            echo 'CSS URL: <input type="text" value="'.$var.'" id="name" name="data[_cssLib]['.$key.']" style="width: 389px;" />';
            echo ' <a class="confirm cbutton cbutton-sml" href="#" onclick="jQuery(\'#'.$key.'\').remove();"><i class="icon-remove"></i></a><p class="description">Asset slug, URL</p></div>';
        }
    }
    
    
    $syslibs = array('scriptaculous-root','scriptaculous-builder','scriptaculous-dragdrop','scriptaculous-effects','scriptaculous-slider','scriptaculous-sound','scriptaculous-controls','scriptaculous','swfobject','swfupload','swfupload-degrade','swfupload-queue','swfupload-handlers','jquery','jquery-form','jquery-color','jquery-ui-core','jquery-ui-widget','jquery-ui-mouse','jquery-ui-accordion','jquery-ui-autocomplete','jquery-ui-slider','jquery-ui-tabs','jquery-ui-sortable','jquery-ui-draggable','jquery-ui-droppable','jquery-ui-selectable','jquery-ui-datepicker','jquery-ui-resizable','jquery-ui-dialog','jquery-ui-button','schedule','suggest','thickbox','jquery-hotkeys','sack','quicktags','farbtastic','colorpicker','tiny_mce','prototype','autosave','common','editor','editor-functions','ajaxcat','password-strength-meter','xfn','upload','postbox','slug','post','page','link','comment','comment-repy','media-upload','word-count','theme-preview');
    
    $syslibsReadable = array();
    foreach($syslibs as $lib){
        $syslibsReadable[] = '"'.str_replace(' Ui ', ' UI ', ucwords(str_replace('-', ' ', $lib))).'"';
    }
    
?>
</div>


<script type="text/javascript">
    
    
    <?php
    echo "var syslibs = new Array(".implode(',', $syslibsReadable).");\n";
    ?>
    jQuery(document).ready(function(){
        var newlibs = new Array();
        jQuery('.assetlabel').each(function(){
            newlibs[newlibs.length] = this.value;
        })
        var alllibs = syslibs.concat(newlibs);
        jQuery('.jslib').typeahead({source: alllibs, items: 15});

        jQuery('#tabid7').click(function(){
            jQuery('#editorPane .tabs a').removeClass('active');
            jQuery(this).addClass('active');
            jQuery('#editorPane .area article').hide();
            jQuery(jQuery(this).attr('href')).show();
        });
        jQuery('.assetlabel').live('change', function(){
            var newlibs = new Array();
            jQuery('.assetlabel').each(function(){
                newlibs[newlibs.length] = this.value;
            })
            alllibs = syslibs.concat(newlibs);
            //jQuery('.jslib').unbind('keypress');
            //jQuery('.jslib').typeahead({source: alllibs, items: 15});
        })
    })
    function msc_addJSLibrary(){

        var rowID = randomUUID();
        jQuery('#jslibraryPane').append('<div id="'+rowID+'" class="librow"><div style="padding:3px 0;" id="row'+rowID+'" class="libItem"><label>Library</label><input type="text" style="width: 450px;" name="data[_jsLib]['+rowID+']" id="jslib'+rowID+'" class="jslib" value=""></div><div style="padding:3px 0;" id="row'+rowID+'" class="libItem liblocation"><label>Location</label> <select name="data[_jsLibLoc]['+rowID+']" id="header_radio_'+rowID+'"><option selected="selected" value="1">Header</option><option value="2">Footer</option></select>&nbsp;<a onclick="jQuery(\'#'+rowID+'\').remove();" href="#" class="confirm cbutton cbutton-sml"><i class="icon-remove"></i></a></div><p class="description">Asset slug, Wordpress script handle or URL</p></div>');
        var newlibs = new Array();
        jQuery('.assetlabel').each(function(){
            newlibs[newlibs.length] = this.value;
        })
        alllibs = syslibs.concat(newlibs);
        
        jQuery('.jslib').typeahead({source: alllibs, items: 15});

    }
    function msc_addCSSLibrary(){

        var rowID = randomUUID();
        jQuery('#csslibraryPane').append('\
            <div id="'+rowID+'" class="librow" style="padding:3px 0;">\n\
                CSS URL: <input type="text" value="" id="name" name="data[_cssLib]['+rowID+']" style="width: 389px;" /> \n\
                <a onclick="jQuery(\'#'+rowID+'\').remove();" href="#" class="confirm cbutton cbutton-sml"><i class="icon-remove"></i></a><p class="description">Asset slug, URL</p></div>')

    }


</script>