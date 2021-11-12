{% extends "base.php" %} {% block title %}Posts{% endblock %}
{% block user %} Kasimali {% endblock %}
{% block body %}
<h1>Posts</h1>

<ul>
    {% for user in users %}
    <li> {{user.password}}</li>
    {% endfor %}
</ul>
{% endblock %}