<nav class="bg-light sidebar py-5 d-print-none">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link <?php if(PAGE == 'dashboard') { echo 'active'; } ?>" href="dashboard.php">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>

            <!-- Technician/Employee (Dropdown Menu) -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#technicianSubmenu" data-toggle="collapse">
                    <i class="fas fa-user-cog"></i> Employee
                </a>
                <ul class="collapse list-unstyled" id="technicianSubmenu">
                    <li>
                        <a class="nav-link <?php if(PAGE == 'add_technician') { echo 'active'; } ?>" href="insertemp.php">
                            <i class="fas fa-user-plus"></i> Add Technician
                        </a>
                    </li>
                    <li>
                        <a class="nav-link <?php if(PAGE == 'view_technician') { echo 'active'; } ?>" href="technician.php">
                            <i class="fas fa-users"></i> View Technicians
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Work (Dropdown Menu) -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#workSubmenu" data-toggle="collapse">
                    <i class="fas fa-tasks"></i> Work
                </a>
                <ul class="collapse list-unstyled" id="workSubmenu">
                    <li>
                        <a class="nav-link <?php if(PAGE == 'assign_work') { echo 'active'; } ?>" href="assign_technician.php">
                            <i class="fas fa-plus-circle"></i> Add/Assign Work
                        </a>
                    </li>
                    <li>
                        <a class="nav-link <?php if(PAGE == 'view_work') { echo 'active'; } ?>" href="work.php">
                            <i class="fas fa-list"></i> View Works
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Requests -->
            <li class="nav-item">
                <a class="nav-link <?php if(PAGE == 'request') { echo 'active'; } ?>" href="request.php">
                    <i class="fas fa-align-center"></i> Requests
                </a>
            </li>

<!-- Assets (Dropdown Menu) -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#assetsSubmenu" data-toggle="collapse">
        <i class="fas fa-database"></i> Assets
    </a>
    <ul class="collapse list-unstyled" id="assetsSubmenu">
        <li>
            <a class="nav-link <?php if(PAGE == 'addassets') { echo 'active'; } ?>" href="addassets.php">
                <i class="fas fa-plus-circle"></i> Add Assets
            </a>
        </li>
        <li>
            <a class="nav-link <?php if(PAGE == 'viewassets') { echo 'active'; } ?>" href="viewassets.php">
                <i class="fas fa-eye"></i> View Assets
            </a>
        </li>
    </ul>
</li>
            <!-- Requesters -->
            <li class="nav-item">
                <a class="nav-link <?php if(PAGE == 'requesters') { echo 'active'; } ?>" href="requester.php">
                    <i class="fas fa-users"></i> Requester
                </a>
            </li>

          <!-- Reports (Dropdown Menu) -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#reportsSubmenu" data-toggle="collapse">
        <i class="fas fa-chart-line"></i> Reports
    </a>
    <ul class="collapse list-unstyled" id="reportsSubmenu">
        <li>
            <a class="nav-link <?php if(PAGE == 'sellreport') { echo 'active'; } ?>" href="soldproductreport.php">
                <i class="fas fa-table"></i> Sell Report
            </a>
        </li>
        <li>
            <a class="nav-link <?php if(PAGE == 'workreport') { echo 'active'; } ?>" href="workreport.php">
                <i class="fas fa-tasks"></i> Work Report
            </a>
        </li>
    </ul>
</li>


            <!-- Change Password -->
            <li class="nav-item">
                <a class="nav-link <?php if(PAGE == 'changepass') { echo 'active'; } ?>" href="changepass.php">
                    <i class="fas fa-key"></i> Change Password
                </a>
            </li>

            <!-- Logout -->
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
