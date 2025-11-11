<?php
/**
 * Minimal Language Switcher Component
 * TravelAngola Website - Matches original design
 */

// Ensure language config is loaded
if (!function_exists('getAvailableLanguages')) {
    require_once __DIR__ . '/language-config.php';
}

$currentLang = getCurrentLanguage();
$availableLanguages = getAvailableLanguages();

// Safety check
if (!isset($availableLanguages[$currentLang])) {
    $currentLang = 'en'; // fallback to English
}
?>

<div class="minimal-language-switcher">
    <?php foreach ($availableLanguages as $code => $language): ?>
        <?php if ($code !== $currentLang): ?>
            <a href="<?= getLanguageUrl($code) ?>" class="lang-option" title="Switch to <?= htmlspecialchars($language['name']) ?>">
                <?= htmlspecialchars($language['flag']) ?>
            </a>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<style>
.minimal-language-switcher {
    display: flex;
    gap: 8px;
}

.minimal-language-switcher .lang-option {
    display: inline-block;
    padding: 6px 8px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
    text-decoration: none;
    font-size: 16px;
    transition: all 0.2s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.minimal-language-switcher .lang-option:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-1px);
}

/* Dark theme for footer */
.footer .minimal-language-switcher .lang-option {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(255, 255, 255, 0.1);
}

.footer .minimal-language-switcher .lang-option:hover {
    background: rgba(255, 255, 255, 0.15);
}
</style>