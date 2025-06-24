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

function toggleDropdown(event) {
    event.preventDefault();
    var invoice_menu = document.getElementById('invoicesDropdownMenu');
    invoice_menu.style.display = (invoice_menu.style.display === 'block') ? 'none' : 'block';
}
function deptDropdown(event) {
    event.preventDefault();
    var dept_menu = document.getElementById('deptDropdownMenu');
    dept_menu.style.display = (dept_menu.style.display === 'block') ? 'none' : 'block';

}
function toggleAccountDropdown(event) {
    event.preventDefault();
    var menu = document.getElementById('accountDropdownMenu');
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    document.addEventListener('click', function handler(e) {
        var dropdownItem = document.getElementById('accountDropdown');
        if (!dropdownItem.contains(e.target) && !menu.contains(e.target)) {
            menu.style.display = 'none';
            document.removeEventListener('click', handler);
        }
    });
}
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
