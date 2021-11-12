{% extends "base.php" %} {% block title %}Home{% endblock %}

{% block user %} {{user}} {% endblock %}
{% block body %}
<div class="tabs">
    <div class="tabs-container">
        <div class="order-tab tab">
            <div class="title">
                <h6>Total Orders</h6>
            </div>
            <div class="count order-count">
                {% if is_order_empty %}
                <h4>{{orderlist}}</h4>
                {% else %}
                <h4>0</h4>
                {% endif %}
            </div>
        </div>
        <div class="product-tab tab">
            <div class="title">
                <h6>Total Products</h6>
            </div>
            <div class="count order-product">
                {% if is_pro_empty %}
                <h4>{{productlist}}</h4>
                {% else %}
                <h4>0</h4>
                {% endif %}
            </div>
        </div>
        <div class="categories-tab tab">
            <div class="title">
                <h6>Total Categories</h6>
            </div>
            <div class="count order-categories">
                {% if is_cat_empty %}
                <h4>{{categorylist}}</h4>
                {% else %}
                <h4>0</h4>
                {% endif %}
            </div>
        </div>
    </div>
</div>

<div class="links">
    <div class="top-header">
        <h6>Quick Links</h6>
    </div>
    <div class="links-container row">
        <div class=" col-xl-4 col-lg-6">
            <div class="link category-link">
                <div class="title">
                    <h3>
                        <a href="./lists/categorylist">
                            <img src="../assets/images/ic_dashboard-black.png" alt=".">
                            Category
                        </a>
                    </h3>
                </div>
            </div>
        </div>
        <div class=" col-xl-4 col-lg-6">
            <div class="link product-link">
                <div class="title">
                    <h3>
                        <a href="./lists/productslist">
                            <img src="../assets/images/ic_dashboard-black.png" alt=".">
                            Product
                        </a>
                    </h3>
                </div>
            </div>
        </div>
        <div class=" col-xl-4 col-lg-6">
            <div class="link orders-link">
                <div class="title">
                    <h3>
                        <a href="./lists/orderlist">
                            <img src="../assets/images/ic_dashboard-black.png" alt=".">
                            Orders
                        </a>
                    </h3>
                </div>
            </div>
        </div>
        <div class=" col-xl-4 col-lg-6">
            <div class="link category-link">
                <div class="title">
                    <h3>
                        <a href="./lists/categorylist">
                            <img src="../assets/images/ic_dashboard-black.png" alt=".">
                            Category
                        </a>
                    </h3>
                </div>
            </div>
        </div>
        <div class=" col-xl-4 col-lg-6">
            <div class="link product-link">
                <div class="title">
                    <h3>
                        <a href="./lists/productslist">
                            <img src="../assets/images/ic_dashboard-black.png" alt=".">
                            Product
                        </a>
                    </h3>
                </div>
            </div>
        </div>
        <div class=" col-xl-4 col-lg-6">
            <div class="link orders-link">
                <div class="title">
                    <h3>
                        <a href="./lists/orderlist">
                            <img src="../assets/images/ic_dashboard-black.png" alt=".">
                            Orders
                        </a>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>

{% endblock %}