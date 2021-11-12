<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../assets/images/ic_dashboard.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    <!-- <link rel="stylesheet" href="./css/main.css" /> -->
    <base href="http://localhost/php-mvc/public/">
    <link rel="stylesheet" href="./css/main.css" />
    <title>{% block title %}{% endblock %}</title>
</head>

<body>
    <!-- top navigation -->
    <nav class="navbar navbar-expand-sm fixed-top">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                    <!-- {% block user %}{% endblock %} -->
                    {{session.username}}
                    <img src="../assets/images/ic_dropdown.png" alt="dropdown">
                </a>
                <div class="dropdown">
                    <a href="./home/logout">Logout</a>
                </div>
            </li>
        </ul>
    </nav>


    <!--side navigation -->
    <aside class="side-nav">
        <div class="side-nav-container">
            <div class="brand-img">
                <a href="./" class="navbar-brand"><img src="../assets/images/logo-admin-light-green.png"
                        alt="Admin Light" /></a>
            </div>
            <div class="nav-menu">
                <h4 class="title">Navigation Menu</h4>
                <div class="menu-container">
                    <ul>
                        <li>
                            <img src="../assets/images/ic_dashboard.png" alt="."> <a href="./"> Home </a>
                        </li>
                        <li>
                            <img src="../assets/images/ic_dashboard.png" alt="."> <a href="./lists/categorylist">
                                Category </a>
                        </li>
                        <li>
                            <img src="../assets/images/ic_dashboard.png" alt="."> <a href="./lists/productslist">
                                Products </a>
                        </li>
                        <li>
                            <img src="../assets/images/ic_dashboard.png" alt="."> <a href="./lists/orderlist"> Orders
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="support-menu">
                <h4 class="title">Support Menu</h4>
                <div class="menu-container">
                    <ul>
                        <li><img src="../assets/images/ic_dashboard.png" alt="."> <a href="#"> Report on Issue </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>

    <div class="body">
        <div class="body-container">
            <div class="container">
                <div class="wrapper">
                    {% block body %} {% endblock %}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal block -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Alert !</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    Are you sure you want to delete this {% block modal %} {% endblock %} ?
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" value="" id="modal-delete-btn" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>


    <script>
    const BASE_URL = '{{BASE_URL}}';
    const ROOT_URL = '{{ROOT_URL}}';
    </script>
    {% block script %}{% endblock %}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script> -->
    <script src="../assets/js/common.js"></script>
    {% if error %}
    <script>
    toastr["error"]("Something went wrong, try again later.", "Error!");
    </script>
    {% elseif success %}
    <script>
    toastr["success"]("Added successfully.", "Added !");
    </script>
    {% endif %}
</body>

</html>