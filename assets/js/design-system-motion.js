(function () {
    var ACTIVATION_KEYS = ['Enter', ' '];

    function applyPressState(element) {
        if (!element.classList.contains('is-pressed')) {
            element.classList.add('is-pressed');
        }
    }

    function clearPressState(element) {
        element.classList.remove('is-pressed');
    }

    function bindPressAnimations(element) {
        element.addEventListener('pointerdown', function () {
            applyPressState(element);
        });

        element.addEventListener('pointerup', function () {
            clearPressState(element);
        });

        element.addEventListener('pointerleave', function () {
            clearPressState(element);
        });

        element.addEventListener('blur', function () {
            clearPressState(element);
        });

        element.addEventListener('keydown', function (event) {
            if (ACTIVATION_KEYS.indexOf(event.key) > -1) {
                applyPressState(element);
            }
        });

        element.addEventListener('keyup', function (event) {
            if (ACTIVATION_KEYS.indexOf(event.key) > -1) {
                clearPressState(element);
            }
        });

        element.addEventListener('animationend', function (event) {
            if (event.animationName === 'ds-press') {
                clearPressState(element);
            }
        });
    }

    function bindHoverAnimations(card) {
        function setHover() {
            card.classList.add('is-hovered');
        }

        function clearHover() {
            card.classList.remove('is-hovered');
        }

        card.addEventListener('pointerenter', setHover);
        card.addEventListener('pointerleave', clearHover);
        card.addEventListener('focusin', setHover);
        card.addEventListener('focusout', clearHover);
    }

    function verifyMotionStates() {
        var lingeringPress = document.querySelector('.ds-button.is-pressed, .ds-badge-card.is-pressed');
        if (lingeringPress) {
            lingeringPress.classList.remove('is-pressed');
        }
    }

    function initMotion() {
        var pressables = document.querySelectorAll('.ds-button, .ds-badge-card');
        var hoverables = document.querySelectorAll('.ds-card, .ds-badge-card');

        pressables.forEach(bindPressAnimations);
        hoverables.forEach(bindHoverAnimations);

        document.addEventListener('visibilitychange', function () {
            if (!document.hidden) {
                verifyMotionStates();
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMotion);
    } else {
        initMotion();
    }
})();
