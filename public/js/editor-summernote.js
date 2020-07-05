
(function(window, document, $) {
  'use strict';

  // Basic Summernote
  $('.summernote').summernote();

  $('.summernote-code').summernote({
    height: 250,   //set editable area's height
    codemirror: { // codemirror options
      theme: 'monokai'
    }
  });
})(window, document, jQuery);