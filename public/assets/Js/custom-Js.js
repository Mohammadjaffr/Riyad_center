function updateTitleBasedOnUrl() {
    const currentUrl = window.location.pathname;
    if (currentUrl.includes('login')) {
        document.title = 'تسجيل دخول';
    } else if (currentUrl.includes('register')) {
        document.title = 'إنشاء حساب';
    }
}
function changeUrl(url) {
    history.pushState(null, '', url);
    updateTitleBasedOnUrl(); 
}
