<?php
require_once 'includes/language-config.php';
require_once 'includes/special-translations.php';
$inquiryParam = filter_input(INPUT_GET, 'inquiry', FILTER_UNSAFE_RAW);
$defaultInquirySubject = trim(is_string($inquiryParam) ? $inquiryParam : '');
$special = special_content();
$specialLanguage = rawurlencode(getCurrentLanguage());
$specialDetailsUrl = 'special.php?lang=' . $specialLanguage;
$specialInquiryUrl = 'index.php?lang=' . $specialLanguage . '&inquiry=' . rawurlencode('Angola Christmas 2026') . '#contact';
$showChristmasSpecial = new DateTimeImmutable('now', new DateTimeZone('Africa/Windhoek')) < new DateTimeImmutable('2027-01-08 00:00:00', new DateTimeZone('Africa/Windhoek'));
?>
<!DOCTYPE html>
<html lang="<?= getPageLanguage() ?>" dir="<?= getTextDirection() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= t('meta.home.title') ?></title>
    <meta name="description" content="<?= t('meta.home.description') ?>">
    <meta name="keywords" content="<?= __('page.keywords') ?>">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="special.css">
    <!-- Flag Icons CSS Library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>
    <header class="hero">
        <nav class="main-nav" aria-label="Primary">
            <a href="index.php" class="logo" aria-label="Travel Angola Home">
                <img src="images/logo_sm.webp" alt="Travel Angola Logo" class="logo-img">
                <span class="logo-text">Travel Angola</span>
            </a>
            <ul class="nav-links" id="primary-nav">
                <li><a href="#about"><?= t('nav.about') ?></a></li>
                <li><a href="#destinations"><?= t('nav.destinations') ?></a></li>
                <li><a href="#activities"><?= t('nav.activities') ?></a></li>
                <li><a href="<?= htmlspecialchars($specialDetailsUrl, ENT_QUOTES, 'UTF-8') ?>"><?= t('nav.special', 'Special') ?></a></li>
                <li><a href="gallery.php"><?= t('nav.gallery') ?></a></li>
                <li><a href="#reviews"><?= t('nav.reviews') ?></a></li>
                <li><a href="#contact"><?= t('nav.contact') ?></a></li>
            </ul>
            <div class="language-nav">
                <?php include 'includes/flag-icon-language-switcher.php'; ?>
            </div>
        </nav>
        <div class="hero-content">
            <h1><?= t('hero.title') ?></h1>
            <p><?= t('hero.subtitle') ?></p>
            <div class="hero-actions">
                <a href="#activities" class="cta-button"><?= t('hero.cta_primary') ?></a>
                <a href="?inquiry=<?= rawurlencode(t('hero.bespoke_subject')) ?>#contact" class="cta-button cta-button-secondary"><?= t('hero.cta_secondary') ?></a>
            </div>
            <p class="hero-offer"><?= t('hero.price_note') ?></p>

            <!-- Carousel start -->
            <div class="hero-carousel" aria-roledescription="carousel" aria-label="Hero images carousel">
                <div class="hc-slides" role="list"></div>

                <button class="hc-btn hc-prev" aria-label="Previous slide">&lsaquo;</button>
                <button class="hc-btn hc-next" aria-label="Next slide">&rsaquo;</button>

                <div class="hc-indicators" role="tablist" aria-label="Slide indicators"></div>
            </div>

            <style>
            .main-nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1.25rem;
                width: 100%;
            }

            .main-nav .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }

            /* Minimal hero carousel styles (tweak in styles.css if preferred) */
            .hero-carousel{position:relative;width:100%;max-width:1100px;margin:1.25rem auto;overflow:hidden;border-radius:12px;touch-action:pan-y;contain:layout paint}
            .hc-slides{display:flex;transition:transform 0.6s ease;will-change:transform}
            .hc-slide{min-width:100%;box-sizing:border-box;display:flex;align-items:center;justify-content:center;background:#111;background-size:cover;background-position:center;height:320px}
            .hc-slide img{width:100%;height:100%;object-fit:cover;display:block}
            .hc-btn{position:absolute;top:50%;transform:translateY(-50%);background:rgba(0,0,0,0.45);border:0;color:#fff;padding:10px 14px;border-radius:6px;cursor:pointer;font-size:22px}
            .hc-prev{left:12px} .hc-next{right:12px}
            .hc-indicators{position:absolute;left:50%;transform:translateX(-50%);bottom:10px;display:flex;gap:8px}
            .hc-indicators button{width:10px;height:10px;border-radius:50%;border:0;background:rgba(255,255,255,0.45);cursor:pointer}
            .hc-indicators button[aria-selected="true"]{background:#ff6b6b;box-shadow:0 0 6px rgba(255,107,107,0.6)}
            .hc-btn:focus-visible,.hc-indicators button:focus-visible{outline:2px solid #fff;outline-offset:2px}
            /* Small screens */
            @media(min-width:900px){ .hero-carousel .hc-slide{height:420px} }
            @media (prefers-reduced-motion: reduce){
                .hc-slides{transition:none}
            }
            
            /* Language switcher enhanced styles */
            .language-nav {
                display: flex;
                gap: 15px;
                align-items: center;
                justify-content: center;
                margin: 20px 0;
            }

            /* Override the flag switcher styles to match our design */
            .language-nav .flag-icon-language-switcher {
                gap: 15px;
            }

            .language-nav .flag-lang-option,
            .language-nav .current-flag-lang {
                display: flex !important;
                align-items: center !important;
                gap: 8px !important;
                padding: 8px 15px !important;
                text-decoration: none !important;
                border-radius: 25px !important;
                background: rgba(255, 255, 255, 0.9) !important;
                border: 2px solid transparent !important;
                transition: all 0.3s ease !important;
                font-weight: 500 !important;
                font-size: 14px !important;
                color: #333 !important;
            }

            .language-nav .flag-lang-option:hover {
                background: rgba(255, 255, 255, 1) !important;
                border-color: #d4af37 !important;
                transform: translateY(-2px) !important;
                color: #333 !important;
            }

            .language-nav .current-flag-lang {
                background: #d4af37 !important;
                color: white !important;
                border-color: #d4af37 !important;
            }

            .language-nav .fi {
                width: 20px !important;
                height: 15px !important;
                border-radius: 3px !important;
            }

            .language-nav .lang-label {
                text-transform: uppercase !important;
                font-size: 12px !important;
                font-weight: 600 !important;
                letter-spacing: 0.5px !important;
            }
            
            /* Language nav responsive */
            @media (max-width: 768px) {
                .main-nav {
                    flex-direction: column;
                    align-items: stretch;
                    gap: 0.75rem;
                }

                .main-nav .nav-links {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: center;
                    gap: 0.75rem 1rem;
                }

                .language-nav {
                    flex-wrap: wrap;
                    gap: 10px;
                    margin: 0;
                }
                
                .language-nav .flag-lang-option,
                .language-nav .current-flag-lang {
                    font-size: 0.9rem !important;
                    padding: 6px 12px !important;
                }
            }
            </style>

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const slides = [
                    'images/carosoul/1car.webp',
                    'images/carosoul/2car.webp',
                    'images/carosoul/3car.webp',
                    'images/carosoul/4car.webp',
                    'images/carosoul/5car.webp',
                    'images/carosoul/6car.webp',
                    'images/carosoul/7car.webp',
                    'images/carosoul/8car.webp',
                    'images/carosoul/9car.webp',
                    'images/carosoul/10car.webp',
                    'images/carosoul/11car.webp',
                    'images/carosoul/12car.webp',
                    'images/carosoul/13car.webp',
                    'images/carosoul/14car.webp',
                    'images/carosoul/15car.webp'
                ];

                const root = document.querySelector('.hero-carousel');
                if (!root) {
                    return;
                }

                const slidesEl = root.querySelector('.hc-slides');
                const indicatorsEl = root.querySelector('.hc-indicators');
                const prevBtn = root.querySelector('.hc-prev');
                const nextBtn = root.querySelector('.hc-next');
                if (!slidesEl || !indicatorsEl || !prevBtn || !nextBtn || slides.length === 0) {
                    return;
                }

                let index = 0;
                let autoplayTimer = null;
                const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                const AUTOPLAY_MS = 4500;

                slidesEl.id = 'hero-carousel-slides';
                prevBtn.type = 'button';
                nextBtn.type = 'button';
                prevBtn.setAttribute('aria-controls', slidesEl.id);
                nextBtn.setAttribute('aria-controls', slidesEl.id);

                const slidesFragment = document.createDocumentFragment();
                const indicatorsFragment = document.createDocumentFragment();

                slides.forEach((src, i) => {
                    const slide = document.createElement('div');
                    slide.className = 'hc-slide';
                    slide.setAttribute('role', 'listitem');

                    const img = document.createElement('img');
                    img.src = src;
                    img.alt = `Angola Landscape ${i + 1}`;
                    img.loading = i === 0 ? 'eager' : 'lazy';
                    img.decoding = 'async';
                    if (i === 0) {
                        img.fetchPriority = 'high';
                    }
                    slide.appendChild(img);
                    slidesFragment.appendChild(slide);

                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.setAttribute('role', 'tab');
                    btn.setAttribute('aria-selected', i === 0 ? 'true' : 'false');
                    btn.setAttribute('tabindex', i === 0 ? '0' : '-1');
                    btn.setAttribute('aria-label', `Go to slide ${i + 1}`);
                    btn.addEventListener('click', () => goTo(i));
                    indicatorsFragment.appendChild(btn);
                });
                slidesEl.appendChild(slidesFragment);
                indicatorsEl.appendChild(indicatorsFragment);

                function updateIndicators(newIndex) {
                    const dots = indicatorsEl.children;
                    for (let i = 0; i < dots.length; i += 1) {
                        const isActive = i === newIndex;
                        dots[i].setAttribute('aria-selected', isActive ? 'true' : 'false');
                        dots[i].setAttribute('tabindex', isActive ? '0' : '-1');
                    }
                }

                function goTo(newIndex) {
                    const total = slides.length;
                    const safeIndex = ((newIndex % total) + total) % total;
                    index = safeIndex;
                    requestAnimationFrame(() => {
                        slidesEl.style.transform = `translateX(-${index * 100}%)`;
                    });
                    updateIndicators(index);
                    restartAutoplay();
                }

                function next() {
                    goTo(index + 1);
                }

                function prev() {
                    goTo(index - 1);
                }

                function stopAutoplay() {
                    if (autoplayTimer) {
                        clearInterval(autoplayTimer);
                        autoplayTimer = null;
                    }
                }

                function startAutoplay() {
                    if (reduceMotion || document.hidden) {
                        return;
                    }
                    stopAutoplay();
                    autoplayTimer = setInterval(next, AUTOPLAY_MS);
                }

                function restartAutoplay() {
                    stopAutoplay();
                    startAutoplay();
                }

                prevBtn.addEventListener('click', prev);
                nextBtn.addEventListener('click', next);
                root.addEventListener('mouseenter', stopAutoplay);
                root.addEventListener('mouseleave', startAutoplay);
                root.addEventListener('focusin', stopAutoplay);
                root.addEventListener('focusout', startAutoplay);
                root.addEventListener('keydown', function(event) {
                    if (event.key === 'ArrowLeft') {
                        event.preventDefault();
                        prev();
                    }
                    if (event.key === 'ArrowRight') {
                        event.preventDefault();
                        next();
                    }
                });

                document.addEventListener('visibilitychange', function() {
                    if (document.hidden) {
                        stopAutoplay();
                    } else {
                        startAutoplay();
                    }
                });

                goTo(0);
                startAutoplay();
            });
            </script>
            <!-- Carousel end -->
        </div>
    </header>

    <main>
        <section id="about" class="about">
            <div class="container">
                <h2><?= t('about.title') ?></h2>
                <p><?= t('about.text') ?>
                    <br>
                    <?= t('about.text2') ?>
                    <br>
                    <?= t('about.text3') ?>
                </p>
            </div>
        </section>

        <section id="map" class="map-section">
            <div class="container">
                <h2><?= t('map.title') ?></h2>
                <div class="map-layout">
                    <div class="map-viewport">
                        <div id="map-placeholder" class="map-placeholder">
                            <div class="placeholder-content">
                                <div class="map-icon">🗺️</div>
                                <h3><?= t('map.title') ?></h3>
                                <p id="map-status-text"><?= t('map.description') ?></p>
                                <button type="button" class="load-map-btn"><?= t('map.load', 'Load Interactive Map') ?></button>
                                <div id="map-progress" class="progress-container" style="display: none;" aria-hidden="true">
                                    <div class="progress-bar">
                                        <div class="progress-fill"></div>
                                    </div>
                                    <div class="progress-text">0%</div>
                                </div>
                            </div>
                        </div>
                        <object id="angola-map-object" type="image/svg+xml" data="images/angola-map.svg" aria-label="Angola provinces map" style="display: none;"></object>
                    </div>
                    <aside id="province-panel" class="province-panel" aria-live="polite">
                        <h3 id="panel-title"><?= t('province.select') ?></h3>
                        <dl class="province-stats">
                            <div class="stat-row"><dt><?= t('province.name') ?></dt><dd id="stat-province">—</dd></div>
                            <div class="stat-row"><dt><?= t('province.capital') ?></dt><dd id="stat-capital">—</dd></div>
                            <div class="stat-row"><dt><?= t('province.area') ?></dt><dd id="stat-area">—</dd></div>
                            <div class="stat-row"><dt><?= t('province.population') ?></dt><dd id="stat-population">—</dd></div>
                            <div class="stat-row"><dt><?= t('province.density') ?></dt><dd id="stat-density">—</dd></div>
                            <div class="stat-row"><dt><?= t('province.region') ?></dt><dd id="stat-region">—</dd></div>
                        </dl>
                    </aside>
                </div>
            </div>
        </section>

        <section id="destinations" class="destinations">
            <div class="container">
                <h2><?= t('destinations.title') ?></h2>
                <div class="destination-grid">
                    <div class="destination-card">
                        <h3><?= t('destinations.luanda.title') ?></h3>
                        <p><?= t('destinations.luanda.desc') ?></p>
                    </div>
                    <div class="destination-card">
                        <h3><?= t('destinations.benguela.title') ?></h3>
                        <p><?= t('destinations.benguela.desc') ?></p>
                    </div>
                    <div class="destination-card">
                        <h3><?= t('destinations.namibe.title') ?></h3>
                        <p><?= t('destinations.namibe.desc') ?></p>
                    </div>
                    <div class="destination-card">
                        <h3><?= t('destinations.huambo.title') ?></h3>
                        <p><?= t('destinations.huambo.desc') ?></p>
                    </div>
                    <div class="destination-card">
                        <h3><?= t('destinations.kissama.title') ?></h3>
                        <p><?= t('destinations.kissama.desc') ?></p>
                    </div>
                    <div class="destination-card">
                        <h3><?= t('destinations.malanje.title') ?></h3>
                        <p><?= t('destinations.malanje.desc') ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section id="activities" class="activities">
            <div class="container">
                <h2><?= t('activities.title') ?></h2>
                <div class="activities-grid">
                    <div class="activity-card">
                        <h3><?= t('activities.beach.title') ?></h3>
                        <p><?= t('activities.beach.desc') ?></p>
                        <div class="activity-links">
                            <a href="?inquiry=<?= rawurlencode(t('activities.beach.title')) ?>#contact" class="activity-link activity-link-secondary"><?= t('activities.enquire') ?> →</a>
                        </div>
                    </div>
                    <div class="activity-card">
                        <h3><?= t('activities.safari.title') ?></h3>
                        <p><?= t('activities.safari.desc') ?></p>
                        <div class="activity-links">
                            <a href="?inquiry=<?= rawurlencode(t('activities.safari.title')) ?>#contact" class="activity-link activity-link-secondary"><?= t('activities.enquire') ?> →</a>
                        </div>
                    </div>
                    <div class="activity-card">
                        <h3><?= t('activities.culture.title') ?></h3>
                        <p><?= t('activities.culture.desc') ?></p>
                        <div class="activity-links">
                            <a href="?inquiry=<?= rawurlencode(t('activities.culture.title')) ?>#contact" class="activity-link activity-link-secondary"><?= t('activities.enquire') ?> →</a>
                        </div>
                    </div>
                    <div class="activity-card">
                        <h3><?= t('activities.hiking.title') ?></h3>
                        <p><?= t('activities.hiking.desc') ?></p>
                        <div class="activity-links">
                            <a href="?inquiry=<?= rawurlencode(t('activities.hiking.title')) ?>#contact" class="activity-link activity-link-secondary"><?= t('activities.enquire') ?> →</a>
                        </div>
                    </div>
                    <div class="activity-card">
                        <h3><?= t('activities.city.title') ?></h3>
                        <p><?= t('activities.city.desc') ?></p>
                        <div class="activity-links">
                            <a href="?inquiry=<?= rawurlencode(t('activities.city.title')) ?>#contact" class="activity-link activity-link-secondary"><?= t('activities.enquire') ?> →</a>
                        </div>
                    </div>
                    <div class="activity-card">
                        <h3><?= t('activities.photo.title') ?></h3>
                        <p><?= t('activities.photo.desc') ?></p>
                        <div class="activity-links">
                            <a href="?inquiry=<?= rawurlencode(t('activities.photo.title')) ?>#contact" class="activity-link activity-link-secondary"><?= t('activities.enquire') ?> →</a>
                        </div>
                    </div>
                    <div class="activity-card">
                        <h3><?= t('activities.fishing.title') ?></h3>
                        <p><?= t('activities.fishing.desc') ?></p>
                        <div class="activity-links">
                            <a href="fishing.php" class="activity-link"><?= t('activities.fishing.view_tours') ?> →</a>
                            <a href="?inquiry=<?= rawurlencode(t('activities.fishing.title')) ?>#contact" class="activity-link activity-link-secondary"><?= t('activities.enquire') ?> →</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="gallery" class="gallery">
            <div class="container">
                <h2><?= t('gallery.title') ?></h2>
                <p style="text-align: center; font-size: 1.1rem; margin-bottom: 2rem; color: #666;">
                    <?= t('gallery.subtitle') ?>
                </p>
                <div class="gallery-grid gallery-preview">
                    <div class="gallery-item">
                        <img src="images/gal1.webp" alt="<?= t('gallery.luanda_skyline') ?>" loading="lazy">
                    </div>
                    <div class="gallery-item">
                        <img src="images/gal2.webp" alt="<?= t('gallery.benguela_beach') ?>" loading="lazy">
                    </div>
                    <div class="gallery-item">
                        <img src="images/gal3.webp" alt="<?= t('gallery.namibe_desert') ?>" loading="lazy">
                    </div>
                    <div class="gallery-item">
                        <img src="images/gal5.webp" alt="<?= t('gallery.kissama_park') ?>" loading="lazy">
                    </div>
                    <div class="gallery-item">
                        <img src="images/gal6.webp" alt="<?= t('gallery.huambo_city') ?>" loading="lazy">
                    </div>
                    <div class="gallery-item">
                        <img src="images/gal7.webp" alt="<?= t('gallery.angolan_culture') ?>" loading="lazy">
                    </div>
                    <div class="gallery-item">
                        <img src="images/gal10.webp" alt="<?= t('gallery.local_market') ?>" loading="lazy">
                    </div>
                    <div class="gallery-item">
                        <img src="images/gal11.webp" alt="<?= t('gallery.mountain_landscape') ?>" loading="lazy">
                    </div>
                </div>
                
                <!-- Gallery CTA -->
                <div style="text-align: center; margin-top: 3rem;">
                    <p style="font-size: 1.1rem; color: #666; margin-bottom: 1.5rem;">
                        <strong><?= t('gallery.photo_count') ?></strong> <?= t('gallery.capturing_essence') ?>
                    </p>
                    <a href="gallery.php" class="cta-button" style="display: inline-block; padding: 15px 30px; background: linear-gradient(135deg, #2d5016, #d4af37); color: white; text-decoration: none; border-radius: 25px; font-weight: 500; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <?= t('gallery.view_full') ?> →
                    </a>
                </div>
            </div>
        </section>

        <!-- Reviews Section -->
        <section id="reviews" class="reviews">
            <div class="container">
                <h2><?= t('reviews.title') ?></h2>
                <p class="section-subtitle"><?= t('reviews.subtitle') ?></p>
                
                <div class="reviews-grid">
                    <!-- Review Card 1 -->
                    <div class="review-card">
                        <div class="review-rating">
                            <span class="stars">★★★★★</span>
                            <span class="rating-text"><?= t('reviews.card1.rating') ?></span>
                        </div>
                        <h3><?= t('reviews.card1.title') ?></h3>
                        <p class="review-excerpt"><?= t('reviews.card1.excerpt') ?></p>
                        <div class="review-author">
                            <strong><?= t('reviews.card1.author') ?></strong>
                        </div>
                        <a href="?inquiry=<?= rawurlencode(t('reviews.card1.title')) ?>#contact" class="review-link">
                            <?= t('common.get_quote') ?> →
                        </a>
                    </div>

                    <!-- Review Card 2 -->
                    <div class="review-card">
                        <div class="review-rating">
                            <span class="stars">★★★★★</span>
                            <span class="rating-text"><?= t('reviews.card2.rating') ?></span>
                        </div>
                        <h3><?= t('reviews.card2.title') ?></h3>
                        <p class="review-excerpt"><?= t('reviews.card2.excerpt') ?></p>
                        <div class="review-author">
                            <strong><?= t('reviews.card2.author') ?></strong>
                        </div>
                        <a href="?inquiry=<?= rawurlencode(t('reviews.card2.title')) ?>#contact" class="review-link">
                            <?= t('common.get_quote') ?> →
                        </a>
                    </div>

                    <!-- Review Card 3 -->
                    <div class="review-card">
                        <div class="review-rating">
                            <span class="stars">★★★★★</span>
                            <span class="rating-text"><?= t('reviews.card3.rating') ?></span>
                        </div>
                        <h3><?= t('reviews.card3.title') ?></h3>
                        <p class="review-excerpt"><?= t('reviews.card3.excerpt') ?></p>
                        <div class="review-author">
                            <strong><?= t('reviews.card3.author') ?></strong>
                        </div>
                        <a href="?inquiry=<?= rawurlencode(t('reviews.card3.title')) ?>#contact" class="review-link">
                            <?= t('common.get_quote') ?> →
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="contact">
            <div class="container">
                <h2><?= t('contact.title') ?></h2>
                <p class="contact-section-intro"><?= t('contact.subtitle') ?></p>
                
                <div class="contacts-grid">
                    <div class="contact-card">
                        <h3><?= t('contact.headquarters') ?></h3>
                        <p><?= t('contact.address') ?></p>
                        <p><?= t('contact.cbd') ?></p>
                    </div>
                    <div class="contact-card">
                        <h3><?= t('contact.phone') ?></h3>
                        <p><?= t('contact.phone1') ?></p>
                        <p><?= t('contact.phone2') ?></p>
                        <p><?= t('contact.phone3') ?></p>
                        <p><?= t('contact.phone4') ?></p>
                    </div>
                    <div class="contact-card">
                        <h3><?= t('contact.email') ?></h3>
                        <p><?= t('contact.email1') ?></p>
                        <p><?= t('contact.email2') ?></p>
                    </div>
                    <div class="contact-card">
                        <h3><?= t('contact.hours') ?></h3>
                        <p><?= t('contact.weekdays') ?></p>
                        <p><?= t('contact.saturday') ?></p>
                    </div>
                </div>

                <div class="contact-form-wrap">
                    <h3><?= t('contact.form.title') ?></h3>
                    <p id="inquiryContext" class="inquiry-note"></p>
                    <form id="contactForm" class="contact-form" method="post" action="contact-handler.php">
                        <input type="text" name="name" placeholder="<?= t('contact.form.name') ?>" required>
                        <input type="email" name="email" placeholder="<?= t('contact.form.email') ?>" required>
                        <input type="tel" name="phone" placeholder="<?= t('contact.form.phone') ?>">
                        <input type="text" id="contactSubject" name="subject" placeholder="<?= t('contact.form.subject') ?>" value="<?= htmlspecialchars($defaultInquirySubject, ENT_QUOTES, 'UTF-8') ?>" required>
                        <textarea name="message" placeholder="<?= t('contact.form.message') ?>" required></textarea>
                        <button type="submit" class="submit-btn"><?= t('contact.form.send') ?></button>
                    </form>
                </div>
            </div>
        </section>

        <section id="sister-brands">
            <div class="container">
                <h2><?= t('sister_brands.title') ?></h2>
                <div class="sister-brands-grid">
                    <article class="sister-brand-card">
                        <h3><?= t('sister_brands.namibia.title') ?></h3>
                        <p><?= t('sister_brands.namibia.description') ?></p>
                        <div class="sister-brand-actions">
                            <a href="https://www.thenamibiasafari.com/" target="_blank" rel="noopener" class="cta-button sister-brand-btn">
                                <?= t('sister_brands.visit_website') ?>
                            </a>
                            <a href="?inquiry=<?= rawurlencode('Namibia Safari Safari Expedition') ?>#contact" class="cta-button sister-brand-btn sister-brand-btn-secondary">
                                <?= t('sister_brands.inquire_now') ?>
                            </a>
                        </div>
                    </article>

                    <article class="sister-brand-card">
                        <h3><?= t('sister_brands.oceanus.title') ?></h3>
                        <p><?= t('sister_brands.oceanus.description') ?></p>
                        <div class="sister-brand-actions">
                            <a href="https://theoceanus.live/" target="_blank" rel="noopener" class="cta-button sister-brand-btn">
                                <?= t('sister_brands.visit_website') ?>
                            </a>
                            <a href="?inquiry=<?= rawurlencode('Oceanus Marine Adventure') ?>#contact" class="cta-button sister-brand-btn sister-brand-btn-secondary">
                                <?= t('sister_brands.inquire_now') ?>
                            </a>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Travel Angola. <?= t('footer.rights') ?>.</p>
            
            <!-- Language Switcher in Footer -->
            <div class="language-nav" style="margin-top: 1rem;">
                <?php include 'includes/flag-icon-language-switcher.php'; ?>
            </div>
        </div>
    </footer>

    <?php if ($showChristmasSpecial): ?>
        <div class="ta-special-popup" id="ta-special-popup" hidden>
            <div class="ta-special-popup__dialog" role="dialog" aria-modal="true" aria-labelledby="ta-special-popup-title">
                <button class="ta-special-popup__close" type="button" aria-label="<?= htmlspecialchars($special['close'], ENT_QUOTES, 'UTF-8') ?>">×</button>
                <img class="ta-special-popup__image" src="images/gal74.webp" alt="Oceanus pool and coastal accommodation at Baía das Pipas">
                <div class="ta-special-popup__copy">
                    <p class="ta-special-kicker"><?= htmlspecialchars($special['limited'], ENT_QUOTES, 'UTF-8') ?></p>
                    <h2 id="ta-special-popup-title"><?= htmlspecialchars($special['title'], ENT_QUOTES, 'UTF-8') ?></h2>
                    <p class="ta-special-popup__subtitle"><?= htmlspecialchars($special['popup_subtitle'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p class="ta-special-popup__date"><strong>19 Dec 2026 – 7 Jan 2027</strong><span><?= htmlspecialchars($special['duration'] . ' / ' . $special['nights'], ENT_QUOTES, 'UTF-8') ?></span></p>
                    <div class="ta-special-popup__prices">
                        <p><span><?= htmlspecialchars($special['camping'], ENT_QUOTES, 'UTF-8') ?></span><strong>N$6,876</strong><small><?= htmlspecialchars($special['per_person'], ENT_QUOTES, 'UTF-8') ?></small></p>
                        <p><span><?= htmlspecialchars($special['lodging'], ENT_QUOTES, 'UTF-8') ?></span><strong>N$21,114</strong><small><?= htmlspecialchars($special['sharing'], ENT_QUOTES, 'UTF-8') ?></small></p>
                    </div>
                    <p class="ta-special-popup__children"><?= htmlspecialchars($special['popup_children'], ENT_QUOTES, 'UTF-8') ?></p>
                    <div class="ta-special-popup__actions">
                        <a class="ta-special-button" href="<?= htmlspecialchars($specialInquiryUrl, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($special['request'], ENT_QUOTES, 'UTF-8') ?></a>
                        <a class="ta-special-button ta-special-button--outline" href="<?= htmlspecialchars($specialDetailsUrl, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($special['details'], ENT_QUOTES, 'UTF-8') ?></a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <script src="gallery.js"></script>
    <?php if ($showChristmasSpecial): ?><script src="special.js"></script><?php endif; ?>
    <script>
        const inquiryLabelPrefix = <?= json_encode(t('contact.form.inquiry_context', 'Inquiring about')) ?>;

        // Load gallery preview on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadGalleryPreview();
            initInteractiveMap();
            prefillInquiryForm();
        });

        function prefillInquiryForm() {
            const subjectField = document.getElementById('contactSubject');
            const inquiryContext = document.getElementById('inquiryContext');
            const urlParams = new URLSearchParams(window.location.search);
            const inquiry = urlParams.get('inquiry');

            if (!subjectField || !inquiry) {
                return;
            }

            const normalizedInquiry = inquiry.trim();
            if (normalizedInquiry) {
                subjectField.value = normalizedInquiry;
                if (inquiryContext) {
                    inquiryContext.textContent = `${inquiryLabelPrefix}: ${normalizedInquiry}`;
                }
                if (history.replaceState) {
                    urlParams.delete('inquiry');
                    const cleanQuery = urlParams.toString();
                    const cleanUrl = cleanQuery ? `${window.location.pathname}?${cleanQuery}#contact` : `${window.location.pathname}#contact`;
                    history.replaceState({}, document.title, cleanUrl);
                }
            }
        }

        // Gallery preview loader
        function loadGalleryPreview() {
            const galleryGrid = document.querySelector('.gallery-grid.gallery-preview');
            if (!galleryGrid) return;

            const previewImages = [
                'images/carosoul/1car.webp',
                'images/carosoul/2car.webp', 
                'images/carosoul/3car.webp',
                'images/carosoul/4car.webp',
                'images/carosoul/5car.webp',
                'images/carosoul/6car.webp',
                'images/carosoul/7car.webp',
                'images/carosoul/8car.webp'
            ];

            galleryGrid.innerHTML = '';

            previewImages.forEach((src, index) => {
                const item = document.createElement('div');
                item.className = 'gallery-item';

                const img = document.createElement('img');
                img.src = src;
                img.alt = `Angola Gallery ${index + 1}`;
                img.loading = 'lazy';
                img.addEventListener('click', () => {
                    window.location.href = 'gallery.php';
                });

                item.appendChild(img);
                galleryGrid.appendChild(item);
            });
        }

        // Interactive map initialization
        function initInteractiveMap() {
            const mapObject = document.getElementById('angola-map-object');
            const loadMapBtn = document.querySelector('.load-map-btn');
            const placeholder = document.getElementById('map-placeholder');
            const progressContainer = document.getElementById('map-progress');
            const progressFill = document.querySelector('.progress-fill');
            const progressText = document.querySelector('.progress-text');
            const mapStatusText = document.getElementById('map-status-text');

            if (!mapObject || !loadMapBtn || !placeholder || !progressContainer || !progressFill || !progressText) {
                return;
            }

            let listenersAttached = false;
            const DURATION_MS = 1500;

            function attachObjectInteractions() {
                if (listenersAttached) {
                    return;
                }

                const svgDoc = typeof mapObject.getSVGDocument === 'function'
                    ? mapObject.getSVGDocument()
                    : mapObject.contentDocument;

                if (!svgDoc || !svgDoc.documentElement) {
                    return;
                }

                attachListeners(svgDoc.documentElement);
                listenersAttached = true;
            }

            mapObject.addEventListener('load', attachObjectInteractions);

            function animateProgress(onDone) {
                const start = performance.now();

                function tick(now) {
                    const elapsed = now - start;
                    const progress = Math.min(100, (elapsed / DURATION_MS) * 100);

                    progressFill.style.width = progress.toFixed(2) + '%';
                    progressText.textContent = Math.round(progress) + '%';

                    if (progress < 100) {
                        requestAnimationFrame(tick);
                        return;
                    }

                    onDone();
                }

                requestAnimationFrame(tick);
            }

            loadMapBtn.addEventListener('click', function() {
                loadMapBtn.disabled = true;
                loadMapBtn.textContent = 'Loading...';
                progressContainer.style.display = 'block';
                progressContainer.setAttribute('aria-hidden', 'false');
                progressFill.style.width = '0%';
                progressText.textContent = '0%';

                if (mapStatusText) {
                    mapStatusText.textContent = <?= json_encode(t('map.loading_text', 'Loading interactive map...')) ?>;
                }

                animateProgress(function() {
                    placeholder.style.display = 'none';
                    mapObject.style.display = 'block';
                    attachObjectInteractions();
                });
            }, { once: true });
        }

        // Province data - using same structure as working HTML version
        const provinceData = {
            "Bengo": { capital: "Caxito", area: 31371, population: 497700, density: 15.86, region: "Greater Luanda" },
            "Benguela": { capital: "Benguela", area: 31788, population: 2749300, density: 86.48, region: "Central" },
            "Bié": { capital: "Cuíto", area: 70314, population: 1883100, density: 26.78, region: "Central" },
            "Cabinda": { capital: "Cabinda", area: 7290, population: 894300, density: 122.7, region: "North" },
            "Cuando Cubango": { capital: "Mavinga", area: null, population: 98419, density: null, region: "East" },
            "Cuangdo Cubango": { capital: "Menongue", area: null, population: 435583, density: null, region: "East" }, // fallback typo-safe key
            "Cuanza Norte": { capital: "N'dalatando", area: 24190, population: 443386, density: 18.3, region: "Greater Luanda" },
            "Cuanza Sul": { capital: "Sumbe", area: 55660, population: 1881873, density: 33.8, region: "Central" },
            "Cunene": { capital: "Ondjiva", area: 89342, population: 990087, density: 11.1, region: "South West" },
            "Huambo": { capital: "Huambo", area: 34274, population: 2019555, density: 58.9, region: "Central" },
            "Huíla": { capital: "Lubango", area: 75002, population: 2497422, density: 33.3, region: "South West" },
            "Icolo e Bengo": { capital: "Catete", area: null, population: null, density: null, region: "Greater Luanda" },
            "Luanda": { capital: "Luanda", area: 18283, population: 6945386, density: 379.9, region: "Greater Luanda" },
            "Lunda Norte": { capital: "Dundo", area: 102783, population: 862566, density: 8.4, region: "East" },
            "Lunda Sul": { capital: "Saurimo", area: 45649, population: 537587, density: 11.8, region: "East" },
            "Malanje": { capital: "Malanje", area: 97602, population: 986363, density: 10.1, region: "North" },
            "Moxico": { capital: "Luena", area: 223023, population: 758568, density: 3.4, region: "East" },
            "Moxico Leste": { capital: "Cazombo", area: 73141, population: 318582, density: null, region: "East" },
            "Namibe": { capital: "Moçâmedes", area: 58137, population: 495326, density: 8.5, region: "South West" },
            "Uíge": { capital: "Uíge", area: 58698, population: 1483118, density: 25.3, region: "North" },
            "Zaire": { capital: "M'banza-Kongo", area: 40130, population: 594428, density: 14.8, region: "North" }
        };
        
        // Function to setup province interactions
        // Map SVG element ID and data-province attributes to province names in our data
        const svgIdToProvince = {
            // By element ID
            'path1': 'Moxico Leste',
            'path2': 'Lunda Sul', 
            'path3': 'Lunda Norte',
            'path4': 'Malanje',
            'path5': 'Cuanza Norte',
            'path6': 'Huambo',
            'path7': 'Bié',
            'path8': 'Moxico',
            'path9': 'Cuando Cubango',
            'path10': 'Cuangdo Cubango', // Alternative spelling
            'path11': 'Cunene',
            'path12': 'Huíla',
            'path13': 'Namibe',
            'path14': 'Benguela',
            'path15': 'Cuanza Sul',
            'path16': 'Icolo e Bengo',
            'path17': 'Luanda',
            'path18': 'Bengo',
            'path19': 'Uíge',
            'path20': 'Zaire',
            'path21': 'Cabinda',
            
            // By data-province attribute (these should match exactly)
            'Moxico Leste': 'Moxico Leste',
            'Lunda Sul': 'Lunda Sul',
            'Lunda Norte': 'Lunda Norte',
            'Malanje': 'Malanje', 
            'Cuanza Norte': 'Cuanza Norte',
            'Huambo': 'Huambo',
            'Bié': 'Bié',
            'Moxico': 'Moxico',
            'Cuando Cubango': 'Cuando Cubango',
            'Cuangdo Cubango': 'Cuangdo Cubango',
            'Cunene': 'Cunene',
            'Huíla': 'Huíla',
            'Namibe': 'Namibe',
            'Benguela': 'Benguela',
            'Cuanza Sul': 'Cuanza Sul',
            'Icolo e Bengo': 'Icolo e Bengo',
            'Luanda': 'Luanda',
            'Bengo': 'Bengo',
            'Uíge': 'Uíge',
            'Zaire': 'Zaire',
            'Cabinda': 'Cabinda'
        };

        function attachListeners(svgRoot) {
            if (!svgRoot) {
                console.log('ERROR: No SVG root provided to attachListeners');
                return;
            }
            
            console.log('Attaching listeners to SVG root:', svgRoot.tagName);
            
            // Look for elements with data-province first, then fallback to paths with IDs
            const elementsWithProvince = svgRoot.querySelectorAll('[data-province]');
            const pathsWithIds = svgRoot.querySelectorAll('path[id], g[id]');
            
            console.log('Found', elementsWithProvince.length, 'elements with data-province');
            console.log('Found', pathsWithIds.length, 'paths/groups with IDs');
            
            // Combine all clickable elements
            const clickable = svgRoot.querySelectorAll('[data-province], path[id], g[id]');
            console.log('Total clickable elements:', clickable.length);
            
            clickable.forEach(function(el, index) {
                el.style.cursor = 'pointer';
                const dataProvince = el.getAttribute('data-province');
                const id = el.getAttribute('id');
                
                console.log('Element', index + ':', el.tagName, ', id=' + id, ', data-province=' + dataProvince);
                
                el.addEventListener('click', function(e) {
                    e.stopPropagation();
                    console.log('Clicked element:', el.tagName, 'with id=' + id, 'data-province=' + dataProvince);
                    
                    const rawId = dataProvince || id || '';
                    const provinceName = svgIdToProvince[rawId] || rawId;
                    
                    console.log('Raw ID:', rawId, ', Mapped province:', provinceName);
                    
                    if (!provinceName) {
                        console.log('No province name found for clicked element');
                        return;
                    }
                    
                    // Clear previous selections
                    clearSelections(svgRoot);
                    
                    // Add selection class and apply selection styles
                    el.classList.add('selected');
                    
                    // Ensure the CSS styles are applied by setting them directly as well
                    el.style.stroke = '#ff6b6b';
                    el.style.strokeWidth = '3';
                    el.style.strokeOpacity = '0.8';
                    el.style.filter = 'brightness(1.1) drop-shadow(0 0 8px rgba(255, 107, 107, 0.6))';
                    el.style.transition = 'all 0.3s ease';
                    
                    // Add a brief pulse effect
                    setTimeout(function() {
                        if (el.classList.contains('selected')) {
                            el.style.strokeWidth = '4';
                            setTimeout(function() {
                                if (el.classList.contains('selected')) {
                                    el.style.strokeWidth = '3';
                                }
                            }, 150);
                        }
                    }, 50);
                    
                    updatePanel(provinceName);
                });
                
                // Add hover effects
                el.addEventListener('mouseenter', function() {
                    if (!el.classList.contains('selected')) {
                        el.style.fill = '#e74c3c';
                        el.style.stroke = '#c0392b';
                        el.style.strokeWidth = '2';
                        el.style.opacity = '0.8';
                    }
                });
                
                el.addEventListener('mouseleave', function() {
                    if (!el.classList.contains('selected')) {
                        el.style.fill = '';
                        el.style.stroke = '';
                        el.style.strokeWidth = '';
                        el.style.opacity = '1';
                    }
                });
            });
        }

        function clearSelections(svgRoot) {
            if (!svgRoot) return;
            svgRoot.querySelectorAll('[data-province].selected, .province.selected, path.selected, g.selected').forEach(function(el) {
                el.classList.remove('selected');
                // Reset any inline styles that might have been applied
                el.style.stroke = '';
                el.style.strokeWidth = '';
                el.style.strokeOpacity = '';
                el.style.filter = '';
                el.style.fill = '';
                el.style.opacity = '';
            });
        }

        function updatePanel(provinceName) {
            console.log('Updating panel for:', provinceName);
            const data = provinceData[provinceName] || null;
            console.log('Province data found:', data);
            
            document.getElementById('panel-title').textContent = provinceName || 'Select a province';
            document.getElementById('stat-province').textContent = provinceName || '—';
            document.getElementById('stat-capital').textContent = data ? (data.capital || 'Unknown') : '—';
            
            // Format area with proper units
            const areaText = data && data.area != null ? data.area.toLocaleString() + ' km²' : '—';
            document.getElementById('stat-area').textContent = areaText;
            
            // Format population
            const populationText = data && data.population != null ? data.population.toLocaleString() : '—';
            document.getElementById('stat-population').textContent = populationText;
            
            // Format density with proper units
            const densityText = data && data.density != null ? data.density.toFixed(1) + ' hab/km²' : '—';
            document.getElementById('stat-density').textContent = densityText;
            
            document.getElementById('stat-region').textContent = data ? (data.region || 'Unknown') : '—';
        }

        function setupProvinceInteractions() {
            const mapContainer = document.getElementById('angola-map-object');
            if (!mapContainer || !mapContainer.contentDocument) {
                console.log('Map not loaded yet, retrying...');
                setTimeout(setupProvinceInteractions, 500);
                return;
            }
            
            const svgDoc = mapContainer.contentDocument;
            const svgRoot = svgDoc.documentElement;
            
            if (svgRoot && svgRoot.tagName && svgRoot.tagName.toLowerCase() === 'svg') {
                console.log('SUCCESS: SVG loaded, attaching listeners');
                attachListeners(svgRoot);
                console.log('Province interactions setup complete');
            } else {
                console.log('ERROR: SVG root not found or invalid');
            }
        }
        
        // Function to show province information (delegated to updatePanel)
        function showProvinceInfo(provinceId) {
            console.log('showProvinceInfo called with:', provinceId);
            updatePanel(provinceId);
        }

        // Contact form handling (if form exists)
        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const submitBtn = form.querySelector('.submit-btn');
            const originalText = submitBtn.textContent;
            
            submitBtn.textContent = '<?= __("contact.form.sending") ?>';
            submitBtn.disabled = true;
            
            // Create form data
            const formData = new FormData(form);
            
            // Send AJAX request
            fetch('contact-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(<?= json_encode(__("contact.form.success")) ?>);
                    form.reset();
                } else {
                    alert(<?= json_encode(__("contact.form.error")) ?>);
                }
            })
            .catch(error => {
                console.error('Contact form error:', error);
                alert(<?= json_encode(__("contact.form.error")) ?>);
            })
            .finally(() => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
            });
        }
    </script>

    <!-- Language system styles -->
    <style>
        .nav-language-switcher {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        
        .nav-language-switcher .language-switcher {
            transform: scale(0.9);
        }
        
        .footer-language .language-switcher {
            margin-top: 10px;
        }
        
        @media (max-width: 768px) {
            .nav-language-switcher {
                position: relative;
                top: auto;
                right: auto;
                margin-top: 15px;
                text-align: center;
            }
        }
    </style>
</body>
</html>
