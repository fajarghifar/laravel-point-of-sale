
<div class="iq-sidebar sidebar-default ">
    <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="header-logo">
            <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid rounded-normal light-logo" alt="logo"><h5 class="logo-title light-logo ml-3">POSDash</h5>
        </a>
        <div class="iq-menu-bt-sidebar ml-0">
            <i class="las la-bars wrapper-menu"></i>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="svg-icon">
                        <svg  class="svg-icon" id="p-dash1" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        <span class="ml-4">Dashboards</span>
                    </a>
                </li>

                <hr>

                <li class="{{ Request::is(['employees*','customers*','suppliers*']) ? 'active' : '' }}">
                    <a href="#people" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span class="ml-4">People</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="people" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle" style="">

                        <li class="{{ Request::is('employees*') ? 'active' : '' }}">
                            <a href="{{ route('employees.index') }}">
                                <i class="fal fa-minus"></i><span>Employees</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('customers*') ? 'active' : '' }}">
                            <a href="{{ route('customers.index') }}">
                                <i class="fal fa-minus"></i><span>Customers</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('suppliers*') ? 'active' : '' }}">
                            <a href="{{ route('suppliers.index') }}">
                                <i class="fal fa-minus"></i><span>Suppliers</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="{{ Request::is(['/salary/advance-salary*', '/salary/pay-salary*']) ? 'active' : '' }}">
                    <a href="#advance-salary" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="fal fa-hand-holding-usd"></i>
                        <span class="ml-3">Salary</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="advance-salary" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle" style="">

                        <li class="{{ Request::is(['advance-salary', 'advance-salary/*/edit']) ? 'active' : '' }}">
                            <a href="{{ route('advance-salary.index') }}">
                                <i class="fal fa-minus"></i><span>All Advance Salary</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('advance-salary/create*') ? 'active' : '' }}">
                            <a href="{{ route('advance-salary.create') }}">
                                <i class="fal fa-minus"></i><span>Create Advance Salary</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('pay-salary') ? 'active' : '' }}">
                            <a href="{{ route('pay-salary.index') }}">
                                <i class="fal fa-minus"></i><span>Pay Salary</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('pay-salary/history*') ? 'active' : '' }}">
                            <a href="{{ route('pay-salary.payHistory') }}">
                                <i class="fal fa-minus"></i><span>History Pay Salary</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="{{ Request::is(['/employee/attendence*']) ? 'active' : '' }}">
                    <a href="#attendence" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="fal fa-calendar-alt"></i>
                        <span class="ml-3">Attendence</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="attendence" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle" style="">

                        <li class="{{ Request::is(['employee/attendence']) ? 'active' : '' }}">
                            <a href="{{ route('attendence.index') }}">
                                <i class="fal fa-minus"></i><span>All Attedence</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('employee/attendence/*') ? 'active' : '' }}">
                            <a href="{{ route('attendence.create') }}">
                                <i class="fal fa-minus"></i><span>Create Attendence</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="{{ Request::is(['categories*']) ? 'active' : '' }}">
                    <a href="#products" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="fal fa-calendar-alt"></i>
                        <span class="ml-3">Products</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="products" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle" style="">

                        <li class="{{ Request::is(['categories*']) ? 'active' : '' }}">
                            <a href="{{ route('categories.index') }}">
                                <i class="fal fa-minus"></i><span>Categories</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
