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
window.addEventListener('DOMContentLoaded', function() {
    var footer = document.querySelector('footer');
    if (footer) {
        document.body.style.paddingBottom = (footer.offsetHeight + 10) + 'px';
    }
});

// function toggleDropdown(event) {
//     event.preventDefault();
//     var invoice_menu = document.getElementById('invoicesDropdownMenu');
//     invoice_menu.style.display = (invoice_menu.style.display === 'block') ? 'none' : 'block';
// }
// function deptDropdown(event) {
//     event.preventDefault();
//     var menu = document.getElementById('deptDropdownMenu');
//     menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
//
// }
// function empDropdown(event) {
//     event.preventDefault();
//     var menu = document.getElementById('empDropdownMenu');
//     menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
//
// }function purchasesDropdown(event) {
//     event.preventDefault();
//     var menu = document.getElementById('purchasesDropdownMenu');
//     menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
//
// }
// function reportDropdown(event) {
//     event.preventDefault();
//     var menu = document.getElementById('reportDropdownMenu');
//     menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
//
// }
// function returnDropdown(event) {
//     event.preventDefault();
//     var menu = document.getElementById('returnDropdownMenu');
//     menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
//
// }
// function roleDropdown(event) {
//     event.preventDefault();
//     var menu = document.getElementById('roleDropdownMenu');
//     menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
//
// }
// function productsDropdown(event) {
//     event.preventDefault();
//     var menu = document.getElementById('productsDropdownMenu');
//     menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
//
// }

function handleSidebarToggleVisibility() {
    const navbarToggler = document.querySelector('.navbar-toggler');
    if (window.innerWidth < 992) {
        navbarToggler.style.display = 'block';
    } else {
        navbarToggler.style.display = 'none';
    }
}


const sidebarMenu = new bootstrap.Offcanvas(document.getElementById('mainNavbar'));
document.querySelector('.navbar-toggler').addEventListener('click', function() {
    sidebarMenu.show();
});

// متابعة تغيير حجم الشاشة
window.addEventListener('resize', handleSidebarToggleVisibility);

// التهيئة الأولية
document.addEventListener('DOMContentLoaded', function() {
    handleSidebarToggleVisibility();
});
