if (window.ETBuilderBackend && window.ETBuilderBackend.defaults) {
    window.ETBuilderBackend.defaults.et_pb_ds_before_after_slider = {
        before_image: window.DsBeforeAfterSliderBuilderData.defaults.image,
        after_image: window.DsBeforeAfterSliderBuilderData.defaults.image
    };
}

jQuery(function($) {
    $.fn.ds_before_after_slider = function() {
        const container = $(this); //div.ds_before_after_slider_container

        const options = $.extend({
            default_offset_pct: 0.5,
            orientation: 'horizontal',
            before_label: false,
            after_label: false,
            move_on_hover: false,
            move_with_handle_only: false,
            click_to_move: true
        }, container.data("options"));


        var sliderPct = options.offset / 100;
        var beforeDirection = (options.direction === 'vertical') ? 'down' : 'left';
        var afterDirection = (options.direction === 'vertical') ? 'up' : 'right';

        //Create a replaceable wrapper so we don't need to touch the actual module DOM
        const innerWrapper = $(`<div class="ds_before_after_slider_wrapper ds_before_after_slider_${options.direction}"></div>`)

        //Add images to wrapper
        const beforeImage = $(`<img src="${options.before_image}" alt="${options.before_image_alt}" class="ds_before_after_slider_before"/>`);
        innerWrapper.append(beforeImage);

        const afterImage = $(`<img src="${options.after_image}" alt="${options.after_image_alt}" class="ds_before_after_slider_after"/>`);
        innerWrapper.append(afterImage);

        beforeImage.on("load", function() {
            adjustSlider(sliderPct);
        });

        //Add overlay to wrapper
        const overlay = $("<div class='ds_before_after_slider_overlay'></div>");
        const beforeLabel = $(`<div class='ds_before_after_slider_before_label ds_before_after_slider_label' data-content="${options.before_label}"></div>`);
        const afterLabel = $(`<div class='ds_before_after_slider_after_label ds_before_after_slider_label' data-content="${options.after_label}"></div>`);
        overlay.append(beforeLabel);
        overlay.append(afterLabel);
        innerWrapper.append(overlay);

        //Add handle
        const slider = $("<div class='ds_before_after_slider_handle'></div>");
        slider.append(`<span class="ds_before_after_slider_${beforeDirection}_arrow"></span>`);
        slider.append(`<span class="ds_before_after_slider_${afterDirection}_arrow"></span>`);
        innerWrapper.append(slider);

        //Replace container html with newly created inner wrapper
        container.html(innerWrapper);

        //Calculate the horizontal/vertical offset and total height, based on the before image and the percentage position of the slider
        var calcOffset = function(dimensionPct) {
            let width = Math.ceil(beforeImage.width());
            let height = Math.ceil(beforeImage.height());
            return {
                mh: Math.floor(height),
                w: width + "px",
                h: height + "px",
                cw: Math.ceil(dimensionPct * width) + "px",
                ch: Math.ceil(dimensionPct * height) + "px"
            };
        };

        //Apply the image offset to both images and the total height to the slider
        function adjustInnerWrapper(offset) {
            if (options.direction === 'vertical') {
                beforeImage.css("clip", `rect(0, ${offset.w}, ${offset.ch}, 0)`);
                afterImage.css("clip", `rect(${offset.ch}, ${offset.w}, ${offset.h}, 0)`);

                beforeLabel.css("clip", `rect(0, ${offset.w}, ${offset.ch}, 0)`);
                afterLabel.css("clip", `rect(${offset.ch}, ${offset.w}, ${offset.h}, 0)`);
            } else {
                beforeImage.css("clip", `rect(0, ${offset.cw}, ${offset.h}, 0)`);
                afterImage.css("clip", `rect(0, ${offset.w}, ${offset.h}, ${offset.cw})`);

                beforeLabel.css("clip", `rect(0, ${offset.cw}, ${offset.h}, 0)`);
                afterLabel.css("clip", `rect(0, ${offset.w}, ${offset.h}, ${offset.cw})`);
            }

            innerWrapper.css("height", offset.h);
        };

        function adjustSlider(pct) {
            const offset = calcOffset(pct);

            if (options.direction === "vertical") {
                slider.css("top", offset.ch);
            } else {
                slider.css("left", offset.cw);
            }

            adjustInnerWrapper(offset);
        };

        // Return the number specified or the min/max number if its outside the range given.
        var minMaxNumber = function(num, min, max) {
            return Math.max(min, Math.min(max, num));
        };

        // Calculate the slider percentage based on the position.
        var getSliderPercentage = function(positionX, positionY) {
            var sliderPercentage = (options.direction === 'vertical') ?
                (positionY - offsetY) / imgHeight :
                (positionX - offsetX) / imgWidth;

            return minMaxNumber(sliderPercentage, 0, 1);
        };

        var offsetX = 0;
        var offsetY = 0;
        var imgWidth = 0;
        var imgHeight = 0;
        var onMoveStart = function(e) {
            if (((e.distX > e.distY && e.distX < -e.distY) || (e.distX < e.distY && e.distX > -e.distY)) && options.direction !== 'vertical') {
                e.preventDefault();
            } else if (((e.distX < e.distY && e.distX < -e.distY) || (e.distX > e.distY && e.distX > -e.distY)) && options.direction === 'vertical') {
                e.preventDefault();
            }
            container.addClass("active");
            offsetX = container.offset().left;
            offsetY = container.offset().top;
            imgWidth = beforeImage.width();
            imgHeight = beforeImage.height();
        };
        var onMove = function(e) {
            if (container.hasClass("active")) {
                sliderPct = getSliderPercentage(e.pageX, e.pageY);
                adjustSlider(sliderPct);
            }
        };
        var onMoveEnd = function() {
            container.removeClass("active");
        };

        var moveTarget = options.move_with_handle_only ? slider : container;
        moveTarget.on("movestart", onMoveStart);
        moveTarget.on("move", onMove);
        moveTarget.on("moveend", onMoveEnd);

        if (options.move_on_hover) {
            container.on("mouseenter", onMoveStart);
            container.on("mousemove", onMove);
            container.on("mouseleave", onMoveEnd);
        }

        slider.on("touchmove", function(e) {
            e.preventDefault();
        });

        container.find("img").on("mousedown", function(event) {
            event.preventDefault();
        });

        if (options.click_to_move) {
            container.on('click', function(e) {
                offsetX = container.offset().left;
                offsetY = container.offset().top;
                imgWidth = beforeImage.width();
                imgHeight = beforeImage.height();

                sliderPct = getSliderPercentage(e.pageX, e.pageY);
                adjustSlider(sliderPct);
            });
        }

        //Adjust slider for the first time
        adjustSlider(sliderPct);

        $(window).on("resize", function() {
            adjustSlider(sliderPct);
        });
    };

    $('.et_pb_ds_before_after_slider').each(function() {
        $(this).find(".ds_before_after_slider_container").ds_before_after_slider();
    });

});