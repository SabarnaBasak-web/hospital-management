<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>


        <li class="nav-item">
            <a
                class="nav-link collapsed"
                data-bs-target="#tables-nav"
                data-bs-toggle="collapse"
                href="#">
                <i class="fa-solid fa-droplet"></i><span>Blood</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul
                id="tables-nav"
                class="nav-content collapse"
                data-bs-parent="#sidebar-nav">
                <?php
                $user_type = $_SESSION['role'];
                $is_super_admin = $user_type == 'Super Admin';

                if ($is_super_admin) {
                ?>
                    <li>
                        <a href="tables-general.html">
                            <i class="fa-solid fa-plus "></i><span>Add Blood test</span>
                        </a>
                    </li>
                    <li>
                        <a href="tables-general.html">
                            <i class="fa-solid fa-money-check"></i><span>View Payments</span>
                        </a>
                    </li>
                <?php
                }
                ?>
                <li>
                    <a href="tables-data.html">
                        <i class="fa-solid fa-vial-virus "></i><span>Blood test entries</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>

</aside>