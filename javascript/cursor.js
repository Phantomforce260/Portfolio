var pointer = document.querySelector('.pointer');

var panner = document.querySelector('.panner');

window.limit_x = () => window.innerWidth - pointer.offsetWidth;

/**
 * @function getOffset
 * Gets the absolute position of an element on the page.
 *
 * @param {HTMLElement} el
 * The element to get the offset of.
 *
 * @returns {Object}
 * An object with two properties: left and top. The left property is the
 * absolute left position of the element on the page in pixels. The top
 * property is the absolute top position of the element on the page in
 * pixels.
 */
function getOffset(el) {
    el = el.getBoundingClientRect();
    return {
        left: el.left + window.scrollX,
        top: el.top + window.scrollY
    }
}

window.isLeftOutOfScreen = () => getOffset(panner).left > window.innerWidth;
window.isRightOutOfScreen = () => getOffset(panner).left < 0;

window.addEventListener('mousemove', function(e) {
    var x = e.clientX + 'px';
    var y = e.clientY + 'px';
    var target = e.target;

    TweenLite.to(pointer, 0.5, { ease: Back.easeOut.config(1.7), left: x, top: y});

    if (target.localName != 'html') {
        if (target.localName == 'a' || target.dataset.cursor == 'false' || target.parentNode.dataset.cursor == 'false') {
            TweenLite.to(pointer, 1, { ease: Power4.easeOut, scale: 0.5 });
        }
        else {
            TweenLite.to(pointer, 1, { ease: Power4.easeOut, scale: 1 });
        }
    }
});

const cursorColors = ['#FA7FFF', '#8DA0FE', '#14F2E0', '#A818D4', '#9A75F0', '#FFFFFF' ];
let colorIndex = 0;

function changeCursorColor() {
    let pointerStyle = pointer.style.cssText;

    pointer.style.cssText = pointerStyle.includes("--mouse-color:") 
        ? pointerStyle.substring(0, 15) + cursorColors[colorIndex] + pointerStyle.substring(15 + cursorColors[colorIndex].length)
        : `--mouse-color: ${cursorColors[colorIndex]}; ${pointerStyle}`;

    colorIndex = (colorIndex + 1) % cursorColors.length;
}

/* --------------------------------------------------------------------------------------------- */

window.addEventListener('resize', function() {
    setTimeout(function() {
        if (isRightOutOfScreen()) {
            TweenLite.to(panner, 1, { ease: Back.easeOut.config(1.7), left: 0 });
        }

        if (isLeftOutOfScreen()) {
            TweenLite.to(panner, 1, { ease: Back.easeOut.config(1.7), left: limit_x() });
        }
    }, 1000);
});
