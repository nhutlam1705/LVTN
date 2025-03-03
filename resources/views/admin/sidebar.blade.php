<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Go to website</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if (Auth::user()->image)
              <img src="{{  asset('images/' . Auth::user()->image) }}" class="img-circle elevation-2" alt="User Image">
          @else
              <img src="{{ asset('images/user.jpg') }}" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('ProductManager.ShowProduct') }}" class="nav-link">
              <i class="nav-icon fas fa-box-open"></i>
              <p>
                Sản phẩm
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('stock.show') }}"  class="nav-link">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Kho
              </p>
            </a>
          </li>
          @if(Auth::check() && Auth::user()->role == 1 && Auth::user()->account_id == 3)
          <li class="nav-item">
            <a href="{{ route('vouchers.index') }}" class="nav-link">
              <i class="nav-icon fas fa-ticket-alt"></i>
              <p>Voucher</p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="{{ route('AccountManager.ShowAccount') }}"  class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Tài khoản
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a  href="{{ route('orders.show') }}" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Đơn hàng
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('InformationManager.ShowInformation') }}"  class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Thông tin website
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>