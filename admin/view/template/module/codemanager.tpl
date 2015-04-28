<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
 <div class="page-header">
    <div class="container-fluid">
      <h1><i class="fa fa-file-code-o"></i>&nbsp;<?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
        
      </ul>
      <div style="float:right;margin-top:10px;">
         	<button type="submit" id="wantMore" class="btn btn-success btn-xs">More awesome features&nbsp;<i class="fa fa-question"></i></button>
         </div>
    </div>
 </div>
 <div class="container-fluid">
 	<?php if ($error_warning) { ?>
        <div class="alert alert-danger autoSlideUp"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
         <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php } ?>
    <?php if ($success) { ?>
        <div class="alert alert-success autoSlideUp"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <script>$('.autoSlideUp').delay(3000).fadeOut(600, function(){ $(this).show().css({'visibility':'hidden'}); }).slideUp(600);</script>
    <?php } ?>
    <a class="BigScreen" id="bigscreen" onClick="bigscreen();"><span class="glyphicon glyphicon-sound-stereo"></span></a>
    <a class="BackToNormalScreen" id="backtonormalscreen" onClick="normalscreen();"><span class="glyphicon glyphicon-fullscreen"></span></a>
    <a class="NormalScreen" id="normalscreen" onClick="normalscreen();"><span class="glyphicon glyphicon-fullscreen"></span></a>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list"></i>&nbsp;<span style="vertical-align:middle;font-weight:bold;">Code Editor</span></h3>
            <div class="storeSwitcherWidget">
            	<div class="form-group">
                	<?php if ($buttons) { ?>
                	<button type="submit" id="showModal" class="btn btn-info btn-sm save-changes" data-toggle="modal" data-target="#myModal"><i class="fa fa-key"></i>&nbsp;&nbsp;<?php echo $save_changes?></button>
                    <button type="submit" id="showUsers" class="btn btn-default btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;View all users with access</button>
                    <?php } ?>
            	</div>
            </div>
        </div>
        <div class="panel-body" style="padding: 0px;">
            <?php
            if (!function_exists('modification_vqmod')) {
                function modification_vqmod($file) {
                    if (class_exists('VQMod')) {
                        return VQMod::modCheck(modification($file), $file);
                    } else {
                        return modification($file);
                    }
                }
            }
            ?>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form"> 
                <input type="hidden" name="store_id" value="<?php echo $store['store_id']; ?>" />
				<?php require_once modification_vqmod((DIR_APPLICATION.'view/template/module/'.$moduleNameSmall.'/tab_editor.php')); ?>
            </form>
        </div> 
    </div>
 </div>
</div>

<div class="modal fade" id="modalMore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel"><img src="view/image/imodules.png" style="margin-top: -5px; padding-right: 5px;" />Introducing <strong>CodeManager Pro</strong>!</h3>
      </div>
      <div class="modal-body">
            <div id="dataMore">For even more awesome features, upgrade to <strong>CodeManager Pro</strong>. Here are some of the benefits:</div>
                <br />
                <ul style="list-style-type: none;margin-left: -20px;">
                    <li><i class="fa fa-star"></i>&nbsp;&nbsp;View last modified files</li>
                    <li><i class="fa fa-star"></i></span>&nbsp;&nbsp;Git support</li>
                    <li><i class="fa fa-star"></i></span>&nbsp;&nbsp;Color picker</li>
                    <li><i class="fa fa-star"></i></span>&nbsp;&nbsp;Compare files</li>
                    <li><i class="fa fa-star"></i></span>&nbsp;&nbsp;Terminal emulator</li>
                    <li><i class="fa fa-star"></i></span>&nbsp;&nbsp;TODO List</li>
                    <li><i class="fa fa-star"></i></span>&nbsp;&nbsp;Premium support</li>
                </ul>
			</div>
      <div class="modal-footer" style="margin-top:0px;">
		<a href="https://isenselabs.com/products/view/codemanager-pro-full-featured-ide-framework-for-opencart" style="color: #ffffff !important;" target="_blank" type="button" class="btn btn-primary">Get it now</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
function exitOfFullScreen(el) {
	var requestMethod = el.cancelFullScreen||el.webkitCancelFullScreen||el.mozCancelFullScreen||el.exitFullscreen;
	if (requestMethod) { // cancel full screen.
		requestMethod.call(el);
	} else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
		var wscript = new ActiveXObject("WScript.Shell");
		if (wscript !== null) {
			wscript.SendKeys("{F11}");
		}
	}
}
function requestFullScreen(el) {
	// Supports most browsers and their versions.
	var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullScreen;
	if (requestMethod) { // Native full screen.
		requestMethod.call(el);
	} else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
		var wscript = new ActiveXObject("WScript.Shell");
		if (wscript !== null) {
			wscript.SendKeys("{F11}");
		}
	}
	return false
}
function toggleFull() {
	var elem = document.body; // Make the body go full screen.
	var isInFullScreen = (document.fullScreenElement && document.fullScreenElement !== null) ||  (document.mozFullScreen || document.webkitIsFullScreen);

	if (isInFullScreen) {
		$('#iFrame').addClass("FullScreen");
		requestFullScreen(document.body);
	} else {
		//$('#backtonormalscreen').hide();
		//$('#bigscreen').hide();
		exitOfFullScreen(document);
	}
	return false;
}
function fullscreen() {
	$('#iFrame').addClass("FullScreen");
	$('#bigscreen').show();
	$('#backtonormalscreen').show();
}
function normalscreen() {
	if ($('#iFrame').hasClass("BigFullScreen")) {
		exitOfFullScreen(document);
		$('#bigscreen').show();
		$('#backtonormalscreen').show();
		$('#iFrame').addClass("FullScreen");
		$('#iFrame').removeClass("BigFullScreen");
	} else {
		$('#normalscreen').hide();
		$('#backtonormalscreen').hide();
		$('#bigscreen').hide();
		$('#iFrame').removeClass("FullScreen");
	}
}
function bigscreen() {
	if ($('#iFrame').hasClass("BigFullScreen")) {
		exitOfFullScreen(document);
		$('#iFrame').removeClass("BigFullScreen");
		$('#iFrame').removeClass("FullScreen");
		$('#backtonormalscreen').hide();
		$('#bigscreen').hide();
	} else {
		requestFullScreen(document.body);
		$('#bigscreen').show();
		$('#backtonormalscreen').show();
		$('#iFrame').addClass("BigFullScreen");
		
	}

}
document.addEventListener("fullscreenchange", toggleFull, false);
document.addEventListener("webkitfullscreenchange", toggleFull, false);
document.addEventListener("mozfullscreenchange", toggleFull, false);

$('#wantMore').on('click', function(e){
	$('#modalMore').modal('show');
});
</script>
<?php echo $footer; ?>