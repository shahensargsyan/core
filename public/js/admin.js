$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.chosen-select').chosen();

    /* Start Slider */
    $(document).on('click', '.delete_slider_image', function() {
        var parent = $(this).parent().parent();
        var id = $(this).parent().attr('id');
        if(confirm('Are you sure?')) {
            $.ajax({
                type: "POST",
                url: '/slider/delete/'+id,
                cache: false,
                dataType: 'json',
                success: function (data) {
                    if(data == 1)
                        parent.remove();
                    else
                        alert('Please try again.');
                }
            });
        }
    });
    /* End Slider */
    
    
    $(document).on('click', '.delete_new', function() {
        var id = $(this).parent().attr('id');
        var parent = $(this).parent().parent();
        var target = $(this).attr('rel');
        if(confirm('Are you sure?')) {
            $.ajax({
                type: "POST",
                url: '/' + target + '/delete/' + id,
                cache: false,
                dataType: 'json',
                success: function (data) {
                    if(data == 1)
                        parent.remove();
                    else
                        alert('Please try again.');
                }
            });
        }
    });
});

