<link href="Watch-Guard-Tech-Logo.png" rel="icon">
<title> CCMS | All Users</title>
<?php
    session_start();
    include('dbconnection.php');
    if (strlen($_SESSION['id']) == 0 || $_SESSION['user_type_id'] != 1) {
        header('location:/fyp_ccms/index.php');
    } else {
        $id = $_SESSION["id"];
    }
?>

<?php include_once('sidebar&header.php'); ?>

<style>
            /* ---------------------------FOR MAIN CONTENT TO BE WRAPPED WHEN SIDEBAR EXPANDS -----------------*/

            /* CSS for Main Content */
            .main-content {
                margin-left: 260px; /* Same as the sidebar width */
                margin-top: 10px;
                background-color: #f4ebe8; /* Warm Beige */
                transition: margin-left 0.5s; /* Smooth transition when sidebar is toggled */
            }

            .sidebar.close ~ .main-content {
                margin-left: 80px; /* Adjusted width when sidebar is closed */
            }

            /* -------------------------------- FOR FOOTER TO BE AT THE BOTTOM ---------------------------------------*/

            .main-content {    
                display: flex; /* Enable flexbox layout */
                flex-direction: column; /* Stack items vertically */
                min-height: 76vh; /* Ensure body covers full viewport height */
                flex: 1; /* Allow content to grow and take up remaining space */
            }
            
            .footer {
                position: relative; /* Makes footer act as a relative element */
                bottom: 0; /* Places footer at the bottom */
                width: 100%; /* Stretches the footer across the entire width */
                margin-top: 20px;
            }

            /* -------------------------------- BAR ---------------------------------------*/

            .barr {
                margin: 20px;
                padding: 10px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                background-color: #ecf0f1;
                box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
                border-radius: 5px;
                font-size: 16px;
            }
            
            .barr h1 a {
                margin-left: 15px;
                font-size: 28px;
                color: #2c3e50;
            }
            
            .barr h1 a:hover {
                text-decoration: none;
            }
            
            .barr nav a {
                color: #f39c12;
                text-decoration: none;
            }
            
            .barr nav span {
                color: #2f3640;
                margin-right: 20px;
            }
            
            .barr nav a:hover {
                text-decoration: none;
            }
        




            body {
    margin: 0;
    font-family: Arial, sans-serif;
    padding: 0;
    background-color: #f4ebe8; /* Warm Beige */
    color: #2f3640; /* Dark Slate Gray */
        }



        .container {
            background-color: #ecf0f1; /* Neutral Color: Light Gray */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: calc(100% - 260px);
            margin: 0 auto;
            margin-left: 130px;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .container h2 {
            color: #2c3e50; /* Secondary Color: Navy Blue */
            text-align: center;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            background-color: #2c3e50; /* Secondary Color: Navy Blue */
            color: white;
            text-align: center;
        }

        .table td {
            text-align: center;
            color: #2f3640; /* Dark Slate Gray */
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f4ebe8; /* Warm Beige */
        }

        .table-striped tbody tr:nth-child(even) {
            background-color: #ecf0f1; /* Light Gray */
        }

        .table .badge {
            border-radius: 5px;
            padding: 5px 10px;
        }

        .badge-danger {
            background-color: #e74c3c; /* Red */
            color: white;
        }

        .badge-warning {
            background-color: #f39c12; /* Gold */
            color: white;
        }

        .badge-success {
            background-color: #2ecc71; /* Green */
            color: white;
        }

        .btn {
            background-color: #f39c12; /* Accent Color: Gold */
            color: #2c3e50; /* Secondary Color: Navy Blue */
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #e08e0b; /* Darker Gold on hover */
        }

        hr {
            border: 0;
            border-top: 1px solid #2c3e50; /* Secondary Color: Navy Blue */
            margin-bottom: 20px;
        }

</style>



<!-- Main Content -->
<div class="main-content">

    
        <div class="barr">
            <h1> <a href="all_users.php"> All Users </a></h1>
            <nav>
                <a href="dashboard.php"> Dashboard </a>
                <strong> / </strong>
                <span> All Users </span>
            </nav>
        </div>

        <div class="container">
    <!-- <h2>View All Complaints</h2>
    <hr> -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>S.No</th>
                <th>ID</th>
                <th>Name</th>
                <th>Contact No</th>
                <!-- <th>Email</th> -->
                <th>User Type</th>
                <th>User Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $uid=$_SESSION['id'];
                $query = mysqli_query($con, "SELECT user_detail.*, user_type.user_type_id, user_type.user_type_name as typename FROM user_detail JOIN user_type WHERE user_detail.user_type_id = user_type.user_type_id ");

            if (mysqli_num_rows($query) > 0) {
                $cnt = 1;
                while ($row = mysqli_fetch_array($query)) {
            ?>  
                <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($row['id']); ?></td>
                                                <td><?php echo htmlentities($row['name']); ?></td>
                                                <td><?php echo htmlentities($row['contact_number']); ?></td>
  
                                                <td>
                                                    <?php 
                                                    $user_type_id = $row['user_type_id'];
                                                    switch ($user_type_id) {
                                                        case '1':
                                                            echo '<span class="badge badge-primary" style="font-size: 15px; background-color: #039175; color: white; margin-top: 5px;">Super Admin</span>';
                                                            break;

                                                        case '2':
                                                            echo '<span class="badge badge-secondary" style="font-size: 15px; background-color: #04585e; color: white; margin-top: 5px;">Sub Admin</span>';
                                                            break;

                                                        case '3':
                                                            echo '<span class="badge badge-info" style="font-size: 15px; background-color: #8534db; color: white; margin-top: 5px;">Technician</span>';
                                                            break;

                                                        case '4':
                                                            echo '<span class="badge badge-warning" style="font-size: 15px; background-color: #f1c40f; color: white; margin-top: 5px;">Customer</span>';
                                                            break;

                                                        // default:
                                                        //     echo '<span class="badge badge-secondary" style="font-size: 15px; margin-top: 10px;">' . htmlentities($typename) . '</span>';
                                                        //     break;
                                                    }
                                                    ?>
                                                </td>


                                                <!-- <td><?php echo htmlentities($row['email']); ?></td> -->
                                                <!-- <td><?php echo htmlentities($row['typename']); ?></td> -->
                                                <!-- <td>

                                                    <?php 
                                                    $typename = $row['typename'];
                                                    switch ($typename) {
                                                        
                                                        case 'Super Admin':
                                                            echo '<span class="badge badge-primary" style="font-size: 15px; background-color: #1abc9c; color: white; margin-top: 5px;">Active</span>';
                                                            break;

                                                        case 'Sub Admin':
                                                            echo '<span class="badge badge-secondary" style="font-size: 15px; background-color: #7f8c8d; color: white; margin-top: 5px;">inActive</span>';
                                                            break;

                                                        case 'Technician':
                                                            echo '<span class="badge badge-info" style="font-size: 15px; background-color: #7f8c8d; color: white; margin-top: 5px;">inActive</span>';
                                                            break;

                                                        case 'Customer':
                                                            echo '<span class="badge badge-warning" style="font-size: 15px; background-color: #7f8c8d; color: white; margin-top: 5px;">inActive</span>';
                                                            break;

                                                        default:
                                                            echo '<span class="badge badge-secondary" style="font-size: 15px; margin-top: 10px;">' . $typename. '</span>';
                                                            break;
                                                    }
                                                    ?>
                                                </td> -->
                                                <!-- <td><?php echo htmlentities($row['is_active']); ?></td> -->
                                                <td>
                                                    <?php 
                                                    $is_active = $row['is_active'];
                                                    switch ($is_active) {
                                                        
                                                        case 'Active':
                                                            echo '<span class="badge badge-info" style="font-size: 15px; background-color: #1abc9c; color: white; margin-top: 5px;">Active</span>';
                                                            break;

                                                        case 'inActive':
                                                            echo '<span class="badge badge-secondary" style="font-size: 15px; background-color: #7f8c8d; color: white; margin-top: 5px;">inActive</span>';
                                                            break;

                                                        default:
                                                            echo '<span class="badge badge-secondary" style="font-size: 15px; margin-top: 10px;">' . $is_active. '</span>';
                                                            break;
                                                    }
                                                    ?>
                                                </td>

                                                
                                                <td>
                                                    <a href="user_detail.php?id=<?php echo htmlentities($row['id']); ?>"
                                                    class="badge badge-info" style="font-size: 15px; background-color: #f39c12; color: #2c3e50; margin: 5px; margin-right: 0px;">View Details</a>

                                                    <!-- <a href="sub_admin_complaints.php?id=<?php echo htmlentities($row['id']); ?>"
                                                    class="badge badge-info" style="font-size: 15px; background-color: #2f3640; color: #f4ebe8; margin: 5px; margin-left: 0px;">Complaints</a> -->
                                                </td>
                                            </tr>
            <?php 
                $cnt = $cnt + 1; 
                } 
            } else { 
                ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">No records found.</td>
                    </tr>
                <?php 
                } 
                ?>
            
            
        </tbody>
    </table>
</div>

    

    

</div>  <!-- End of Main Content -->

















<!-- JavaScript for Sidebar Toggle -->
<script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".bx-menu");
    console.log(sidebarBtn);
    sidebarBtn.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    });
</script>

<div class="footer">
    <?php include('footer.php'); ?>
</div>

