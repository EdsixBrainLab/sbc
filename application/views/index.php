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
            <div class="hero-card glow-card" role="banner">
                <div class="hero-avatar" aria-hidden="true">
                    <i class="fa fa-rocket" aria-hidden="true"></i>
                </div>
                <div class="hero-content">
                    <p class="welcome-text">Play hub</p>
                    <h1 class="student-name">Fuel your SkillAngels streak</h1>
                    <p class="student-status">Bounce into vibrant quests, unlock badges, and climb the leaderboard with every play.</p>
                    <div class="hero-actions">
                        <a href="<?php echo base_url('index.php/home/mygames'); ?>" class="btn-play" aria-label="Jump into My Games"><i class="fa fa-play-circle"></i> Jump into My Games</a>
                        <a href="#whats-new" class="btn-secondary" aria-label="Skip to what's new section"><i class="fa fa-sun-o"></i> See what's new</a>
                    </div>
                    <div class="experience-ribbon" aria-label="Highlights">
                        <span class="experience-pill"><i class="fa fa-bolt"></i> Daily streak boosts</span>
                        <span class="experience-pill"><i class="fa fa-trophy"></i> Fresh badges weekly</span>
                        <span class="experience-pill"><i class="fa fa-heart"></i> Kid-friendly fun</span>
                    </div>
                </div>
            </div>
            <div class="portal-stat-grid" aria-label="Quick stats">
                <div class="portal-stat-card">
                    <small>Recommended next</small>
                    <strong>Today's Quest</strong>
                    <p class="subtitle">Play now to keep your streak glowing.</p>
                </div>
                <div class="portal-stat-card">
                    <small>Skill focus</small>
                    <strong>Memory &amp; Focus</strong>
                    <p class="subtitle">Alternate skills for bonus stars.</p>
                </div>
                <div class="portal-stat-card">
                    <small>Rewards</small>
                    <strong>3 badges</strong>
                    <p class="subtitle">More unlock when you finish 2 games.</p>
                </div>
            </div>
            <div class="feature-grid" aria-label="Quick actions">
                <a class="feature-card challenge" href="<?php echo base_url('index.php/home/mygames'); ?>" aria-label="Go to today's challenge">
                    <div class="feature-icon"><i class="fa fa-flag-checkered" aria-hidden="true"></i></div>
                    <div class="feature-body">
                        <p class="eyebrow">Daily spotlight</p>
                        <h2>Today's Challenge</h2>
                        <p>Test your skills with today's curated quest and earn bonus points.</p>
                    </div>
                </a>
                <a class="feature-card practice" href="<?php echo base_url('index.php/home/mygames'); ?>" aria-label="Practice a skill">
                    <div class="feature-icon"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></div>
                    <div class="feature-body">
                        <p class="eyebrow">Keep improving</p>
                        <h2>Practice a Skill</h2>
                        <p>Choose a skill area and sharpen your mastery with guided practice.</p>
                    </div>
                </a>
                <a class="feature-card rewards" href="<?php echo base_url('index.php/home/reports'); ?>" aria-label="View rewards">
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
