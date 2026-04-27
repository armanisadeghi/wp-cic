jQuery(document).ready(function($) {
    $('#main-header .mobile_menu_bar, .et-l--header .mobile_menu_bar').click(function() {
        $("#main-header .et_mobile_menu li ul").removeClass('dipi-collapse-opened');
        $("#main-header .et_mobile_menu li ul").addClass('dipi-collapse-closed');
        $("#main-header .et_mobile_menu li ul").prev("a").removeClass('dipi-collapse-menu')
        $(".et-l--header .et_mobile_menu li ul").removeClass('dipi-collapse-opened');
        $(".et-l--header .et_mobile_menu li ul").addClass('dipi-collapse-closed');
        $(".et-l--header .et_mobile_menu li ul").prev("a").removeClass('dipi-collapse-menu')
    });
    $("#main-header .et_mobile_menu li ul").prev("a").off('click').on('click', function(e) {
        $('#main-header .et_mobile_menu').attr('style', "display: block !important");
        handle_event(e, $(this))
    });
    $(window).on('load', function(){
        $(".et-l--header .et_mobile_menu li ul").prev("a").off('click').on('click', function(e) {
            $('.et-l--header .et_mobile_menu').attr('style', "display: block !important");
            handle_event(e, $(this))
        });
    });
    function handle_event(e, $el){
        var rect = e.target.getBoundingClientRect();
        var x = e.clientX - rect.left;
        //FIXME: Magic number. We toggle the menu if the click is within 50px from the left (where the toggle button should be).
        //This should be dynamically calculated based on the actual position of the button (or rather the before/after elements)
        if(x > rect.width - 50 || ''){
            e.preventDefault();
            animate_submenu($el);
        }
    }
    /*
    function animate_submenu($el){
        if(window.dipi_submenu_animate) return;
        $el.toggleClass('dipi-collapse-menu');
        $submenu = $el.next('ul')
        window.dipi_submenu_animate = false;
        if($submenu.hasClass('dipi-collapse-closed')){
            window.dipi_submenu_animate = true;
            $submenu.removeClass('dipi-collapse-closed').addClass('dipi-collapse-animating');
            setTimeout(() => {
                $submenu.addClass('dipi-collapse-opened');
            }, 0);
            setTimeout(() => {
                $submenu.stop().removeClass('dipi-collapse-animating');
                window.dipi_submenu_animate = false;
            }, 800);
        } else {
            window.dipi_submenu_animate = true;
            $submenu.removeClass('dipi-collapse-opened').addClass('dipi-collapse-animating');
            setTimeout(() => {
                $submenu.addClass('dipi-collapse-closed');
            }, 0);
            setTimeout(() => {
                $submenu.stop().removeClass('dipi-collapse-animating');
                window.dipi_submenu_animate = false;
            }, 800);
        }
    }
    */
    function animate_submenu($el) {
        if (window.dipi_submenu_animate) return;
    
        const $submenu = $el.next('ul');
    
        // Close sibling submenus of this menu level
        const $siblings = $el.parent().siblings('li').children('ul.dipi-collapse-opened');
        $siblings.each(function () {
            const $other = $(this);
            collapse_submenu($other);
            $other.prev('a').removeClass('dipi-collapse-menu');
        });
    
        // Toggle this menu
        $el.toggleClass('dipi-collapse-menu');
        window.dipi_submenu_animate = true;
    
        if ($submenu.hasClass('dipi-collapse-closed')) {
            // OPEN submenu
            $submenu.removeClass('dipi-collapse-closed').addClass('dipi-collapse-animating');
            setTimeout(() => {
                $submenu.addClass('dipi-collapse-opened');
            }, 400);
        } else {
            // CLOSE submenu and all nested open children
            collapse_submenu($submenu);
            $el.removeClass('dipi-collapse-menu');
        }
    
        setTimeout(() => {
            $submenu.removeClass('dipi-collapse-animating');
            window.dipi_submenu_animate = false;
        }, 400);
    }
    function collapse_submenu($submenu) {
        // Close the main submenu
        $submenu.removeClass('dipi-collapse-opened').addClass('dipi-collapse-animating');
        setTimeout(() => {
            $submenu.addClass('dipi-collapse-closed');
        }, 400);
        setTimeout(() => {
            $submenu.removeClass('dipi-collapse-animating');
        }, 400);
    
        // Remove active toggle class from the trigger <a>
        $submenu.prev('a').removeClass('dipi-collapse-menu');
    
        // Recursively close any open submenus inside it
        $submenu.find('ul.dipi-collapse-opened').each(function () {
            const $childSubmenu = $(this);
            collapse_submenu($childSubmenu);
        });
    }
});