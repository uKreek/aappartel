function getCurrentLanguage() {
    const pathSegments = window.location.pathname.split('/').filter(segment => segment !== '');
    if (pathSegments.length > 0) {
        const firstSegment = pathSegments[0].toLowerCase();
        if (firstSegment === 'en') {
            return 'en';
        } else if (firstSegment === 'de') {
            return 'de';
        }
    }
    return 'en';
}

const currentLang = getCurrentLanguage();
console.log(currentLang);
if (currentLang === "en") {
    document.getElementById('de-lang').classList.add("lang-disabled")
}
else {
    document.getElementById('en-lang').classList.add("lang-disabled")
}

document.getElementById('en').href = '/wordpress/de';
document.getElementById('de').href = '/wordpress/en';