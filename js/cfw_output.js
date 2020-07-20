(function ($, Drupal) {
    'use strict';
    
    $("#get-raw-text").bind("click", function(e) {
        e.preventDefault();
        var complete_text = $('.scenario-full-text').text().trim().replace(/<br\s*[\/]?>/gi, "").replace(/\s\s\s+/g, "\n\n"); //.replace(/\s\s+/g, "\n");
        
        download('output.txt', complete_text);
       
    });
    
    function download(filename, text) {
        var element = document.createElement('a');
        element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
        element.setAttribute('download', filename);
        element.style.display = 'none';
        document.body.appendChild(element);
        element.click();
        document.body.removeChild(element);
    }

})(jQuery, Drupal);
 
