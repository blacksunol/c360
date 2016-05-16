/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	//config.skin='v2'; 
	config.enterMode = CKEDITOR.ENTER_BR;
	
config.filebrowserBrowseUrl = SCRIPTS_URL+'/ckfinder/ckfinder.html';
config.filebrowserImageBrowseUrl = SCRIPTS_URL+'/ckfinder/ckfinder.html?type=Images';
config.filebrowserFlashBrowseUrl = SCRIPTS_URL+'/ckfinder/ckfinder.html?type=Flash';
config.filebrowserUploadUrl = SCRIPTS_URL+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
config.filebrowserImageUploadUrl = SCRIPTS_URL+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
config.filebrowserFlashUploadUrl = SCRIPTS_URL+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
