$(function() {
    // init zeynepjs side menu
    var zeynep = $('.zeynep').zeynep({
        opened: function () {
            // log

        },
        closed: function () {
            // log

        }
    })

    // dynamically bind 'closing' event
    zeynep.on('closing', function () {
        // log

    })

    // handle zeynepjs overlay click
    $('.zeynep-overlay').on('click', function () {
        zeynep.close()
    })

    $('.close-zeynep').on('click', function () {
        zeynep.close()
    })

    // open zeynepjs side menu
    $('.btn-open').on('click', function () {
        zeynep.open()
    })
})
