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
    // Если нет языкового префикса, предполагаем язык по умолчанию (например, русский)
    return 'en'; // Замените на код языка вашего сайта по умолчанию
}

const currentLang = getCurrentLanguage();
console.log('dfmwffndsf');
if (currentLang === "de"){
    document.getElementById('en-lang').classList.add("lang-disabled")
}
else{
    document.getElementById('de-lang').classList.add("lang-disabled")
}

document.getElementById('en').href = '/wordpress/de';
document.getElementById('de').href = '/wordpress/en';