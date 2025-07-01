/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'ru';
	config.uiColor = '#0099ff';
    config.width = 635;
    config.height = 200;
    config.resize_maxWidth = 635;
    config.resize_minWidth = 500;
    config.resize_maxHeight = 600;
    config.resize_minHeight = 200;
    config.toolbarGroups = [
    { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
    { name: 'insert' },
    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
    { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
    { name: 'forms' },
    { name: 'links' },
    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ] },
    { name: 'tools' },  
    { name: 'others' },
    { name: 'styles' },
    { name: 'colors' },
    { name: 'about' }];
    config.extraPlugins = 'autogrow,insertpre,spoiler,tableresize,xml';
    // config.insertpre_class = 'prettyprint';
    // config.insertpre_style = 'background-color:#F8F8F8;border:1px solid #DDD;padding:10px;';
    config.skin = 'moonocolor';
    config.filebrowserBrowseUrl = 'http://rolar/js/kcfinder/browse.php?type=files';
    config.filebrowserImageBrowseUrl = 'http://rolar/js/kcfinder/browse.php?type=images';
    config.filebrowserFlashBrowseUrl = 'http://rolar/js/kcfinder/browse.php?type=flash';
    config.filebrowserUploadUrl = 'http://rolar/js/kcfinder/upload.php?type=files';
    config.filebrowserImageUploadUrl = 'http://rolar/js/kcfinder/upload.php?type=images';
    config.filebrowserFlashUploadUrl = 'http://rolar/js/kcfinder/upload.php?type=flash';
};