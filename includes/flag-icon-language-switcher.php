<?php
/**
 * Flag Icons Language Switcher Component
 * TravelAngola Website - Using flag-icons CSS library
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

<div class="flag-icon-language-switcher">
    <?php foreach ($availableLanguages as $code => $language): ?>
        <?php if ($code !== $currentLang): ?>
            <a href="<?= getLanguageUrl($code) ?>" 
               class="flag-lang-option" 
               title="Switch to <?= htmlspecialchars($language['name']) ?>"
               aria-label="Switch to <?= htmlspecialchars($language['name']) ?>">
                <span class="fi fi-<?= htmlspecialchars($language['flag']) ?>"></span>
                <span class="lang-label"><?= htmlspecialchars($code) ?></span>
            </a>
        <?php endif; ?>
    <?php endforeach; ?>
    
    <!-- Show current language -->
    <span class="current-flag-lang" title="Current: <?= htmlspecialchars($availableLanguages[$currentLang]['name']) ?>">
        <span class="fi fi-<?= htmlspecialchars($availableLanguages[$currentLang]['flag']) ?>"></span>
        <span class="lang-label current"><?= htmlspecialchars($currentLang) ?></span>
    </span>
</div>

<style>
.flag-icon-language-switcher {
    display: flex;
    align-items: center;
    gap: 8px;
}

.flag-lang-option,
.current-flag-lang {
    display: flex;
    align-items: center;
    gap: 4px;
    padding: 6px 10px;
    border-radius: 6px;
    transition: all 0.2s ease;
    text-decoration: none;
    font-size: 12px;
    font-weight: 500;
}

.flag-lang-option {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: rgba(255, 255, 255, 0.8);
}

.flag-lang-option:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.4);
    color: white;
    transform: translateY(-1px);
}

.current-flag-lang {
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: white;
    opacity: 0.9;
}

.fi {
    width: 20px;
    height: 15px;
    border-radius: 2px;
    background-size: cover;
    display: inline-block;
}

.lang-label {
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 11px;
    line-height: 1;
}

.lang-label.current {
    font-weight: 600;
}

/* Dark theme for footer */
.footer .flag-icon-language-switcher .flag-lang-option {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(255, 255, 255, 0.1);
}

.footer .flag-icon-language-switcher .flag-lang-option:hover {
    background: rgba(255, 255, 255, 0.15);
    border-color: rgba(255, 255, 255, 0.25);
}

.footer .flag-icon-language-switcher .current-flag-lang {
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(255, 255, 255, 0.2);
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .flag-icon-language-switcher {
        gap: 6px;
    }
    
    .flag-lang-option,
    .current-flag-lang {
        padding: 4px 6px;
    }
    
    .lang-label {
        display: none; /* Show only flags on mobile */
    }
}
</style>