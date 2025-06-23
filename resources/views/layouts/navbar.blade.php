<nav style="background: #343a40; color: white; padding: 10px;">
    <h3 class="text-center">شريط التنقل</h3>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="dropdown-item text-end">
            <i class="fas fa-sign-out-alt me-2"></i> تسجيل خروج
        </button>
    </form>
</nav>
