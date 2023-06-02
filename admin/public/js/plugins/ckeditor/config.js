/**
 * @license Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.filebrowserBrowseUrl = 'public/js/plugins/ckfinder/ckfinder.html';

	config.filebrowserImageBrowseUrl = 'public/js/plugins/ckfinder/ckfinder.html?type=Images';

	config.filebrowserFlashBrowseUrl = 'public/js/plugins/ckfinder/ckfinder.html?type=Flash';

	config.filebrowserUploadUrl = 'public/js/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';

	config.filebrowserImageUploadUrl = 'public/js/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';

	config.filebrowserFlashUploadUrl = 'public/js/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
