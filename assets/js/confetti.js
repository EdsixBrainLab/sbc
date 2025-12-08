(function (global) {
    function createConfettiPiece(container, colors) {
        var piece = document.createElement('span');
        var size = Math.floor(Math.random() * 8) + 6;
        var color = colors[Math.floor(Math.random() * colors.length)];
        piece.className = 'confetti-piece';
        piece.style.backgroundColor = color;
        piece.style.width = size + 'px';
        piece.style.height = size * 0.4 + 'px';
        piece.style.left = Math.floor(Math.random() * 100) + '%';
        piece.style.animationDelay = (Math.random() * 0.2) + 's';
        piece.style.animationDuration = (Math.random() * 1.2 + 1.3) + 's';
        container.appendChild(piece);
    }

    function injectStyles() {
        if (document.getElementById('confetti-style')) {
            return;
        }

        var style = document.createElement('style');
        style.id = 'confetti-style';
        style.textContent = '\
        .confetti-container {\
            position: fixed;\
            inset: 0;\
            pointer-events: none;\
            overflow: hidden;\
            z-index: 9999;\
        }\
        .confetti-piece {\
            position: absolute;\
            top: -10px;\
            opacity: 0.9;\
            border-radius: 1px;\
            transform: rotate(10deg);\
            animation-name: confetti-fall;\
            animation-timing-function: ease-out;\
        }\
        @keyframes confetti-fall {\
            0% { transform: translateY(0) rotate(0deg); opacity: 1; }\
            80% { opacity: 0.95; }\
            100% { transform: translateY(120vh) rotate(360deg); opacity: 0; }\
        }';
        document.head.appendChild(style);
    }

    function launchConfetti() {
        var container = document.createElement('div');
        container.className = 'confetti-container';
        var colors = ['#ff5c5d', '#f6d155', '#00bfa5', '#56c0e0', '#7b61ff'];

        for (var i = 0; i < 80; i++) {
            createConfettiPiece(container, colors);
        }

        document.body.appendChild(container);

        setTimeout(function () {
            document.body.removeChild(container);
        }, 1800);
    }

    function init() {
        injectStyles();
        return launchConfetti;
    }

    global.simpleConfetti = init();
}(window));
