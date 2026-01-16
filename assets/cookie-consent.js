/**
 * Cookie Consent GDPR Compliant
 * Perugia: Città del Cioccolato
 */

(function() {
    'use strict';

    const CONSENT_KEY = 'cookie_consent';
    const GA_ID = 'G-0GL8LJX691';

    // Check existing consent
    function getConsent() {
        const consent = localStorage.getItem(CONSENT_KEY);
        if (consent) {
            try {
                return JSON.parse(consent);
            } catch (e) {
                return null;
            }
        }
        return null;
    }

    // Save consent
    function saveConsent(analytics) {
        const consent = {
            analytics: analytics,
            timestamp: new Date().toISOString()
        };
        localStorage.setItem(CONSENT_KEY, JSON.stringify(consent));
    }

    // Load Google Analytics
    function loadGoogleAnalytics() {
        if (window.gaLoaded) return;

        // Create script tag
        const script = document.createElement('script');
        script.async = true;
        script.src = 'https://www.googletagmanager.com/gtag/js?id=' + GA_ID;
        document.head.appendChild(script);

        // Initialize gtag
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        window.gtag = gtag;
        gtag('js', new Date());
        gtag('config', GA_ID);

        window.gaLoaded = true;
    }

    // Show banner
    function showBanner() {
        const banner = document.getElementById('cookie-banner');
        if (banner) {
            banner.classList.add('show');
        }
    }

    // Hide banner
    function hideBanner() {
        const banner = document.getElementById('cookie-banner');
        if (banner) {
            banner.classList.remove('show');
        }
    }

    // Handle accept
    function acceptCookies() {
        saveConsent(true);
        loadGoogleAnalytics();
        hideBanner();
    }

    // Handle reject
    function rejectCookies() {
        saveConsent(false);
        hideBanner();
    }

    // Initialize
    function init() {
        const consent = getConsent();

        if (consent === null) {
            // No consent yet, show banner
            showBanner();
        } else if (consent.analytics === true) {
            // User accepted, load GA
            loadGoogleAnalytics();
        }
        // If rejected, do nothing (no GA)

        // Bind buttons
        const acceptBtn = document.getElementById('cookie-accept');
        const rejectBtn = document.getElementById('cookie-reject');

        if (acceptBtn) {
            acceptBtn.addEventListener('click', acceptCookies);
        }
        if (rejectBtn) {
            rejectBtn.addEventListener('click', rejectCookies);
        }
    }

    // Expose function to reset consent (for "Gestisci Cookie" link)
    window.resetCookieConsent = function() {
        localStorage.removeItem(CONSENT_KEY);
        location.reload();
    };

    // Run on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
