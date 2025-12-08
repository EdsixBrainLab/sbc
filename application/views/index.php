<?php
//include_once("db_connection.php");
//include("qry/Query.php");
date_default_timezone_set('Asia/Kolkata');
//if(isset($_SESSION['userId'])){header("Location:profile.php");exit;}
?>

<main id="main-content">
<section class="landing-wrapper">
    <div class="container">
        <div class="landing-grid">
            <div class="hero-card" role="banner">
                <div class="hero-avatar" aria-hidden="true">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
                <div class="hero-content">
                    <p class="welcome-text">Welcome back,</p>
                    <h1 class="student-name">Super Student</h1>
                    <p class="student-status">Ready to pick up where you left off? Jump back into the challenge and level up.</p>
                    <div class="hero-actions">
                        <a href="#" class="btn-play" aria-label="Play current challenge">Resume current challenge</a>
                        <a href="#whats-new" class="btn-secondary" aria-label="Skip to what's new section">See what's new</a>
                    </div>
                </div>
            </div>
            <div class="feature-grid" aria-label="Quick actions">
                <a class="feature-card challenge" href="#" aria-label="Go to today's challenge">
                    <div class="feature-icon"><i class="fa fa-flag-checkered" aria-hidden="true"></i></div>
                    <div class="feature-body">
                        <p class="eyebrow">Daily spotlight</p>
                        <h2>Today's Challenge</h2>
                        <p>Test your skills with today's curated quest and earn bonus points.</p>
                    </div>
                </a>
                <a class="feature-card practice" href="#" aria-label="Practice a skill">
                    <div class="feature-icon"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></div>
                    <div class="feature-body">
                        <p class="eyebrow">Keep improving</p>
                        <h2>Practice a Skill</h2>
                        <p>Choose a skill area and sharpen your mastery with guided practice.</p>
                    </div>
                </a>
                <a class="feature-card rewards" href="#" aria-label="View rewards">
                    <div class="feature-icon"><i class="fa fa-trophy" aria-hidden="true"></i></div>
                    <div class="feature-body">
                        <p class="eyebrow">Motivation</p>
                        <h2>Rewards</h2>
                        <p>See how many badges you've unlocked and what's coming up next.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<section id="whats-new" class="whats-new-section" aria-labelledby="whats-new-heading">
    <div class="container">
        <div class="section-header">
            <div>
                <p class="eyebrow">Stay updated</p>
                <h2 id="whats-new-heading">What's New</h2>
            </div>
            <div class="whats-new-actions">
                <button class="scroll-btn" data-direction="prev" type="button" aria-label="Show previous update" title="Previous update"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
                <button class="scroll-btn" data-direction="next" type="button" aria-label="Show next update" title="Next update"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
            </div>
        </div>
        <div class="whats-new-carousel" role="region" aria-label="Latest updates">
            <div class="sr-only" id="whats-new-live" aria-live="polite"></div>
            <div class="carousel-track">
                <article class="carousel-card">
                    <p class="eyebrow">Feature</p>
                    <h4>New brain games added</h4>
                    <p>Explore fresh puzzles crafted to boost your memory and speed.</p>
                    <span class="tag">Just added</span>
                </article>
                <article class="carousel-card">
                    <p class="eyebrow">Events</p>
                    <h4>Weekend sprint</h4>
                    <p>Join the community sprint this weekend and climb the leaderboard.</p>
                    <span class="tag">Live soon</span>
                </article>
                <article class="carousel-card">
                    <p class="eyebrow">Rewards</p>
                    <h4>Bonus streak points</h4>
                    <p>Keep your daily streak alive to unlock bonus trophies and prizes.</p>
                    <span class="tag">Hot</span>
                </article>
                <article class="carousel-card">
                    <p class="eyebrow">Tips</p>
                    <h4>Focus hacks</h4>
                    <p>Try our quick focus exercises before starting a challenge.</p>
                    <span class="tag">Tips</span>
                </article>
            </div>
        </div>
    </div>
</section>
</main>

<style>
    .landing-wrapper {
        padding: 40px 0 10px;
        background: radial-gradient(circle at 10% 20%, #e2ecff, #ffffff 50%);
    }

    .landing-grid {
        display: grid;
        gap: 24px;
    }

    .landing-wrapper .container {
        max-width: 1200px;
    }

    .hero-card {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 18px;
        padding: 28px;
        background: linear-gradient(135deg, #1a73e8, #2c528b);
        color: #f5f7ff;
        border-radius: 20px;
        box-shadow: 0 18px 60px rgba(26, 115, 232, 0.25);
        align-items: center;
    }

    .hero-avatar {
        width: 110px;
        height: 110px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 2px solid rgba(255, 255, 255, 0.35);
    }

    .hero-avatar i {
        font-size: 48px;
        color: #fff;
    }

    .hero-content .welcome-text {
        margin: 0;
        font-size: 14px;
        letter-spacing: 1px;
        text-transform: uppercase;
        opacity: 0.8;
    }

    .hero-content .student-name {
        margin: 6px 0 10px;
        font-size: 30px;
        font-weight: 700;
        letter-spacing: -0.5px;
    }

    .hero-content .student-status {
        margin: 0 0 18px;
        max-width: 640px;
        font-size: 16px;
        line-height: 1.5;
        opacity: 0.95;
    }

    .hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .hero-actions a {
        text-decoration: none;
        font-weight: 700;
        font-size: 15px;
        border-radius: 999px;
        padding: 12px 22px;
        min-height: 44px;
        letter-spacing: 0.2px;
        transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        outline: 3px solid transparent;
        outline-offset: 3px;
    }

    .btn-play {
        background: #fff;
        color: #1a73e8;
        box-shadow: 0 10px 30px rgba(255, 255, 255, 0.25);
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.16);
        color: #f5f7ff;
        border: 1px solid rgba(255, 255, 255, 0.35);
    }

    .hero-actions a:hover,
    .hero-actions a:focus-visible {
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
        background: #ffffff;
        color: #1a73e8;
        outline-color: rgba(255, 255, 255, 0.8);
    }

    .feature-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 16px;
    }

    .feature-card {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 12px;
        padding: 18px;
        border-radius: 16px;
        text-decoration: none;
        color: #0b2345;
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.08);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        outline: 3px solid transparent;
        outline-offset: 4px;
        min-height: 140px;
    }

    .feature-card .feature-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: #0b2345;
    }

    .feature-card .eyebrow {
        margin: 0;
        opacity: 0.85;
        font-size: 12px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .feature-card h2 {
        margin: 4px 0 6px;
        font-size: 20px;
        font-weight: 700;
        letter-spacing: -0.2px;
    }

    .feature-card p {
        margin: 0;
        color: #0b2345;
        line-height: 1.5;
        font-size: 14px;
    }

    .feature-card:hover,
    .feature-card:focus-visible {
        transform: translateY(-4px);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.15);
        outline-color: rgba(11, 35, 69, 0.35);
    }

    .feature-card.challenge { background: linear-gradient(135deg, #ffe2dd, #ffc7b5); }
    .feature-card.practice { background: linear-gradient(135deg, #d7e6ff, #c8f3ff); }
    .feature-card.rewards { background: linear-gradient(135deg, #def0df, #c5eac5); }

    .whats-new-section {
        padding: 40px 0 60px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .section-header h2 {
        margin: 2px 0 0;
        font-size: 24px;
        font-weight: 700;
        color: #1c2b4a;
    }

    .section-header .eyebrow {
        margin: 0;
        color: #4f5d78;
        font-size: 12px;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .whats-new-actions {
        display: flex;
        gap: 8px;
    }

    .scroll-btn {
        min-width: 44px;
        min-height: 44px;
        border: 1px solid #dce3f1;
        background: #fff;
        border-radius: 10px;
        color: #1c2b4a;
        cursor: pointer;
        transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        outline: 3px solid transparent;
        outline-offset: 2px;
        padding: 6px;
    }

    .scroll-btn:hover,
    .scroll-btn:focus-visible {
        background: #eaf0ff;
        transform: translateY(-1px);
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
        outline-color: #a6b7ff;
    }

    .whats-new-carousel {
        position: relative;
        overflow: hidden;
    }

    .carousel-track {
        display: grid;
        grid-auto-flow: column;
        grid-auto-columns: minmax(220px, 1fr);
        gap: 14px;
        overflow-x: auto;
        padding: 6px 4px 4px;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
    }

    .carousel-track::-webkit-scrollbar {
        height: 8px;
    }

    .carousel-track::-webkit-scrollbar-thumb {
        background: #c4d0e7;
        border-radius: 999px;
    }

    .carousel-card {
        scroll-snap-align: start;
        background: #fff;
        border: 1px solid #e6edfb;
        border-radius: 14px;
        padding: 16px;
        box-shadow: 0 12px 30px rgba(28, 43, 74, 0.06);
        min-height: 170px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .carousel-card h4 {
        margin: 0;
        color: #1c2b4a;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: -0.2px;
    }

    .carousel-card p {
        margin: 0;
        color: #4f5d78;
        line-height: 1.5;
    }

    .carousel-card .eyebrow {
        margin: 0;
        color: #7d8aa5;
        font-size: 12px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .carousel-card .tag {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 10px;
        border-radius: 999px;
        background: #eaf0ff;
        color: #1a73e8;
        font-weight: 600;
        font-size: 12px;
        width: fit-content;
        margin-top: auto;
    }

    .carousel-card:hover,
    .carousel-card:focus-within {
        transform: translateY(-3px);
        box-shadow: 0 16px 38px rgba(28, 43, 74, 0.14);
    }

    @media (min-width: 960px) {
        .landing-grid {
            grid-template-columns: minmax(0, 1.05fr) minmax(0, 0.95fr);
            align-items: stretch;
        }

        .hero-card,
        .feature-grid {
            height: 100%;
        }
    }

    @media (max-width: 900px) {
        .hero-card {
            grid-template-columns: 1fr;
            text-align: center;
            justify-items: center;
        }

        .hero-content .student-name {
            font-size: 26px;
        }

        .hero-content .student-status {
            max-width: none;
        }

        .hero-actions {
            justify-content: center;
        }
    }

    @media (max-width: 640px) {
        .landing-wrapper { padding-top: 24px; }
        .hero-card { padding: 22px; }
        .feature-card {
            grid-template-columns: 1fr;
        }
        .feature-card .feature-icon {
            justify-self: flex-start;
        }
        .section-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .whats-new-actions {
            align-self: flex-end;
        }

        .carousel-track {
            grid-auto-columns: minmax(240px, 1fr);
        }
    }

    @media (max-width: 480px) {
        .hero-actions {
            width: 100%;
        }

        .hero-actions a {
            flex: 1 1 100%;
            text-align: center;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
            transition: none !important;
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
        }

        .carousel-track {
            scroll-behavior: auto;
        }
    }

    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }
</style>

<script>
    (function() {
        const track = document.querySelector('.carousel-track');
        const buttons = document.querySelectorAll('.scroll-btn');
        const liveRegion = document.getElementById('whats-new-live');
        const cards = track ? Array.from(track.querySelectorAll('.carousel-card')) : [];
        let currentIndex = 0;

        function announceCard(index) {
            if (!liveRegion || !cards.length) return;
            const card = cards[index];
            if (!card) return;
            const eyebrow = card.querySelector('.eyebrow');
            const title = card.querySelector('h4');
            const prefix = eyebrow ? eyebrow.textContent.trim() + ': ' : '';
            liveRegion.textContent = prefix + (title ? title.textContent.trim() : 'Update');
        }

        if (!track || !buttons.length || !cards.length) return;

        announceCard(currentIndex);

        buttons.forEach((btn) => {
            btn.addEventListener('click', () => {
                const direction = btn.getAttribute('data-direction');
                currentIndex = direction === 'next'
                    ? (currentIndex + 1) % cards.length
                    : (currentIndex - 1 + cards.length) % cards.length;

                const targetCard = cards[currentIndex];
                if (targetCard && typeof targetCard.scrollIntoView === 'function') {
                    targetCard.scrollIntoView({ behavior: 'smooth', inline: 'start' });
                }

                announceCard(currentIndex);
            });
        });
    })();
</script>
