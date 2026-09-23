(function () {
    'use strict';

    const popup = document.getElementById('ta-special-popup');
    if (!popup) return;

    const dialog = popup.querySelector('.ta-special-popup__dialog');
    const closeButton = popup.querySelector('.ta-special-popup__close');
    const storageKey = 'ta_angola_christmas_2026_seen';
    let previousFocus = null;

    function hasSeenPopup() {
        try {
            return window.sessionStorage.getItem(storageKey) === '1';
        } catch (error) {
            return false;
        }
    }

    function rememberPopup() {
        try {
            window.sessionStorage.setItem(storageKey, '1');
        } catch (error) {
            // The popup remains usable when session storage is unavailable.
        }
    }

    function openPopup() {
        if (hasSeenPopup()) return;
        previousFocus = document.activeElement;
        popup.hidden = false;
        document.body.classList.add('ta-special-popup-open');
        window.requestAnimationFrame(() => closeButton.focus());
    }

    function closePopup() {
        rememberPopup();
        popup.hidden = true;
        document.body.classList.remove('ta-special-popup-open');
        if (previousFocus && typeof previousFocus.focus === 'function') previousFocus.focus();
    }

    closeButton.addEventListener('click', closePopup);
    popup.addEventListener('click', (event) => {
        if (event.target === popup) closePopup();
    });
    popup.querySelectorAll('a').forEach((link) => link.addEventListener('click', rememberPopup));
    document.addEventListener('keydown', (event) => {
        if (popup.hidden) return;
        if (event.key === 'Escape') {
            closePopup();
            return;
        }
        if (event.key !== 'Tab') return;
        const focusable = dialog.querySelectorAll('a[href], button:not([disabled])');
        if (!focusable.length) return;
        const first = focusable[0];
        const last = focusable[focusable.length - 1];
        if (event.shiftKey && document.activeElement === first) {
            event.preventDefault();
            last.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
            event.preventDefault();
            first.focus();
        }
    });

    window.setTimeout(openPopup, 450);
})();

