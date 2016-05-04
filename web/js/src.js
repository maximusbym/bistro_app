
$(document).ready(function() {
    
    
    $(document.body).on('click','.status-toggle', function(e) {

        var ajaxUrl = $(this).attr('href');

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: ajaxUrl,
            success: function(res) {
                $('tr[data-id='+res.id+'] td.grid-column-status').html(res.status);
            }
        });

        return false;
    });
    
    
});