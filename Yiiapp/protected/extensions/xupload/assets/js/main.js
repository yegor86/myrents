/*
 * jQuery File Upload Plugin JS Example 6.7
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*jslint nomen: true, unparam: true, regexp: true */
/*global $, window, document */

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#XUploadForm-form').fileupload();

    // Enable iframe cross-domain access via redirect option:
    $('#XUploadForm-form').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );


        // Load existing files:
        $('#XUploadForm-form').each(function () {
            var that = this;
            $('#ploader').css({'display':'inline'});
            $.getJSON(this.action, function (result) {
                if (result && result.length) {
                    $(that).fileupload('option', 'done').call(that, null, {result: result});    
                }
                $('#ploader').css({'display':'none'});
                
            });
        });


});
