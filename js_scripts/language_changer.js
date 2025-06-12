function getCurrentLanguage() {
    const pathSegments = window.location.pathname.split('/').filter(segment => segment !== '');
    console.log(pathSegments);
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
if (currentLang === "de"){
    document.getElementById('en-lang').classList.add("lang-disabled")
}
else{
    document.getElementById('de-lang').classList.add("lang-disabled")
}

document.getElementById('en').href = '/de';
document.getElementById('de').href = '/en';