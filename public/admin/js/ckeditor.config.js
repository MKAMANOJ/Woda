CKEDITOR.editorConfig = function(config) {
  config.filebrowserBrowseUrl = '/admin/metronic/global/plugins/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';
  config.filebrowserFlashBrowseUrl = '/admin/metronic/global/plugins/ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash';
  config.filebrowserImageBrowseUrl = '/admin/metronic/global/plugins/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';
  config.filebrowserUploadUrl = '/admin/metronic/global/plugins/ckeditor/kcfinder/upload.php?opener=ckeditor&type=files';
  config.filebrowserImageUploadUrl = '/admin/metronic/global/plugins/ckeditor/kcfinder/upload.php?opener=ckeditor&type=images';
  config.filebrowserFlashUploadUrl = '/admin/metronic/global/plugins/ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash';
  config.allowedContent = true;
  config.skin = 'bootstrapck';
};
