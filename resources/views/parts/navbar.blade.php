<div class="container mx-auto mb-10" id="navbar">
  <nav class="navbar bg-base-100">
    <div class="navbar-start">
      <div class="dropdown">
        <label tabindex="0" class="btn btn-ghost lg:hidden">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
          </svg>
        </label>
        <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
          <li><a href="/barang" class="nav-active">Data Barang</a></li>
        </ul>
      </div>
      <a href="/" class="btn btn-ghost normal-case text-xl">AxiaSolusi</a>
    </div>
    <div class="navbar-center hidden lg:flex">
      <ul class="menu menu-horizontal p-0">
        <li><a href="/barang" class="nav-active">Data Barang</a></li>
      </ul>
    </div>
    <div class="navbar-end">
      @auth
      <div class="dropdown dropdown-end">
        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full">
            <img src="https://placeimg.com/80/80/people" />
          </div>
        </label>
        <ul tabindex="0" class="menu menu-compact dropdown-content bg-neutral mt-3 p-2 shadow rounded-box w-52">
          <form action="{{ route('logout') }}" id="formLogout" method="post">
            <li>
              @csrf
              <a href="javascript:{}" onclick="document.getElementById('formLogout').submit();">Logout</a>
            </li>
          </form>
        </ul>
      </div>
      @else
      <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
      @endauth
    </div>
  </nav>
</div>