
$(document).ready(function() {

    BonusCardModule.init({ajax:$.ajax});
    var bonusCardModule = BonusCardModule;

    $(document.body).on('click','.status-toggle', function(e) {
        e.preventDefault();

        var ajaxUrl = $(this).attr('href');
        bonusCardModule.toggleStatus(ajaxUrl, function(res) {
            BonusCardModule.updateRowStatus(res, $(document));
        });
    });

});



var BonusCardModule = (function() {
    "use strict";

    var Module = {

        init: function(options) {
            this.ajax = options.ajax || $.ajax;
        },

        toggleStatus: function(ajaxUrl, callback) {
            this.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: ajaxUrl,
                success: function(res) {
                    callback(res);
                }
            });
        },

        updateRowStatus: function(data, doc) {
            $('tr[data-id='+data.id+'] td.grid-column-status', doc).html(data.status);
        }
    };


    return Module;
}());

