<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Logout Item -->
        <li class="nav-item dropdown no-arrow">
            <a class="dropdown-item" href="#" onclick="document.getElementById('formLogOut').submit();">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
            </a>
            <form class="dropdown-item" action="{{route('logout')}}" id="formLogOut" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
