/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	 config.language = 'pt';
	 config.toolbar =
		 [
		  	['Maximize', 'Source'],
		  	['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript','-','RemoveFormat' ],
		  	['NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ],
		  	['Link', 'Unlink', 'Anchor', 'Image']
		 ];
	config.enterMode = CKEDITOR.ENTER_BR;
	// config.uiColor = '#AADC6E';
};
