<div>
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <i class="mdi mdi-grid-large menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Device Management</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#device" aria-expanded="false"
                    aria-controls="device">
                    <i class="menu-icon mdi mdi-account"></i>
                    <span class="menu-title">Device Management</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="device">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="/device/list-device">List Device</a></li>
                        <li class="nav-item"> <a class="nav-link" href="/device/list-data">List Device Data</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>

</div>
