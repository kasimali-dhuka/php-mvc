<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../assets/images/ic_dashboard.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    <!-- <link rel="stylesheet" href="./css/main.css" /> -->
    <base href="http://localhost/php-mvc/public/">
    <link rel="stylesheet" href="./css/main.css" />
    <title>{% block title %}{% endblock %}</title>
</head>

<body>

    <div class="body">
        <div class="container">
            <div class="wrapper form-wrapper">
                <div class="brand-logo">
                    <a href="./">
                        <img src="../assets/images/logo-admin-light-red.png" alt="Admin light logo">
                    </a>
                </div>
                <div class="form-container">
                    {% block body %} {% endblock %}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {% if invalid_login %}
    <script>
    toastr["error"]("Invalid Login details! Please try again.", "Login error");
    </script>
    {% elseif invalid_reg %}
    <script>
    toastr["warning"]("Account already exits! Please login.", "Register error");
    </script>
    {% endif %}
    <script src="../assets/js/validate.js"></script>
</body>

</html>