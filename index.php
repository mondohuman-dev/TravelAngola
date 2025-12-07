<?php
// Initialize language system
require_once 'includes/language-config.php';
?>
<!DOCTYPE html>
<html lang="<?= getPageLanguage() ?>" dir="<?= getTextDirection() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= __('meta.home.title') ?></title>
    <meta name="description" content="<?= __('meta.home.description') ?>">
    <meta name="keywords" content="<?= __('page.keywords') ?>">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="styles.css">
    <!-- Flag Icons CSS Library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>
    <header class="hero">
        <nav>
            <div class="logo">
                <img src="images/logo_sm.webp" alt="Travel Angola Logo" class="logo-img">
                <span class="logo-text">Travel Angola</span>
            </div>
            <ul class="nav-links">
                <li><a href="#about"><?= __('nav.about') ?></a></li>
                <li><a href="#destinations"><?= __('nav.destinations') ?></a></li>
                <li><a href="#activities"><?= __('nav.activities') ?></a></li>
                <li><a href="gallery.php"><?= __('nav.gallery') ?></a></li>
                <li><a href="#reviews"><?= __('nav.reviews') ?></a></li>
                <li><a href="#contact"><?= __('nav.contact') ?></a></li>
            </ul>
        </nav>
        <div class="hero-content">
            <h1><?= t('hero.title') ?></h1>
            <p><?= t('hero.subtitle') ?></p>
            <a href="#contact" class="cta-button"><?= t('hero.cta') ?></a>
            
            <!-- Language Switcher in Header -->
            <div class="language-nav">
                <?php include 'includes/flag-icon-language-switcher.php'; ?>
            </div>
            <!-- Carousel start -->
            <div class="hero-carousel" aria-roledescription="carousel" aria-label="Hero images carousel">
                <div class="hc-slides" role="list"></div>

                <button class="hc-btn hc-prev" aria-label="Previous slide">&lsaquo;</button>
                <button class="hc-btn hc-next" aria-label="Next slide">&rsaquo;</button>

                <div class="hc-indicators" role="tablist" aria-label="Slide indicators"></div>
            </div>

            <style>
            /* Minimal hero carousel styles (tweak in styles.css if preferred) */
            .hero-carousel{position:relative;width:100%;max-width:1100px;margin:1.25rem auto;overflow:hidden;border-radius:12px}
            .hc-slides{display:flex;transition:transform 0.6s ease;will-change:transform}
            .hc-slide{min-width:100%;box-sizing:border-box;display:flex;align-items:center;justify-content:center;background:#111;background-size:cover;background-position:center;height:320px}
            .hc-slide img{width:100%;height:100%;object-fit:cover;display:block}
            .hc-btn{position:absolute;top:50%;transform:translateY(-50%);background:rgba(0,0,0,0.45);border:0;color:#fff;padding:10px 14px;border-radius:6px;cursor:pointer;font-size:22px}
            .hc-prev{left:12px} .hc-next{right:12px}
            .hc-indicators{position:absolute;left:50%;transform:translateX(-50%);bottom:10px;display:flex;gap:8px}
            .hc-indicators button{width:10px;height:10px;border-radius:50%;border:0;background:rgba(255,255,255,0.45);cursor:pointer}
            .hc-indicators button[aria-selected="true"]{background:#ff6b6b;box-shadow:0 0 6px rgba(255,107,107,0.6)}
            /* Small screens */
            @media(min-width:900px){ .hero-carousel .hc-slide{height:420px} }
            
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
                .language-nav {
                    flex-wrap: wrap;
                    gap: 10px;
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
                // Edit this list to match files inside images/carosoul
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

                // Find the carousel container more reliably
                const root = document.querySelector('.hero-carousel');
                if (!root) {
                    console.error('Carousel container not found!');
                    return;
                }
                const slidesEl = root.querySelector('.hc-slides');
                const indicatorsEl = root.querySelector('.hc-indicators');
                const prevBtn = root.querySelector('.hc-prev');
                const nextBtn = root.querySelector('.hc-next');

                let index = 0;
                let timer = null;
                const AUTOPLAY_MS = 4500;

                // Build slides & indicators
                slides.forEach((src, i) => {
                    const slide = document.createElement('div');
                    slide.className = 'hc-slide';
                    slide.setAttribute('role','listitem');
                    // use <img> for accessibility & lazy loading
                    const img = document.createElement('img');
                    img.src = src;
                    img.alt = `Angola Landscape ${i + 1}`;
                    img.loading = i === 0 ? 'eager' : 'lazy';
                    slide.appendChild(img);
                    slidesEl.appendChild(slide);

                    const btn = document.createElement('button');
                    btn.setAttribute('role', 'tab');
                    btn.setAttribute('aria-label', `Go to slide ${i + 1}`);
                    if (i === 0) btn.setAttribute('aria-selected', 'true');
                    btn.addEventListener('click', () => goTo(i));
                    indicatorsEl.appendChild(btn);
                });

                function goTo(newIndex) {
                    if (newIndex === index) return;
                    
                    // Update indicators
                    indicatorsEl.children[index].removeAttribute('aria-selected');
                    indicatorsEl.children[newIndex].setAttribute('aria-selected', 'true');
                    
                    index = newIndex;
                    slidesEl.style.transform = `translateX(-${index * 100}%)`;
                    
                    resetAutoplay();
                }

                function next() {
                    goTo((index + 1) % slides.length);
                }

                function prev() {
                    goTo((index - 1 + slides.length) % slides.length);
                }

                function resetAutoplay() {
                    if (timer) clearInterval(timer);
                    timer = setInterval(next, AUTOPLAY_MS);
                }

                // Event listeners
                if (prevBtn) prevBtn.addEventListener('click', prev);
                if (nextBtn) nextBtn.addEventListener('click', next);

                // Start autoplay
                resetAutoplay();

                // Pause on hover
                root.addEventListener('mouseenter', () => {
                    if (timer) clearInterval(timer);
                });
                root.addEventListener('mouseleave', resetAutoplay);
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
                        <!-- Map placeholder for lazy loading -->
                        <div id="map-placeholder" class="map-placeholder">
                            <div class="placeholder-content">
                                <div class="map-icon">🗺️</div>
                                <h3><?= t('map.title') ?></h3>
                                <p id="map-status-text"><?= t('map.description') ?></p>
                                <div id="map-progress" class="progress-container" style="display: none;">
                                    <div class="progress-bar">
                                        <div class="progress-fill"></div>
                                    </div>
                                    <div class="progress-text">0%</div>
                                </div>
                                <button class="load-map-btn"><?= t('map.load') ?></button>
                            </div>
                        </div>
                        <!-- If you prefer inline SVG, replace the <object> with the SVG markup and keep id="angola-map" on the root <svg> -->
                        <object id="angola-map-object" type="image/svg+xml" data="" aria-label="Angola provinces map" style="display: none;"></object>
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
                    </div>
                    <div class="activity-card">
                        <h3><?= t('activities.safari.title') ?></h3>
                        <p><?= t('activities.safari.desc') ?></p>
                    </div>
                    <div class="activity-card">
                        <h3><?= t('activities.culture.title') ?></h3>
                        <p><?= t('activities.culture.desc') ?></p>
                    </div>
                    <div class="activity-card">
                        <h3><?= t('activities.hiking.title') ?></h3>
                        <p><?= t('activities.hiking.desc') ?></p>
                    </div>
                    <div class="activity-card">
                        <h3><?= t('activities.city.title') ?></h3>
                        <p><?= t('activities.city.desc') ?></p>
                    </div>
                    <div class="activity-card">
                        <h3><?= t('activities.photo.title') ?></h3>
                        <p><?= t('activities.photo.desc') ?></p>
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
                        <a href="https://sheroamstheglobe.com/travel-namibia-4x4-review/" 
                           class="review-link" 
                           target="_blank" 
                           rel="noopener noreferrer">
                            <?= t('reviews.read_full') ?> →
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
                        <a href="#" 
                           class="review-link" 
                           onclick="alert('<?= getCurrentLanguage() === 'pt' ? 'Mais detalhes em breve!' : (getCurrentLanguage() === 'fr' ? 'Plus de détails bientôt!' : (getCurrentLanguage() === 'es' ? '¡Más detalles pronto!' : 'More details coming soon!')) ?>')">
                            <?= t('reviews.read_full') ?> →
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
                        <a href="#" 
                           class="review-link" 
                           onclick="alert('<?= getCurrentLanguage() === 'pt' ? 'Mais detalhes em breve!' : (getCurrentLanguage() === 'fr' ? 'Plus de détails bientôt!' : (getCurrentLanguage() === 'es' ? '¡Más detalles pronto!' : 'More details coming soon!')) ?>')">
                            <?= t('reviews.read_full') ?> →
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="contact">
            <div class="container">
                <h2><?= t('contact.title') ?></h2>
                
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

    <script src="gallery.js"></script>
    <script>
        // Load gallery preview on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadGalleryPreview();
            initInteractiveMap();
        });

        // Gallery preview loader
        function loadGalleryPreview() {
            const galleryGrid = document.querySelector('.gallery-preview .gallery-grid');
            if (!galleryGrid) return;

            const previewImages = [
                'images/carosoul/1car.webp',
                'images/carosoul/2car.webp', 
                'images/carosoul/3car.webp',
                'images/carosoul/4car.webp',
                'images/carosoul/5car.webp',
                'images/carosoul/6car.webp'
            ];

            previewImages.forEach((src, index) => {
                const img = document.createElement('img');
                img.src = src;
                img.alt = `Angola Gallery ${index + 1}`;
                img.loading = 'lazy';
                img.addEventListener('click', () => {
                    window.location.href = 'gallery.php';
                });
                galleryGrid.appendChild(img);
            });
        }

        // Interactive map initialization
        function initInteractiveMap() {
            const mapContainer = document.getElementById('angola-map-object');
            const loadMapBtn = document.querySelector('.load-map-btn');
            
            if (loadMapBtn) {
                loadMapBtn.addEventListener('click', loadAngolaMap);
            }
        }

        function loadAngolaMap() {
            console.log('Loading Angola map...');
            
            const placeholder = document.getElementById('map-placeholder');
            const loadMapBtn = document.querySelector('.load-map-btn');
            const mapContainer = document.getElementById('angola-map-object');
            const progressContainer = document.getElementById('map-progress');
            const progressFill = document.querySelector('.progress-fill');
            const progressText = document.querySelector('.progress-text');
            const mapStatusText = document.getElementById('map-status-text');
            
            if (loadMapBtn) {
                loadMapBtn.textContent = <?= json_encode(t("map.loading")) ?>;
                loadMapBtn.disabled = true;
            }

            // Show progress indicator
            if (progressContainer) {
                progressContainer.style.display = 'block';
            }
            
            if (mapStatusText) {
                mapStatusText.textContent = <?= json_encode(t("map.loading_text")) ?>;
            }
            
            if (placeholder) {
                placeholder.style.opacity = '0.8';
                placeholder.style.pointerEvents = 'none';
            }

            // Start progress animation
            let progress = 0;
            const progressInterval = setInterval(() => {
                progress += Math.random() * 15 + 5; // Random progress increments
                if (progress > 90) progress = 90; // Cap at 90% until actual loading completes
                
                if (progressFill) progressFill.style.width = progress + '%';
                if (progressText) progressText.textContent = Math.round(progress) + '%';
            }, 200);
            
            // Set the SVG data source
            if (mapContainer) {
                mapContainer.data = 'images/AngolaMap.svg';
            }
            
            // Wait a moment for the browser to process the data attribute
            setTimeout(() => {
                // Multiple fallback methods to initialize
                let initialized = false;
                let attempts = 0;
                
                function tryInitialize() {
                    attempts++;
                    console.log(`Initialization attempt ${attempts}`);
                    
                    try {
                        console.log('Checking mapContainer.contentDocument:', !!mapContainer.contentDocument);
                        console.log('Checking mapContainer.data:', mapContainer.data);
                        
                        // Method 1: Try contentDocument
                        if (mapContainer.contentDocument && mapContainer.contentDocument.documentElement) {
                            const svgRoot = mapContainer.contentDocument.documentElement;
                            console.log('SVG root found, tagName:', svgRoot.tagName);
                            
                            if (svgRoot.tagName && svgRoot.tagName.toLowerCase() === 'svg') {
                                console.log('SUCCESS: SVG loaded via contentDocument');
                                
                                // Complete progress
                                clearInterval(progressInterval);
                                if (progressFill) progressFill.style.width = '100%';
                                if (progressText) progressText.textContent = '100%';
                                
                                setTimeout(() => {
                                    if (placeholder) placeholder.style.display = 'none';
                                    if (mapContainer) mapContainer.style.display = 'block';
                                    attachListeners(svgRoot);
                                    console.log('Map initialization complete!');
                                }, 500);
                                
                                initialized = true;
                                return true;
                            } else {
                                console.log('Root element is not SVG, tagName:', svgRoot.tagName);
                            }
                        } else {
                            console.log('contentDocument not available yet');
                        }
                        
                        // Method 2: Try getSVGDocument (for some browsers)
                        if (typeof mapContainer.getSVGDocument === 'function') {
                            const svgDoc = mapContainer.getSVGDocument();
                            if (svgDoc && svgDoc.documentElement) {
                                console.log('SUCCESS: SVG loaded via getSVGDocument');
                                
                                // Complete progress
                                clearInterval(progressInterval);
                                if (progressFill) progressFill.style.width = '100%';
                                if (progressText) progressText.textContent = '100%';
                                
                                setTimeout(() => {
                                    if (placeholder) placeholder.style.display = 'none';
                                    if (mapContainer) mapContainer.style.display = 'block';
                                    attachListeners(svgDoc.documentElement);
                                }, 500);
                                
                                initialized = true;
                                return true;
                            }
                        }
                    } catch (error) {
                        console.log('Error during initialization attempt:', error.message);
                    }
                    
                    return false;
                }
                
                // Try immediate initialization
                if (tryInitialize()) return;
                
                // Set up load event listener
                if (mapContainer) {
                    mapContainer.addEventListener('load', function() {
                        console.log('Object load event fired');
                        if (!initialized) {
                            setTimeout(() => {
                                if (tryInitialize()) return;
                            }, 100);
                        }
                    });
                }
                
                // Polling fallback with more attempts
                const pollInterval = setInterval(() => {
                    if (initialized || tryInitialize()) {
                        clearInterval(pollInterval);
                        return;
                    }
                    
                    if (attempts > 50) { // 25 seconds total - more lenient
                        console.log('TIMEOUT: Failed to initialize SVG after 50 attempts');
                        clearInterval(pollInterval);
                        clearInterval(progressInterval);
                        
                        // Try fallback: load SVG inline using fetch
                        console.log('Trying fallback: loading SVG inline');
                        loadMapInline();
                        if (placeholder) {
                            placeholder.style.opacity = '1';
                            placeholder.style.pointerEvents = 'auto';
                        }
                    }
                }, 500);
                
            }, 100);
        }

        // Fallback: Load SVG inline using fetch
        function loadMapInline() {
            console.log('Loading SVG inline as fallback...');
            const mapContainer = document.getElementById('angola-map-object');
            const placeholder = document.getElementById('map-placeholder');
            const loadMapBtn = document.querySelector('.load-map-btn');
            const mapStatusText = document.getElementById('map-status-text');
            const progressFill = document.querySelector('.progress-fill');
            const progressText = document.querySelector('.progress-text');
            const progressContainer = document.getElementById('map-progress');
            
            if (mapStatusText) {
                mapStatusText.textContent = 'Loading map (fallback method)...';
            }
            
            fetch('images/AngolaMap.svg')
                .then(response => {
                    console.log('Fetch response status:', response.status);
                    if (!response.ok) {
                        throw new Error('Failed to load SVG: ' + response.status);
                    }
                    return response.text();
                })
                .then(svgContent => {
                    console.log('SVG content loaded via fetch');
                    
                    // Complete progress
                    if (progressFill) progressFill.style.width = '100%';
                    if (progressText) progressText.textContent = '100%';
                    
                    setTimeout(() => {
                        // Create a container for the inline SVG
                        const svgContainer = document.createElement('div');
                        svgContainer.innerHTML = svgContent;
                        svgContainer.style.width = '100%';
                        svgContainer.style.height = '100%';
                        
                        const svgElement = svgContainer.querySelector('svg');
                        if (svgElement) {
                            svgElement.id = 'angola-map';
                            svgElement.style.width = '100%';
                            svgElement.style.height = '100%';
                            
                            // Hide object and placeholder, show inline SVG
                            if (mapContainer) mapContainer.style.display = 'none';
                            if (placeholder) placeholder.style.display = 'none';
                            
                            // Insert SVG after the object element
                            if (mapContainer) {
                                mapContainer.parentNode.insertBefore(svgContainer, mapContainer.nextSibling);
                            }
                            
                            // Initialize interactivity
                            attachListeners(svgElement);
                            console.log('Inline SVG fallback successful');
                        } else {
                            throw new Error('No SVG element found in fetched content');
                        }
                    }, 500);
                })
                .catch(error => {
                    console.log('Fallback failed:', error.message);
                    
                    // Reset progress and show retry button
                    if (progressContainer) progressContainer.style.display = 'none';
                    if (mapStatusText) mapStatusText.textContent = <?= json_encode(t("map.error")) ?>;
                    if (loadMapBtn) {
                        loadMapBtn.textContent = <?= json_encode(t("map.retry")) ?>;
                        loadMapBtn.disabled = false;
                    }
                    if (placeholder) {
                        placeholder.style.opacity = '1';
                        placeholder.style.pointerEvents = 'auto';
                    }
                });
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