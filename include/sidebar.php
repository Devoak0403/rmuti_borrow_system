<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-light-orange elevation-4">

    <!-- Brand Logo -->

    <a href="index_admin.php" class="brand-link text-center bg-gray-dark">

      <!-- <img src="dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: ."> -->

      <span class="brand-text font-weight-width">Logistics Technology</span>

    </a>



    <!-- Sidebar -->

    <div class="sidebar">

      <!-- Sidebar user panel (optional) -->

      <div class="user-panel mt-3 mb-3 d-flex justify-content-center">

        <div class="info  ">

        <?php

            if (isset($_SESSION['admin_login'])) {

                $admin_login = $_SESSION['admin_login'];

                $stmt = $conn->query("SELECT * FROM users WHERE u_id = $admin_login");

                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);



                $mail = $row['email'];

                $user_name = $row['firstname'] . ' ' . $row['lastname'];

                echo "<p >Admin : $user_name <br>

                <a href='logout.php' class='btn btn-outline-warning btn-sm mt-2 btn-block'>ออกจากระบบ</a>

                </p>";

            } else {

              echo "<a href='loginpage.php' class='btn btn-outline-primary btn-block '>เข้าสู่ระบบ</a>";

            } 

            ?>

        </div>

      </div>



      <!-- SidebarSearch Form

      <div class="form-inline">

        <div class="input-group" data-widget="sidebar-search">

          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">

          <div class="input-group-append">

            <button class="btn btn-sidebar">

              <i class="fas fa-search fa-fw"></i>

            </button>

          </div>

        </div>

      </div> -->



      <!-- Sidebar Menu -->

      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item menu ">

            <a href="index_admin.php" class="nav-link ">

              <i class="nav-icon fas fa-home"></i>

              <p>

                หน้าหลัก

              </p>

            </a>

          </li>

          <li class="nav-header">การจัดการ</li>

          <li class="nav-item ">

            <a href="#" class="nav-link ">

              <i class="nav-icon fas fa-users"></i>

              <p>

                ข้อมูลผู้ใช้ระบบ

                <i class="right fas fa-angle-left"></i>

              </p>

            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">

                <a href="form_user.php" class="nav-link active">

                  <i class="fas fa-angle-right nav-icon"></i>

                  <p>เพิ่มข้อมูล</p>

                </a>

              </li>

              <li class="nav-item">

                <a href="tb_member.php" class="nav-link active">

                  <i class="fas fa-angle-right nav-icon"></i>

                  <p>ข้อมูลผู้ใช้ระบบ</p>

                </a>

              </li>

            </ul>

          </li>

          <li class="nav-item ">

            <a href="#" class="nav-link ">

              <i class="nav-icon fas fa-edit"></i>

              <p>

                วัสดุและครุภัณฑ์

                <i class="right fas fa-angle-left"></i>

              </p>

            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">

                <a href="form_item.php" class="nav-link active">

                  <i class="fas fa-angle-right nav-icon"></i>

                  <p>เพิ่มข้อมูล</p>

                </a>

              </li>

              <li class="nav-item">

                <a href="tb_item1.php" class="nav-link active">

                  <i class="fas fa-angle-right nav-icon"></i>

                  <p>แสดงข้อมูลวัสดุสิ้นเปลือง</p>

                </a>

              </li>

              <li class="nav-item">

                <a href="tb_item2.php" class="nav-link active">

                  <i class="fas fa-angle-right nav-icon"></i>

                  <p>แสดงข้อมูลครุภัณฑ์</p>

                </a>

              </li>

            </ul>

          </li>

          <li class="nav-item menu-is-opening menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-hand-holding"></i>
                  <p>
                      เบิก - จ่าย
                        <i class="right fas fa-angle-left"></i>
                  </p>
              </a>
            <ul class="nav nav-treeview" style="display: block;">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fas fa-plus-circle nav-icon"></i>
                      <p>
                        เพิ่มข้อมูล
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="form_lent_mtl.php" class="nav-link">
                      <i class="fas fa-angle-right nav-icon"></i>
                        <p>
                          วัสดุสิ้นเปลือง
                        </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="form_lent_krp.php" class="nav-link">
                      <i class="fas fa-angle-right nav-icon"></i>
                        <p>
                          ครุภัณฑ์
                        </p>
                    </a>
                  </li>
                </ul>
              </li>
                <li class="nav-item">
                  <a href="tb_lent_item1.php" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                      <p>
                        แสดงข้อมูลจ่ายวัสดุ
                      </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="tb_lent_item2.php" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                      <p>
                        แสดงข้อมูลเบิกครุภัณฑ์
                      </p>
                  </a>
                </li>
            </ul>
          </li>

          <!-- <li class="nav-item ">

            <a href="#" class="nav-link ">

              <i class="nav-icon fas fa-hand-holding"></i>

              <p>

                เบิก - จ่าย

                <i class="right fas fa-angle-left"></i>

              </p>

            </a>
            

            <ul class="nav nav-treeview">

              <li class="nav-item">

                <a href="form_lent.php" class="nav-link active">

                  
                  <i class="fas fa-plus-circle nav-icon"></i>

                  <p>เพิ่มข้อมูล</p>

                </a>

              </li>

              <li class="nav-item">

                <a href="tb_lent_item1.php" class="nav-link active">

                  <i class="fas fa-angle-right nav-icon"></i>

                  <p>แสดงข้อมูลจ่ายวัสดุ</p>

                </a>

              </li>

              <li class="nav-item">

                <a href="tb_lent_item2.php" class="nav-link active">

                  <i class="fas fa-angle-right nav-icon"></i>

                  <p>แสดงข้อมูลเบิกครุภัณฑ์</p>

                </a>

              </li>

            </ul>

          </li> -->

          

        </ul>

      </nav>

      <!-- /.sidebar-menu -->

    </div>

    <!-- /.sidebar -->

  </aside>