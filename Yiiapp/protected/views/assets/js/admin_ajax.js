function calendar_ajax(link){
    $(function() {
        var xhr;
        var fn = function(){
            $( "#datepicker" ).datepicker({
                dateFormat: "yy-mm-dd",
                monthNames: ["Январь","Февраль","Март","Апрель","Мой","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],

                dayNamesMin: ["Вс","Пн","Вт","Ср","Чт","Пн","Сб"],
                onSelect: function(dateText) {
                   $('#loading').fadeIn(500);
                    if(xhr && xhr.readyState != 4){
                        xhr.abort();
                    }
                    xhr = $.ajax({
                        url: ''+link+''+dateText+'',
                        success: function(data) {
                            $('#ajax_request').html(data);
                            $('#loading').fadeOut(200);
                        }
                    });
                }
            });
        }
        var interval = setInterval(fn, 500);
    });
}