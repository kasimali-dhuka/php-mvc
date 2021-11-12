{% extends 'log-reg_base.php' %}

{% block title %} Login {% endblock %}

{% block body %}
<!-- Login Page -->

<h1>Login</h1>

<div class="login-form">
    <form action="./home/index" id="login-form" method="POST">
        <div class="form-group">
            <label for="user_email">
                <img src="../assets/images/ic_email.png" alt="Email">
            </label>
            <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Email" required>
            <div class="error-message"> {{error}} </div>
        </div>
        <div class="form-group mb-5">
            <label for="user_pwd" class="mr-1">
                <img src="../assets/images/ic_password.png" alt="Password">
            </label>
            <input type="password" name="user_pwd" id="user_pwd" class="form-control pl-3" placeholder="Password"
                required>
            <div class="error-message"> {{error}} </div>
        </div>
        <span class="float-right">Not a user? Register <a href="./home/register">here</a>.</span>

        <button type="submit" name="login_btn" value="login_btn" class="btn btn-danger standard-btn">Login</button>
    </form>
</div>



{% endblock %}