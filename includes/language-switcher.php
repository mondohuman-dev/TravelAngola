<?php
/**
 * Language Switcher Component
 * TravelAngola Website
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

<div class="language-switcher">
    <div class="language-dropdown">
        <button class="language-toggle" id="languageToggle" aria-label="<?= __('nav.language') ?>">
            <span class="flag-icon">
                <img src="assets/flags/<?= htmlspecialchars($currentLang) ?>.png" 
                     alt="<?= htmlspecialchars($availableLanguages[$currentLang]['flag'] ?? '🏳️') ?>" 
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
                <span class="flag-emoji" style="display:none;"><?= htmlspecialchars($availableLanguages[$currentLang]['flag'] ?? '🏳️') ?></span>
            </span>
            <span class="language-name"><?= htmlspecialchars($availableLanguages[$currentLang]['name'] ?? 'Unknown') ?></span>
            <svg class="dropdown-arrow" width="12" height="8" viewBox="0 0 12 8">
                <path d="M1 1l5 5 5-5" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        
        <div class="language-menu" id="languageMenu">
            <?php foreach ($availableLanguages as $code => $language): ?>
                <?php if ($code !== $currentLang): ?>
                    <a href="<?= getLanguageUrl($code) ?>" class="language-option" data-lang="<?= $code ?>">
                        <span class="flag-icon">
                            <img src="assets/flags/<?= $code ?>.png" 
                                 alt="<?= $language['flag'] ?>" 
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
                            <span class="flag-emoji" style="display:none;"><?= $language['flag'] ?></span>
                        </span>
                        <span class="language-name"><?= $language['name'] ?></span>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<style>
.language-switcher {
    position: relative;
    display: inline-block;
}

.language-toggle {
    display: flex;
    align-items: center;
    gap: 8px;
    background: transparent;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    padding: 8px 12px;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
    min-width: 120px;
}

.language-toggle:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.4);
}

.flag-icon {
    display: flex;
    align-items: center;
    width: 20px;
    height: 15px;
}

.flag-icon img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 2px;
}

.flag-emoji {
    font-size: 16px;
    line-height: 1;
}

.language-name {
    flex: 1;
    text-align: left;
}

.dropdown-arrow {
    transition: transform 0.3s ease;
}

.language-switcher.active .dropdown-arrow {
    transform: rotate(180deg);
}

.language-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(0, 0, 0, 0.1);
    min-width: 160px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 1000;
}

.language-switcher.active .language-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.language-option {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
    color: #333;
    text-decoration: none;
    transition: background-color 0.2s ease;
    font-size: 14px;
}

.language-option:hover {
    background-color: #f8f9fa;
}

.language-option:first-child {
    border-radius: 8px 8px 0 0;
}

.language-option:last-child {
    border-radius: 0 0 8px 8px;
}

/* Mobile Styles */
@media (max-width: 768px) {
    .language-toggle {
        min-width: 100px;
        padding: 6px 10px;
    }
    
    .language-name {
        display: none;
    }
    
    .language-menu {
        right: -10px;
        min-width: 140px;
    }
}

/* Dark theme for footer */
.footer .language-switcher .language-toggle {
    border-color: rgba(255, 255, 255, 0.3);
}

.footer .language-switcher .language-toggle:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.5);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const languageSwitcher = document.querySelector('.language-switcher');
    const languageToggle = document.getElementById('languageToggle');
    const languageMenu = document.getElementById('languageMenu');
    
    if (languageToggle && languageMenu) {
        // Toggle dropdown
        languageToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            languageSwitcher.classList.toggle('active');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!languageSwitcher.contains(e.target)) {
                languageSwitcher.classList.remove('active');
            }
        });
        
        // Close dropdown when pressing Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                languageSwitcher.classList.remove('active');
            }
        });
        
        // Handle language selection
        const languageOptions = document.querySelectorAll('.language-option');
        languageOptions.forEach(option => {
            option.addEventListener('click', function(e) {
                // Let the link navigate naturally
                languageSwitcher.classList.remove('active');
            });
        });
    }
});
</script>