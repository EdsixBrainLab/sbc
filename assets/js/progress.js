(function () {
    var dataNode = document.querySelector('[data-progress-payload]');
    if (!dataNode) {
        return;
    }

    var payload;
    try {
        payload = JSON.parse(dataNode.getAttribute('data-progress-payload'));
    } catch (e) {
        return;
    }

    var storageKey = 'progress_sound_enabled';
    var toggle = document.getElementById('sound-toggle');
    var toggleLabel = document.getElementById('sound-toggle-label');
    var confetti = window.simpleConfetti;
    var audioContext;

    function getStoredPreference() {
        try {
            var saved = localStorage.getItem(storageKey);
            if (saved === null) return true;
            return saved === 'true';
        } catch (err) {
            return true;
        }
    }

    function setStoredPreference(value) {
        try {
            localStorage.setItem(storageKey, value ? 'true' : 'false');
        } catch (err) {
            // noop
        }
    }

    var soundEnabled = getStoredPreference();
    if (toggle) {
        toggle.checked = soundEnabled;
        if (toggleLabel) {
            toggleLabel.textContent = soundEnabled ? 'Sound effects on' : 'Sound effects off';
        }
        toggle.addEventListener('change', function () {
            soundEnabled = Boolean(toggle.checked);
            setStoredPreference(soundEnabled);
            if (toggleLabel) {
                toggleLabel.textContent = soundEnabled ? 'Sound effects on' : 'Sound effects off';
            }
        });
    }

    function playTone() {
        if (!soundEnabled) return;

        try {
            var AudioContext = window.AudioContext || window.webkitAudioContext;
            if (!AudioContext) return;

            if (!audioContext) {
                audioContext = new AudioContext();
            }

            var oscillator = audioContext.createOscillator();
            var gain = audioContext.createGain();

            oscillator.type = 'triangle';
            oscillator.frequency.value = 880;

            gain.gain.value = 0.06;

            oscillator.connect(gain);
            gain.connect(audioContext.destination);

            oscillator.start();
            oscillator.stop(audioContext.currentTime + 0.22);
        } catch (err) {
            // Ignore playback errors to avoid blocking UI
        }
    }

    function celebrate() {
        if (typeof confetti === 'function') {
            confetti();
        }

        playTone();
    }

    function hasMilestones() {
        var earnedBadges = (payload.badges || []).filter(function (badge) { return badge.earned; }).length;
        var badgeGoal = payload.badgeTarget || 3;
        var streakHit = payload.streakDays >= (payload.streakTarget || 5);
        var skillsHit = (payload.skillsCompleted || 0) >= (payload.skillTarget || 1);

        return streakHit || skillsHit || earnedBadges >= badgeGoal;
    }

    if (hasMilestones()) {
        celebrate();
    }

    function setupModals() {
        var openers = document.querySelectorAll('[data-modal-open]');
        var closers = document.querySelectorAll('[data-modal-close]');
        var modals = document.querySelectorAll('.ds-modal');
        var lastTrigger;

        function openModal(modal, trigger) {
            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            lastTrigger = trigger || lastTrigger;
            var focusTarget = modal.querySelector('[data-modal-close]') || modal.querySelector('button, [href], input, select, textarea');
            if (focusTarget) {
                focusTarget.focus();
            }
        }

        function closeModal(modal) {
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
            if (lastTrigger && typeof lastTrigger.focus === 'function') {
                lastTrigger.focus();
            }
        }

        openers.forEach(function (opener) {
            var targetId = opener.getAttribute('data-modal-open');
            var modal = document.getElementById(targetId);
            if (!modal) return;

            opener.addEventListener('click', function () {
                openModal(modal, opener);
            });
        });

        closers.forEach(function (closer) {
            closer.addEventListener('click', function () {
                var modal = closer.closest('.ds-modal');
                if (modal) {
                    closeModal(modal);
                }
            });
        });

        modals.forEach(function (modal) {
            modal.addEventListener('click', function (event) {
                if (event.target.hasAttribute('data-modal-close')) {
                    closeModal(modal);
                }
            });
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                modals.forEach(function (modal) {
                    if (modal.classList.contains('is-open')) {
                        closeModal(modal);
                    }
                });
            }
        });
    }

    setupModals();
})();
