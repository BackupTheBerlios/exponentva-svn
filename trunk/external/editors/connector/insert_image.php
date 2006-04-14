<?php
define("SCRIPT_EXP_RELATIVE","external/editors/connector/");
define("SCRIPT_FILENAME","content_linked.php");

include_once("../../../pathos.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Insert/Modify Image</title>
	
		<script type="text/javascript" src="popup.js"></script>
		<script type="text/javascript">
			// namespace for translations
			Pathos = new Object();
		</script>
		<script type="text/javascript" src="<?PHP echo PATH_RELATIVE . 'external/editors/connector/lang/' . LANG . '.js'?>"></script>
		<script type="text/javascript">
		/* <![CDATA[ */
			<?php echo 'window.relativePathos = "' . PATH_RELATIVE . "\"\n";?>
			
			I18N = Pathos.I18N;
			
			function i18n(str) {
			  return (I18N[str] || str);
			};
			
			function efm_pickedFile(file_id,file_path) {
				document.getElementById("f_url").value = file_path;
				window.onPreview();
			}
			
			function Init() {
				__dlg_translate(I18N);
				__dlg_init();
				var param = window.dialogArguments;
			
				if (param) {
					document.getElementById("f_url").value = param["f_url"];
					document.getElementById("f_alt").value = param["f_alt"];
					document.getElementById("f_border").value = param["f_border"];
					document.getElementById("f_align").value = param["f_align"];
					document.getElementById("f_vert").value = param["f_vert"];
					document.getElementById("f_horiz").value = param["f_horiz"];
			
					if (param.f_url.substr(0,7) == "http://") {
						window.ipreview.location.replace(param.f_url);
					}
					else {
						window.ipreview.location.replace(window.relativePathos+param.f_url);
					}
				}
			
				document.getElementById("f_url").focus();
			};
			
			
			function onOK() {
				var required = {"f_url": "You must enter the URL"  };
			
				for (var i in required) {
					var el = document.getElementById(i);
			
					if (!el.value) {
						alert(required[i]);
						el.focus();
						return false;
					}
				}  // pass data back to the calling window
			
				var fields = ["f_url", "f_alt", "f_align", "f_border","f_horiz", "f_vert"];
				var param = new Object();
			
				for (var i in fields) {
					var id = fields[i];
					var el = document.getElementById(id);
					param[id] = el.value;
				}
		
				// TinyMCE integration, indicates this comes from an image browser
			  	param["f_dialogType"] = "Image";
			
				__dlg_close(param);
				window.close();
				return false;
			};
			
			
			function onCancel() {
				__dlg_close(null);
				window.close();
				return false;
			};
			
			
			function onPreview() {
				var f_url = document.getElementById("f_url");
				var url = f_url.value;
			
				if (!url) {
					alert("You have to enter an URL first");
					f_url.focus();
					return false;
				};
			
				if (url.substr(0,7) == "http://") {
					window.ipreview.location.replace(url);
				} else {
					window.ipreview.location.replace(window.relativePathos+url);
				}
			
				return false;
			};
			
			function onBrowse() {
				window.open("../../../modules/filemanagermodule/actions/picker.php?id=0", "Browser");
				return false;
			
			//	window.open("../../../source_selector.php?showmodules=imagemanagermodule&dest=&vmod=imagemanagermodule&vview=_sourcePicker&hideOthers=1","palette","toolbar=no,title=no,width=640,height=480,scrollbars=yes");
			}
	/* ]]> */		
	</script>
	<style type="text/css">
	/* <![CDATA[ */
		html, body {
			background: ButtonFace;
			color: ButtonText;
			font: 11px
			Tahoma,Verdana,sans-serif;
			margin: 0px;
			padding: 0px;
		}
		body {
			padding: 5px;
		}
		table {
			font: 11px Tahoma,Verdana,sans-serif;
		}
		form p {
			margin-top: 5px;
			margin-bottom: 5px;
		}
		.fl {
			width: 9em;
			float: left;
			padding: 2px 5px;
			text-align: right;
		}
		.fr {
			width: 6em;
			float: left;
			padding: 2px 5px;
			text-align: right;
		}
		fieldset {
			padding: 0px 10px 5px 5px;
		}
		select, input, button {
			font: 11px Tahoma,Verdana,sans-serif;
		}
		button {
			width: 70px;
		}
		.space {
			padding: 2px;
		}
		.title {
			background: #ddf;
			color: #000;
			font-weight: bold;
			font-size: 120%;
			padding: 3px 10px;
			margin-bottom: 10px;
			border-bottom: 1px solid black;
			letter-spacing: 2px;
		}
		form {
			padding: 0px;
			margin: 0px;
		}
	/* ]]> */
	</style>
</head>
<body onload="Init()">
	<div class="title">Insert/Modify Image</div>
	<!--- new stuff --->
	<form action="" method="get">
		<table border="0" width="100%" style="padding: 0px; margin: 0px">
			<tbody>
				<tr>
					<td style="width: 7em; text-align: right">Image URL</td>
					
					<td>
						<input type="text" name="url" id="f_url" style="width:75%" title="Enter the image URL here" onchange="onPreview();" />
       					<button name="preview" onclick="return onBrowse();" title="Browse Uploaded Images and Select One">Browse</button>
      					<!-- Taken out to tie ImageManager in <button name="preview" onclick="return onPreview();"      title="Preview the image in a new window">Preview</button> -->
      				</td>
      			</tr>
      			<tr>
      				<td style="width: 7em; text-align: right">Alternate Text</td>
      				
      				<td>
      					<input type="text" name="alt" id="f_alt" style="width:100%" title="For browsers that don't support images"/>
      				</td>
      			</tr>
      		</tbody>
      	</table>
      	<p/>
      	<fieldset style="float: left; margin-left: 5px;">
      		<legend>Layout</legend>
      		
      		<div class="space"/>
      		
      		<div class="fl">Alignment</div>
      		<select size="1" name="align" id="f_align"  title="Positioning of this image">
      			<option value="">Not Set</option>
      			<option value="left">Left</option>
      			<option value="right">Right</option>
      			<option value="texttop">Texttop</option>
      			<option value="absmiddle">Absmiddle</option>
      			<option value="baseline" selected="1">Baseline</option>
      			<option value="absbottom">Absbottom</option>
      			<option value="bottom">Bottom</option>
      			<option value="middle">Middle</option>
      			<option value="top">Top</option>
      		</select>
      		
      		<p/>
      		
      		<div class="fl">Border Thickness</div>
      		<input type="text" name="border" id="f_border" size="5" title="Leave empty for no border"/>
      		
      		<div class="space"/>
      	</fieldset>
      	<fieldset style="float:right; margin-right: 5px;">
      		<legend>Spacing</legend>
      		
      		<div class="space"/>
      		
      		<div class="fr">Horizontal</div>
      		<input type="text" name="horiz" id="f_horiz" size="5" title="Horizontal padding"/>
      		
      		<p/>
      		
      		<div class="fr">Vertical</div>
      		<input type="text" name="vert" id="f_vert" size="5" title="Vertical padding"/>
      		
      		<div class="space"/>
      		
      	</fieldset>
      	
      	<br clear="all"/>
      	
      	<table width="100%" style="margin-bottom: 0.2em">
      		<tr>
      			<td valign="bottom">
      				<span>Image Preview</span><br/>
      				<iframe name="ipreview" id="ipreview" frameborder="0" style="border : 1px solid gray;" height="200" width="300" src=""></iframe>
      			</td>
      			<td valign="bottom" style="text-align: right">
      				<button type="button" name="ok" onclick="return onOK();">OK</button><br/>
      				<button type="button" name="cancel" onclick="return onCancel();">Cancel</button>
      			</td>
      		</tr>
      	</table>
	</form>
</body>
</html>