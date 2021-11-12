{% extends 'log-reg_base.php' %}

{% block title %} Register {% endblock %}

{% block body %}
<!-- registeration page -->

<h1>Register</h1>

<div class="register-form">
    <form action="./home/index" id="registration-form" method="post">
        <div class="form-group">
            <label for="username" class="mr-1">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
            <div class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="user_email">
                <img src="../assets/images/ic_email.png" alt="Email">
            </label>
            <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Email" required>
            <div class="error-message"></div>
        </div>
        <div class="form-group mb-5">
            <label for="user_pwd" class="mr-1">
                <img src="../assets/images/ic_password.png" alt="Password">
            </label>
            <input type="password" name="user_pwd" id="user_pwd" class="form-control pl-3" placeholder="Password"
                required>
            <div class="error-message"></div>
        </div>
        <span class="float-right">Already have an account? Login <a href="./home/login">here</a>.</span>

        <div class="form-btn">
            <button type="submit" name="register_btn" value="register_btn" class="btn btn-danger">Register</button>
        </div>
    </form>
</div>

{% endblock %}