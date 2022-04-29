
var offsideMenu2 = offside( '#menu-2', {

    slidingElementsSelector: '#container, #results',
    debug: true,
    buttonsSelector: '.menu-btn-2, .menu-btn-2--close',
    slidingSide: 'right',
    beforeOpen: function(){},
    beforeClose: function(){},
});

var overlay = document.querySelector('.site-overlay')
    .addEventListener( 'click', offside.factory.closeOpenOffside );
