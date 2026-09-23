<?php
require_once 'includes/language-config.php';
require_once 'includes/special-translations.php';

$special = special_content();
$specialLanguage = rawurlencode(getCurrentLanguage());
$detailsUrl = 'special.php?lang=' . $specialLanguage;
$inquiryUrl = 'index.php?lang=' . $specialLanguage . '&inquiry=' . rawurlencode('Angola Christmas 2026') . '#contact';

function special_escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="<?= special_escape(getPageLanguage()) ?>" dir="<?= special_escape(getTextDirection()) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= special_escape($special['meta_title']) ?></title>
    <meta name="description" content="<?= special_escape($special['meta_description']) ?>">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="special.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body class="ta-special-page">
    <header class="ta-special-hero">
        <nav class="main-nav ta-special-nav" aria-label="Primary">
            <a href="index.php?lang=<?= $specialLanguage ?>" class="logo" aria-label="Travel Angola Home">
                <img src="images/logo_sm.webp" alt="Travel Angola Logo" class="logo-img">
                <span class="logo-text">Travel Angola</span>
            </a>
            <ul class="nav-links" id="primary-nav">
                <li><a href="index.php?lang=<?= $specialLanguage ?>#about"><?= special_escape(t('nav.about')) ?></a></li>
                <li><a href="index.php?lang=<?= $specialLanguage ?>#destinations"><?= special_escape(t('nav.destinations')) ?></a></li>
                <li><a href="index.php?lang=<?= $specialLanguage ?>#activities"><?= special_escape(t('nav.activities')) ?></a></li>
                <li><a class="is-current" href="<?= special_escape($detailsUrl) ?>"><?= special_escape(t('nav.special', 'Special')) ?></a></li>
                <li><a href="gallery.php?lang=<?= $specialLanguage ?>"><?= special_escape(t('nav.gallery')) ?></a></li>
                <li><a href="index.php?lang=<?= $specialLanguage ?>#contact"><?= special_escape(t('nav.contact')) ?></a></li>
            </ul>
            <div class="language-nav">
                <?php include 'includes/flag-icon-language-switcher.php'; ?>
            </div>
        </nav>

        <div class="ta-special-container ta-special-hero__content">
            <a class="ta-special-back" href="index.php?lang=<?= $specialLanguage ?>">← <?= special_escape($special['back_home']) ?></a>
            <p class="ta-special-kicker"><?= special_escape($special['limited']) ?></p>
            <h1><?= special_escape($special['title']) ?></h1>
            <p class="ta-special-lead"><?= special_escape($special['subtitle']) ?></p>

            <div class="ta-special-facts">
                <p><strong>19 Dec 2026</strong><span><?= special_escape($special['departure_label']) ?></span></p>
                <p><strong>7 Jan 2027</strong><span><?= special_escape($special['conclusion_label']) ?></span></p>
                <p><strong><?= special_escape($special['duration']) ?></strong><span><?= special_escape($special['nights']) ?></span></p>
                <p><strong><?= special_escape($special['discount']) ?></strong><span><?= special_escape($special['children']) ?></span></p>
            </div>

            <div class="ta-special-pricing">
                <p><span><?= special_escape($special['camping']) ?></span><strong>N$6,876</strong><small><?= special_escape($special['per_person']) ?></small></p>
                <p><span><?= special_escape($special['lodging']) ?></span><strong>N$21,114</strong><small><?= special_escape($special['sharing']) ?></small></p>
                <a class="ta-special-button" href="<?= special_escape($inquiryUrl) ?>"><?= special_escape($special['request']) ?></a>
            </div>
        </div>
    </header>

    <main class="ta-special-main">
        <div class="ta-special-container">
            <aside class="ta-special-notice">
                <span aria-hidden="true">!</span>
                <p><strong><?= special_escape($special['notice_title']) ?></strong> <?= special_escape($special['notice_body']) ?></p>
            </aside>

            <section class="ta-special-feature">
                <div class="ta-special-feature__copy">
                    <p class="ta-special-kicker"><?= special_escape($special['experience_kicker']) ?></p>
                    <h2><?= special_escape($special['experience_title']) ?></h2>
                    <p><?= special_escape($special['experience_body_1']) ?></p>
                    <p><?= special_escape($special['experience_body_2']) ?></p>
                </div>
                <img src="images/gal74.webp" alt="Oceanus pool and coastal accommodation at Baía das Pipas">
            </section>

            <section class="ta-special-section">
                <header class="ta-special-heading">
                    <p class="ta-special-kicker"><?= special_escape($special['itinerary_kicker']) ?></p>
                    <h2><?= special_escape($special['itinerary_title']) ?></h2>
                    <p><?= special_escape($special['itinerary_intro']) ?></p>
                </header>
                <div class="ta-special-itinerary">
                    <?php foreach ($special['itinerary'] as $index => $stage): ?>
                        <details<?= $index === 0 ? ' open' : '' ?>>
                            <summary>
                                <span class="ta-special-day"><?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?></span>
                                <span><strong><?= special_escape($stage[0]) ?></strong><small><?= special_escape($stage[1]) ?></small></span>
                                <span class="ta-special-chevron" aria-hidden="true">⌄</span>
                            </summary>
                            <div class="ta-special-itinerary__body"><?= special_escape($stage[2]) ?></div>
                        </details>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="ta-special-oceanus">
                <div class="ta-special-oceanus__gallery">
                    <img src="images/gal70.webp" alt="Oceanus swimming pool and shaded seating">
                    <img src="images/gal69.webp" alt="Oceanus stone lodge and outdoor dining area">
                    <img src="images/gal71.webp" alt="Oceanus lodge accommodation">
                </div>
                <div class="ta-special-oceanus__copy">
                    <p class="ta-special-kicker"><?= special_escape($special['oceanus_kicker']) ?></p>
                    <h2><?= special_escape($special['oceanus_title']) ?></h2>
                    <p><?= special_escape($special['oceanus_body']) ?></p>
                    <a class="ta-special-button" href="<?= special_escape($inquiryUrl) ?>"><?= special_escape($special['request']) ?></a>
                </div>
            </section>

            <section class="ta-special-section">
                <header class="ta-special-heading">
                    <p class="ta-special-kicker"><?= special_escape($special['package_kicker']) ?></p>
                    <h2><?= special_escape($special['package_title']) ?></h2>
                </header>
                <div class="ta-special-lists">
                    <div>
                        <h3><?= special_escape($special['included']) ?></h3>
                        <ul><?php foreach ($special['included_items'] as $item): ?><li><?= special_escape($item) ?></li><?php endforeach; ?></ul>
                    </div>
                    <div>
                        <h3><?= special_escape($special['not_included']) ?></h3>
                        <ul><?php foreach ($special['not_included_items'] as $item): ?><li><?= special_escape($item) ?></li><?php endforeach; ?></ul>
                    </div>
                </div>
            </section>

            <section class="ta-special-section">
                <header class="ta-special-heading">
                    <p class="ta-special-kicker"><?= special_escape($special['gallery_kicker']) ?></p>
                    <h2><?= special_escape($special['gallery_title']) ?></h2>
                </header>
                <div class="ta-special-gallery">
                    <img src="images/special-beach.webp" alt="Beach camping on the Angolan coast">
                    <img src="images/gal72.webp" alt="Oceanus guest room entrance">
                    <img src="images/gal74.webp" alt="Oceanus swimming pool">
                    <img src="images/gal69.webp" alt="Oceanus lodge terrace">
                </div>
            </section>

            <section class="ta-special-cta">
                <div>
                    <h2><?= special_escape($special['cta_title']) ?></h2>
                    <p><?= special_escape($special['cta_body']) ?></p>
                </div>
                <a class="ta-special-button" href="<?= special_escape($inquiryUrl) ?>"><?= special_escape($special['request']) ?></a>
            </section>
        </div>
    </main>

    <footer class="ta-special-footer">
        <div class="container">
            <p>&copy; <?= date('Y') ?> Travel Angola. <?= special_escape(t('footer.rights')) ?>.</p>
            <div class="language-nav">
                <?php include 'includes/flag-icon-language-switcher.php'; ?>
            </div>
        </div>
    </footer>
</body>
</html>
