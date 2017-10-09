$(document).ready(function () {
    var $btMenuMobile = $('.bt-menu-mobile');
    var $btCloseMenuMobile = $('.menu-mobile__btn-close');
    var $menuMobile = $('#menu-mobile .menu-mobile');

    function openMenuMobile() {
        $menuMobile.addClass('--open');
    }
    function closeMenuMobile() {
        $menuMobile.removeClass('--open');
    }
    
    $btMenuMobile.click(openMenuMobile);
    $btCloseMenuMobile.click(closeMenuMobile);

});

