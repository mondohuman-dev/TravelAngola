<?php
// Initialize language system
require_once 'includes/language-config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= getCurrentLanguage() === 'pt' ? 'Galeria de Fotos - Travel Angola' : (getCurrentLanguage() === 'fr' ? 'Galerie de Photos - Travel Angola' : (getCurrentLanguage() === 'es' ? 'Galería de Fotos - Travel Angola' : 'Photo Gallery - Travel Angola')) ?></title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="styles.css">
    <!-- Flag Icons CSS Library for language switcher -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        /* Gallery page specific styles matching index.php hero layout */
        .gallery-hero {
            height: 60vh !important;
            background: linear-gradient(135deg, #2d5016 0%, #d4af37 100%) !important;
            background-size: cover !important;
            background-position: center !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
            color: white !important;
            padding-top: 80px !important;
        }
        
        .gallery-hero .hero-content {
            max-width: 800px !important;
            padding: 0 20px !important;
        }
        
        .gallery-hero h1 {
            font-size: 4rem !important;
            margin-bottom: 1rem !important;
            color: white !important;
            font-family: 'Playfair Display', serif !important;
        }
        
        .gallery-hero p {
            font-size: 1.5rem !important;
            margin-bottom: 2rem !important;
            color: white !important;
        }
        

        .gallery-stats {
            text-align: center !important;
            padding: 2rem 0 !important;
            background: #f8f9fa !important;
        }
        .gallery-section {
            padding: 3rem 0 !important;
        }
        .gallery-grid {
            display: grid !important;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)) !important;
            gap: 30px !important;
            padding: 2rem 0 !important;
            max-width: 1200px !important;
            margin: 0 auto !important;
        }
        .gallery-item {
            aspect-ratio: 4/3 !important;
            overflow: hidden !important;
            border-radius: 15px !important;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
            transition: all 0.3s ease !important;
            cursor: pointer !important;
        }
        .gallery-item:hover {
            transform: translateY(-8px) !important;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2) !important;
        }
        .gallery-item img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            transition: transform 0.3s ease !important;
            display: block !important;
        }
        .gallery-item:hover img {
            transform: scale(1.05) !important;
        }

        /* Lightbox Styles */
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
            z-index: 1000;
            opacity: 0;
            animation: fadeIn 0.3s forwards;
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }

        .lightbox-content {
            position: relative;
            max-width: 90vw;
            max-height: 90vh;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .lightbox-content img {
            width: auto;
            height: auto;
            max-width: 100%;
            max-height: 100%;
            border-radius: 8px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .lightbox-close {
            position: absolute;
            top: -40px;
            right: 0;
            color: white;
            font-size: 2rem;
            cursor: pointer;
            background: none;
            border: none;
            padding: 5px;
            line-height: 1;
        }

        .lightbox-close:hover {
            opacity: 0.7;
        }

        .lightbox-caption {
            text-align: center;
            color: white;
            margin-top: 1rem;
            font-size: 1.1rem;
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

        /* Contact Section Styles */
        .contact {
            background-color: #f8f9fa !important;
            padding: 5rem 0 !important;
        }
        
        .contact h2 {
            text-align: center !important;
            font-size: 2.5rem !important;
            color: #2d5016 !important;
            margin-bottom: 3rem !important;
            font-family: 'Playfair Display', serif !important;
        }
        
        .contacts-grid {
            display: grid !important;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)) !important;
            gap: 2rem !important;
            margin-top: 2rem !important;
        }
        
        .contact-card {
            background: white !important;
            padding: 2rem !important;
            border-radius: 10px !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
            text-align: center !important;
            transition: transform 0.3s ease !important;
        }
        
        .contact-card:hover {
            transform: translateY(-5px) !important;
        }
        
        .contact-card h3 {
            color: #2d5016 !important;
            margin-bottom: 1rem !important;
            font-size: 1.3rem !important;
        }
        
        .contact-card p {
            color: #4a5568 !important;
            margin-bottom: 0.5rem !important;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .gallery-header h1 {
                font-size: 2rem !important;
            }
            
            .gallery-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)) !important;
                gap: 20px !important;
                padding: 1rem !important;
            }
            
            .language-nav {
                flex-wrap: wrap;
                gap: 10px;
            }
            
            .language-nav .flag-lang-option,
            .language-nav .current-flag-lang {
                font-size: 0.9rem !important;
                padding: 6px 12px !important;
            }
            
            .contact h2 {
                font-size: 2rem !important;
            }
            
            .contacts-grid {
                grid-template-columns: 1fr !important;
                gap: 1.5rem !important;
            }
        }

        @media (max-width: 480px) {
            .gallery-grid {
                grid-template-columns: 1fr 1fr !important;
                gap: 15px !important;
            }
            
            .gallery-header {
                padding: 60px 0 30px 0 !important;
            }
            
            .gallery-header h1 {
                font-size: 1.8rem !important;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">
            <img src="images/logo_sm.webp" alt="Travel Angola Logo" class="logo-img">
            <span class="logo-text">Travel Angola</span>
        </div>
        <ul class="nav-links">
            <li><a href="index.php"><?= getCurrentLanguage() === 'pt' ? 'Início' : (getCurrentLanguage() === 'fr' ? 'Accueil' : (getCurrentLanguage() === 'es' ? 'Inicio' : 'Home')) ?></a></li>
            <li><a href="gallery.php" class="active"><?= getCurrentLanguage() === 'pt' ? 'Galeria' : (getCurrentLanguage() === 'fr' ? 'Galerie' : (getCurrentLanguage() === 'es' ? 'Galería' : 'Gallery')) ?></a></li>
            <li><a href="#contact"><?= getCurrentLanguage() === 'pt' ? 'Contacto' : (getCurrentLanguage() === 'fr' ? 'Contact' : (getCurrentLanguage() === 'es' ? 'Contacto' : 'Contact')) ?></a></li>
        </ul>
    </nav>

    <header class="hero gallery-hero">
        <div class="hero-content">
            <h1><?= getCurrentLanguage() === 'pt' ? 'Galeria de Fotos' : (getCurrentLanguage() === 'fr' ? 'Galerie de Photos' : (getCurrentLanguage() === 'es' ? 'Galería de Fotos' : 'Photo Gallery')) ?></h1>
            <p><strong><?= getCurrentLanguage() === 'pt' ? '127 Fotos' : (getCurrentLanguage() === 'fr' ? '127 Photos' : (getCurrentLanguage() === 'es' ? '127 Fotos' : '127 Photos')) ?></strong> <?= getCurrentLanguage() === 'pt' ? 'mostrando a beleza e diversidade de Angola' : (getCurrentLanguage() === 'fr' ? 'présentant la beauté et la diversité de l\'Angola' : (getCurrentLanguage() === 'es' ? 'mostrando la belleza y diversidad de Angola' : 'showcasing the beauty and diversity of Angola')) ?></p>
            
            <!-- Language Switcher in Header -->
            <div class="language-nav">
                <?php include 'includes/flag-icon-language-switcher.php'; ?>
            </div>
        </div>
    </header>

    <section class="gallery-stats">
        <div class="container">
            <h2><?= getCurrentLanguage() === 'pt' ? 'Explore Angola' : (getCurrentLanguage() === 'fr' ? 'Explorez l\'Angola' : (getCurrentLanguage() === 'es' ? 'Explora Angola' : 'Explore Angola')) ?></h2>
            <p><?= getCurrentLanguage() === 'pt' ? 'Uma coleção impressionante de fotografias capturando a essência, cultura e paisagens naturais de Angola' : (getCurrentLanguage() === 'fr' ? 'Une collection impressionnante de photographies capturant l\'essence, la culture et les paysages naturels de l\'Angola' : (getCurrentLanguage() === 'es' ? 'Una impresionante colección de fotografías que capturan la esencia, cultura y paisajes naturales de Angola' : 'A stunning collection of photographs capturing the essence, culture, and natural landscapes of Angola')) ?></p>
        </div>
    </section>

    <section class="gallery-section">
        <div class="container">
            <div class="gallery-grid" id="galleryGrid">
                <?php for ($i = 1; $i <= 127; $i++): ?>
                <div class="gallery-item">
                    <img src="images/gal<?php echo $i; ?>.webp" alt="<?php 
                        $currentLang = getCurrentLanguage();
                        switch($currentLang) {
                            case 'en': echo "Angola Gallery Image " . $i; break;
                            case 'fr': echo "Galerie Angola Image " . $i; break;
                            case 'es': echo "Galería Angola Imagen " . $i; break;
                            default: echo "Galeria Angola Imagem " . $i; break;
                        }
                    ?>" loading="lazy">
                </div>
                <?php endfor; ?>
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
            <p>&copy; 2025 Travel Angola. <?= getCurrentLanguage() === 'pt' ? 'Todos os direitos reservados' : (getCurrentLanguage() === 'fr' ? 'Tous droits réservés' : (getCurrentLanguage() === 'es' ? 'Todos los derechos reservados' : 'All rights reserved')) ?>. | <a href="index.php"><?= getCurrentLanguage() === 'pt' ? 'Voltar ao Início' : (getCurrentLanguage() === 'fr' ? 'Retour à l\'Accueil' : (getCurrentLanguage() === 'es' ? 'Volver al Inicio' : 'Back to Home')) ?></a></p>
            
            <!-- Language Switcher in Footer -->
            <div style="margin-top: 1rem; text-align: center;">
                <?php include 'includes/flag-icon-language-switcher.php'; ?>
            </div>
        </div>
    </footer>

    <script src="gallery.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Gallery PHP loaded - checking images...');
            
            // Add click handlers to all gallery images for lightbox
            const galleryImages = document.querySelectorAll('.gallery-item img');
            console.log(`Found ${galleryImages.length} gallery images`);
            
            galleryImages.forEach((img, index) => {
                // Add lightbox click handler
                img.onclick = function() {
                    openLightbox(this.src, this.alt);
                };
                
                // Debug image loading
                img.onload = function() {
                    console.log(`Image ${index + 1} loaded successfully: gal${index + 1}.webp`);
                };
                
                img.onerror = function() {
                    console.error(`Image ${index + 1} failed to load: gal${index + 1}.webp`);
                    this.alt = 'Image not found';
                    this.style.background = '#f0f0f0';
                };
            });
            
            // Debug gallery grid CSS
            const galleryGrid = document.getElementById('galleryGrid');
            const computedStyle = window.getComputedStyle(galleryGrid);
            console.log('Gallery grid display:', computedStyle.display);
            console.log('Gallery grid columns:', computedStyle.gridTemplateColumns);
        });

        function openLightbox(src, alt) {
            // Create lightbox modal
            const lightbox = document.createElement('div');
            lightbox.className = 'lightbox-modal';
            lightbox.innerHTML = `
                <div class="lightbox-content">
                    <span class="lightbox-close">&times;</span>
                    <img src="${src}" alt="${alt}" onload="console.log('Lightbox image loaded')">
                    <div class="lightbox-caption">${alt}</div>
                </div>
            `;
            
            document.body.appendChild(lightbox);
            document.body.style.overflow = 'hidden';
            
            // Close lightbox handlers
            const closeBtn = lightbox.querySelector('.lightbox-close');
            closeBtn.onclick = closeLightbox;
            lightbox.onclick = function(e) {
                if (e.target === lightbox) closeLightbox();
            };
            
            function closeLightbox() {
                document.body.removeChild(lightbox);
                document.body.style.overflow = 'auto';
            }
            
            // Keyboard navigation
            document.addEventListener('keydown', function handleKeyPress(e) {
                if (e.key === 'Escape') {
                    closeLightbox();
                    document.removeEventListener('keydown', handleKeyPress);
                }
            });
        }
    </script>
</body>
</html>