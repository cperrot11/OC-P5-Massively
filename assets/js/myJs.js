$(document).ready(function() {
    $('th').each(function(col) {
        $(this).hover(
            function() { $(this).addClass('focus'); },
            function() { $(this).removeClass('focus'); }
        );
        $(this).click(function() {
            if ($(this).is('.asc')) {
                $(this).removeClass('asc');
                $(this).addClass('desc selected');
                sortOrder = -1;
            }
            else {
                $(this).addClass('asc selected');
                $(this).removeClass('desc');
                sortOrder = 1;
            }
            $(this).siblings().removeClass('asc selected');
            $(this).siblings().removeClass('desc selected');
            var arrData = $('table').find('tbody >tr:has(td)').get();
            arrData.sort(function(a, b) {
                var val1 = $(a).children('td').eq(col).text().toUpperCase();
                var val2 = $(b).children('td').eq(col).text().toUpperCase();
                if($.isNumeric(val1) && $.isNumeric(val2))
                    return sortOrder == 1 ? val1-val2 : val2-val1;
                else
                    return (val1 < val2) ? -sortOrder : (val1 > val2) ? sortOrder : 0;
            });
            $.each(arrData, function(index, row) {
                $('tbody').append(row);
            });
        });
    });
    $('.cpClose').click(function () {
        $('.cpAlert').remove();
    })

    $('.cpAlert').effect( "shake", {times:4}, 1000 );


    $('.cpTremble').jrumble({
        x: 2,
        y: 2,
        rotation: 1,
        speed: 100
    });
    $('.cpTremble').hover(function(){
        $(this).trigger('startRumble');
    }, function(){
        $(this).trigger('stopRumble');
    });
    $('.validate').click(function () {
        swal({
            title: "Etes vous sur ?",
            text: "Après suppression, il sera impossible de revenir en arrière !",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var rowToDelete = $(this).parents('tr');
                    idToDelete = rowToDelete.children('td:first').text();
                    swal("La suppression a été réalisée", {
                        icon: "success"
                    });
                    window.location.href = $('#path').val()+idToDelete + ' &appel=back#begin';
                } else {
                    swal("Suppression annulée");
                }
            });
    })
});
