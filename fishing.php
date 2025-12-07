<?php
// Initialize language system
require_once 'includes/language-config.php';
?>
<!DOCTYPE html>
<html lang="<?= getPageLanguage() ?>" dir="<?= getTextDirection() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= t('fishing.page.title') ?></title>
    <meta name="description" content="<?= t('fishing.page.description') ?>">
    <meta name="keywords" content="Angola, fishing, deep-sea fishing, Atlantic, tours, adventures">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="styles.css">
    <!-- Flag Icons CSS Library for language switcher -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    
    <style>
        /* Fishing page specific styles matching main site theme */
        .fishing-hero {
            background: linear-gradient(135deg, #2d5016 0%, #d4af37 100%);
            color: white;
            padding: 120px 0 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .fishing-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('images/fishing/fish1.webp') center/cover;
            opacity: 0.1;
            z-index: 0;
        }
        
        .fishing-hero .container {
            position: relative;
            z-index: 1;
        }
        
        .fishing-hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        .fishing-hero .subtitle {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .back-to-home {
            display: inline-block;
            margin-bottom: 2rem;
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 25px;
            backdrop-filter: blur(5px);
        }
        
        .back-to-home:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-5px);
            color: white;
        }
        
        /* Videos Section */
        .videos-section {
            padding: 80px 0;
            background: #f8f9fa;
        }
        
        .videos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .video-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .video-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .video-card video {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
        .video-card-content {
            padding: 1.5rem;
        }
        
        .video-card h3 {
            color: #2d5016;
            margin-bottom: 0.5rem;
            font-size: 1.3rem;
        }
        
        /* Fishing Gallery */
        .fishing-gallery {
            padding: 80px 0;
            background: white;
        }
        
        .fishing-gallery h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #2d5016;
        }
        
        .fishing-gallery .section-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 3rem;
        }
        
        .fishing-gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .fishing-gallery-item {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .fishing-gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
        
        .fishing-gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .fishing-gallery-item:hover img {
            transform: scale(1.05);
        }
        
        .fishing-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.7));
            color: white;
            padding: 1.5rem;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }
        
        .fishing-gallery-item:hover .fishing-overlay {
            transform: translateY(0);
        }
        
        /* Language switcher for fishing page */
        .fishing-language-nav {
            text-align: center;
            margin-top: 2rem;
        }
        
        /* Lightbox Modal Styles */
        .lightbox-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .lightbox-modal.active {
            opacity: 1;
            visibility: visible;
        }
        
        .lightbox-content {
            position: relative;
            max-width: 90vw;
            max-height: 90vh;
        }
        
        .lightbox-content img {
            width: 100%;
            height: 100%;
            max-width: 90vw;
            max-height: 90vh;
            object-fit: contain;
            border-radius: 10px;
        }
        
        .lightbox-close {
            position: absolute;
            top: -40px;
            right: -10px;
            background: none;
            border: none;
            color: white;
            font-size: 30px;
            cursor: pointer;
            padding: 10px;
            line-height: 1;
            transition: all 0.3s ease;
        }
        
        .lightbox-close:hover {
            color: #d4af37;
            transform: scale(1.1);
        }
        
        .lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 24px;
            padding: 15px 20px;
            cursor: pointer;
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        
        .lightbox-nav:hover {
            background: rgba(212, 175, 55, 0.3);
            color: #d4af37;
        }
        
        .lightbox-prev {
            left: -60px;
        }
        
        .lightbox-next {
            right: -60px;
        }
        
        .lightbox-counter {
            position: absolute;
            bottom: -40px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 14px;
            background: rgba(0, 0, 0, 0.5);
            padding: 8px 16px;
            border-radius: 20px;
        }
        
        /* Responsive design */
        @media (max-width: 768px) {
            .fishing-hero h1 {
                font-size: 2.5rem;
            }
            
            .fishing-hero .subtitle {
                font-size: 1.1rem;
            }
            
            .videos-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .fishing-gallery-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 1rem;
            }
            
            .videos-section,
            .fishing-gallery {
                padding: 60px 0;
            }
            
            /* Lightbox responsive */
            .lightbox-nav {
                font-size: 18px;
                padding: 10px 15px;
            }
            
            .lightbox-prev {
                left: -40px;
            }
            
            .lightbox-next {
                right: -40px;
            }
            
            .lightbox-close {
                top: -30px;
                right: 0;
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <!-- Fishing Hero Section -->
    <section class="fishing-hero">
        <div class="container">
            <a href="index.php" class="back-to-home"><?= t('fishing.back_home') ?></a>
            <h1><?= t('fishing.title') ?></h1>
            <p class="subtitle"><?= t('fishing.subtitle') ?></p>
            
            <!-- Language Switcher -->
            <div class="fishing-language-nav">
                <?php include 'includes/flag-icon-language-switcher.php'; ?>
            </div>
        </div>
    </section>

    <!-- Videos Section -->
    <section class="videos-section">
        <div class="container">
            <h2><?= t('fishing.videos.title') ?></h2>
            <p class="section-subtitle"><?= t('fishing.videos.subtitle') ?></p>
            
            <div class="videos-grid">
                <!-- Video 1 - Amberjacks -->
                <div class="video-card">
                    <video controls poster="images/fishing/fish1.webp">
                        <source src="images/fishing/vid/amberjacks.mp4" type="video/mp4">
                        <?= getCurrentLanguage() === 'pt' ? 'Seu navegador não suporta o elemento de vídeo.' : 
                            (getCurrentLanguage() === 'fr' ? 'Votre navigateur ne prend pas en charge l\'élément vidéo.' : 
                            (getCurrentLanguage() === 'es' ? 'Tu navegador no soporta el elemento de video.' : 
                            'Your browser does not support the video element.')) ?>
                    </video>
                    <div class="video-card-content">
                        <h3><?= t('fishing.video1.title') ?></h3>
                    </div>
                </div>

                <!-- Video 2 - Boat Amber Fillet -->
                <div class="video-card">
                    <video controls poster="images/fishing/fish5.webp">
                        <source src="images/fishing/vid/BoatAmberFillet.mp4" type="video/mp4">
                        <?= getCurrentLanguage() === 'pt' ? 'Seu navegador não suporta o elemento de vídeo.' : 
                            (getCurrentLanguage() === 'fr' ? 'Votre navigateur ne prend pas en charge l\'élément vidéo.' : 
                            (getCurrentLanguage() === 'es' ? 'Tu navegador no soporta el elemento de video.' : 
                            'Your browser does not support the video element.')) ?>
                    </video>
                    <div class="video-card-content">
                        <h3><?= t('fishing.video2.title') ?></h3>
                    </div>
                </div>

                <!-- Video 3 - Advertisement -->
                <div class="video-card">
                    <video controls poster="images/fishing/fish10.webp">
                        <source src="images/fishing/vid/AdvertJohanJaco.mp4" type="video/mp4">
                        <?= getCurrentLanguage() === 'pt' ? 'Seu navegador não suporta o elemento de vídeo.' : 
                            (getCurrentLanguage() === 'fr' ? 'Votre navigateur ne prend pas en charge l\'élément vidéo.' : 
                            (getCurrentLanguage() === 'es' ? 'Tu navegador no soporta el elemento de video.' : 
                            'Your browser does not support the video element.')) ?>
                    </video>
                    <div class="video-card-content">
                        <h3><?= t('fishing.video3.title') ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fishing Gallery Section -->
    <section class="fishing-gallery">
        <div class="container">
            <h2><?= t('fishing.gallery.title') ?></h2>
            <p class="section-subtitle"><?= t('fishing.gallery.subtitle') ?></p>
            
            <div class="fishing-gallery-grid" id="fishingGalleryGrid">
                <!-- Gallery items will be loaded dynamically -->
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

    <footer>
        <div class="container">
            <p>&copy; 2025 Travel Angola. <?= t('footer.rights') ?>.</p>
            
            <!-- Language Switcher in Footer -->
            <div class="language-nav" style="margin-top: 1rem;">
                <?php include 'includes/flag-icon-language-switcher.php'; ?>
            </div>
        </div>
    </footer>

    <script>
        // Load fishing gallery on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadFishingGallery();
        });

        function loadFishingGallery() {
            const galleryGrid = document.getElementById('fishingGalleryGrid');
            if (!galleryGrid) return;

            // All fishing images from fish1.webp to fish26.webp
            const fishingImages = [];
            for (let i = 1; i <= 26; i++) {
                fishingImages.push(`images/fishing/fish${i}.webp`);
            }

            fishingImages.forEach((src, index) => {
                const galleryItem = document.createElement('div');
                galleryItem.className = 'fishing-gallery-item';
                
                const img = document.createElement('img');
                img.src = src;
                img.alt = `<?= getCurrentLanguage() === 'pt' ? 'Pesca' : 
                    (getCurrentLanguage() === 'fr' ? 'Pêche' : 
                    (getCurrentLanguage() === 'es' ? 'Pesca' : 
                    'Fishing')) ?> ${index + 1}`;
                img.loading = 'lazy';
                
                const overlay = document.createElement('div');
                overlay.className = 'fishing-overlay';
                overlay.innerHTML = `<p><?= getCurrentLanguage() === 'pt' ? 'Aventura de Pesca' : 
                    (getCurrentLanguage() === 'fr' ? 'Aventure de Pêche' : 
                    (getCurrentLanguage() === 'es' ? 'Aventura de Pesca' : 
                    'Fishing Adventure')) ?> ${index + 1}</p>`;
                
                galleryItem.appendChild(img);
                galleryItem.appendChild(overlay);
                galleryGrid.appendChild(galleryItem);

                // Add click handler for potential lightbox functionality
                galleryItem.addEventListener('click', () => {
                    // Could add lightbox functionality here
                    console.log('Clicked fishing image:', src);
                });
            });
        }

        // Enhanced language switcher styles for fishing page
        document.addEventListener('DOMContentLoaded', function() {
            const style = document.createElement('style');
            style.textContent = `
                .fishing-language-nav .flag-icon-language-switcher {
                    display: flex;
                    gap: 15px;
                    justify-content: center;
                    align-items: center;
                }

                .fishing-language-nav .flag-lang-option,
                .fishing-language-nav .current-flag-lang {
                    display: flex !important;
                    align-items: center !important;
                    gap: 8px !important;
                    padding: 8px 15px !important;
                    text-decoration: none !important;
                    border-radius: 25px !important;
                    background: rgba(255, 255, 255, 0.2) !important;
                    border: 2px solid transparent !important;
                    transition: all 0.3s ease !important;
                    font-weight: 500 !important;
                    font-size: 14px !important;
                    color: white !important;
                    backdrop-filter: blur(5px) !important;
                }

                .fishing-language-nav .flag-lang-option:hover {
                    background: rgba(255, 255, 255, 0.3) !important;
                    border-color: #d4af37 !important;
                    transform: translateY(-2px) !important;
                    color: white !important;
                }

                .fishing-language-nav .current-flag-lang {
                    background: rgba(212, 175, 55, 0.9) !important;
                    color: white !important;
                    border-color: #d4af37 !important;
                }

                .fishing-language-nav .fi {
                    width: 20px !important;
                    height: 15px !important;
                    border-radius: 3px !important;
                }

                .fishing-language-nav .lang-label {
                    text-transform: uppercase !important;
                    font-size: 12px !important;
                    font-weight: 600 !important;
                    letter-spacing: 0.5px !important;
                }

                .language-nav .flag-icon-language-switcher {
                    display: flex;
                    gap: 15px;
                    justify-content: center;
                    align-items: center;
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

                @media (max-width: 768px) {
                    .fishing-language-nav .flag-icon-language-switcher,
                    .language-nav .flag-icon-language-switcher {
                        flex-wrap: wrap;
                        gap: 10px;
                    }
                }
            `;
            document.head.appendChild(style);
        });

        // Lightbox functionality for fishing gallery
        document.addEventListener('DOMContentLoaded', function() {
            const galleryItems = document.querySelectorAll('.fishing-gallery-item');
            const body = document.body;

            // Create lightbox modal HTML
            const lightboxHTML = `
                <div id="fishing-lightbox" class="lightbox-modal">
                    <div class="lightbox-content">
                        <button class="lightbox-close" onclick="closeFishingLightbox()">&times;</button>
                        <button class="lightbox-nav lightbox-prev" onclick="changeFishingLightboxImage(-1)">&lsaquo;</button>
                        <img id="fishing-lightbox-img" src="" alt="">
                        <button class="lightbox-nav lightbox-next" onclick="changeFishingLightboxImage(1)">&rsaquo;</button>
                        <div class="lightbox-counter">
                            <span id="fishing-current-image">1</span> / <span id="fishing-total-images">${galleryItems.length}</span>
                        </div>
                    </div>
                </div>
            `;

            body.insertAdjacentHTML('beforeend', lightboxHTML);

            const lightbox = document.getElementById('fishing-lightbox');
            const lightboxImg = document.getElementById('fishing-lightbox-img');
            const currentImageSpan = document.getElementById('fishing-current-image');
            let currentImageIndex = 0;

            // Add click handlers to gallery items
            galleryItems.forEach((item, index) => {
                item.addEventListener('click', function() {
                    currentImageIndex = index;
                    const img = this.querySelector('img');
                    lightboxImg.src = img.src;
                    lightboxImg.alt = img.alt;
                    currentImageSpan.textContent = index + 1;
                    lightbox.classList.add('active');
                    body.style.overflow = 'hidden';
                });
            });

            // Global functions for lightbox navigation
            window.closeFishingLightbox = function() {
                lightbox.classList.remove('active');
                body.style.overflow = 'auto';
            };

            window.changeFishingLightboxImage = function(direction) {
                currentImageIndex += direction;
                
                if (currentImageIndex >= galleryItems.length) {
                    currentImageIndex = 0;
                } else if (currentImageIndex < 0) {
                    currentImageIndex = galleryItems.length - 1;
                }
                
                const img = galleryItems[currentImageIndex].querySelector('img');
                lightboxImg.src = img.src;
                lightboxImg.alt = img.alt;
                currentImageSpan.textContent = currentImageIndex + 1;
            };

            // Close lightbox when clicking outside image
            lightbox.addEventListener('click', function(e) {
                if (e.target === lightbox) {
                    closeFishingLightbox();
                }
            });

            // Close lightbox with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && lightbox.classList.contains('active')) {
                    closeFishingLightbox();
                }
                if (lightbox.classList.contains('active')) {
                    if (e.key === 'ArrowRight') {
                        changeFishingLightboxImage(1);
                    } else if (e.key === 'ArrowLeft') {
                        changeFishingLightboxImage(-1);
                    }
                }
            });
        });
    </script>
</body>
</html>