function getCurrentLanguage() {
    const pathSegments = window.location.pathname.split('/').filter(segment => segment !== '');
    console.log(pathSegments);
    if (pathSegments.length > 0) {
        const firstSegment = pathSegments[1].toLowerCase(); // TODO: CHANGE THIS TO 0 WHEN DEPLOYING
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

document.getElementById('en').href = '/wordpress/de'; // TODO: CHANGE THIS WHEN DEPLOYING
document.getElementById('de').href = '/wordpress/en'; // TODO: CHANGE THIS WHEN DEPLOYING