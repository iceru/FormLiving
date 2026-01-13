@section('sidebar')

<!-- start: sidebar -->
<aside class="sidebar" id="sidebar">
  <div class="sidebar__header">
    <a class="sidebar__brand" href="/">
      <img src="{{url('Dashboard')}}/images/logo/forms-logo.png" alt="FORMS">
      <span>FORMS</span>
    </a>
  </div>
  <div class="sidebar__nav">
    <ul class="nav__links">
      <li class="nav__divider">
        <div class="divider__title">Home </div>
        <hr class="separate">
      </li>
      @if(Route::current()->getName() == 'dashboard-admin')
      <li class="nav__item">
        <a class="nav__link active" href="/dashboard-admin">
          <i class="bi bi-house-door"></i>
          <span>Dashboard</span>
        </a>
      </li>
      @else
      <li class="nav__item">
        <a class="nav__link" href="/dashboard-admin">
          <i class="bi bi-house-door"></i>
          <span>Dashboard</span>
        </a>
      </li>
      @endif

      @if(Route::current()->getName() == 'sales-analytic')
      <li class="nav__item">
        <a class="nav__link active" href="/sales-analytic">
          <i class="bi bi-pie-chart"></i>
          <span>Sales Analytic</span>
        </a>
      </li>
      @else
      <li class="nav__item">
        <a class="nav__link" href="/sales-analytic">
          <i class="bi bi-pie-chart"></i>
          <span>Sales Analytic</span>
        </a>
      </li>
      @endif



     
      <li class="nav__item">
        <a class="nav__link" href="/voucher.html">
          <i class="bi bi-ticket-perforated"></i>
          <span>Voucher</span>
        </a>
      </li>
      <li class="nav__item">
        <a class="nav__link" href="/payment-method.html">
          <i class="bi bi-credit-card"></i>
          <span>Bank Partner</span>
        </a>
      </li>
      <li class="nav__item">
        <a class="nav__link" href="/commission-fees.html">
          <i class="bi bi-gear"></i>
          <span>Commission Fees</span>
        </a>
      </li>
      <li class="nav__divider">
        <div class="divider__title">Users</div>
        <hr class="separate">
      </li>
      <li class="nav__item">
        <a class="nav__link" href="/customer.html">
          <i class="bi bi-people"></i>
          <span>Customer</span>
        </a>
      </li>
      <li class="nav__item">
        <a class="nav__link" href="/agents.html">
          <i class="bi bi-people"></i>
          <span>Principal Agent Company</span>
        </a>
      </li>
      <li class="nav__item">
        <a class="nav__link" href="/agent-company.html">
          <i class="bi bi-people"></i><p></p>
          <span>Agent Company</span>
        </a>
      </li>
      <li class="nav__item">
        <a class="nav__link" href="/agent-perorangan.html">
          <i class="bi bi-people"></i>
          <span>Agent Perorangan</span>
        </a>
      </li>
      <li class="nav__item">
        <a class="nav__link" href="/sales-inhouse.html">
          <i class="bi bi-people"></i>
          <span>Sales Inhouse</span>
        </a>
      </li>
      <li class="nav__divider">
        <div class="divider__title">Others</div>
        <hr class="separate">
      </li>
      <li class="nav__item">
        <a class="nav__link" href="/access-control.html">
          <i class="bi bi-shield-lock"></i>
          <span>Access Control</span>
        </a>
      </li>
      <li class="nav__item">
        <a class="nav__link" href="/settings-profile.html">
          <i class="bi bi-gear"></i>
          <span>Account Settings</span>
        </a>
      </li>
    </ul>
  </div>
</aside>
<!-- end: sidebar -->

@endsection
