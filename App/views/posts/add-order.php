{% extends 'base.php' %}

{% block title %} Add Order {% endblock %}

{% block user %} Kasimali {% endblock %}

{% block body %}

<div class="custom-container">
    <div class="heading">
        {% if edit_orders %}
        <h2>Edit Order</h2>
        {% else %}
        <h2>Add Order</h2>
        {% endif %}
    </div>
    <div class="custom-container-wrapper">
        <div class="add-product-form add-form">
            <form action="./posts/addorder" method="post" id="add_order" class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="" selected disabled>Category</option>
                            {% if is_cat_empty %}
                            <option value="" disabled> ⚠ No Categories ⚠ </option>
                            {% else %}
                            {% for item in categorylist %}
                            {% if item.category_id == edit_orders.category_id %}
                            <option value="{{item.category_id}}" selected class="selected"> {{item.category_name}}
                            </option>
                            {% else %}
                            <option value="{{item.category_id}}"> {{item.category_name}} </option>
                            {% endif %}
                            {% endfor %}
                            {% endif %}
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="quantity" id="quantity" class="form-control"
                            value="{{edit_orders.order_quantity}}" placeholder="Quantity" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <select name="product_id" id="product_id" class="form-control" required>
                            <option value="" selected disabled>Product</option>
                            <option value="" disabled> ⚠ No Products ⚠ </option>
                        </select>
                    </div>
                </div>
                <input type="hidden" value="" name="product_price" id="product_price" />
                <div class="add-btn col-12">
                    {% if edit_orders %}
                    <input type="hidden" value="{{edit_orders.order_id}}" name="order_id" id="order_id" />
                    <button type="submit" class="btn btn-danger" name="edit_order_btn" value="edit_order_btn">Edit
                        Order</button>
                    <a href="./lists/orderlist" class="btn btn-secondary ml-2 standard-btn">Cancel</a>
                    {% else %}
                    <button type="submit" class="btn btn-danger" name="add_order_btn" value="add_order_btn">Add
                        Order</button>
                    {% endif %}
                </div>
            </form>
        </div>
        <div class="order-list-wrapper">
            <div class="heading">
                <h1> Products </h1>
            </div>
            <div class="order-list-table">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <td>Product Name</td>
                            <td>Category Name</td>
                            <td>Quantity</td>
                            <td>Base Price</td>
                            <td>Total Price</td>
                        </tr>
                    </thead>
                    <tbody>
                        {% if is_order_empty %}
                        <tr>
                            <td colspan="100">
                                ⚠ No Orders ⚠
                            </td>
                        </tr>
                        {% else %}
                        {% for order in orderlist %}
                        <tr>
                            {% for product in productlist %}
                            {% if product.product_id == order.product_id %}
                            <td> {{product.product_name}} </td>
                            {% endif %}
                            {% endfor %}

                            {% for category in categorylist %}
                            {% if category.category_id == order.category_id %}
                            <td> {{category.category_name}} </td>
                            {% endif %}
                            {% endfor %}
                            <td> {{order.order_quantity}} </td>

                            {% for product in productlist %}
                            {% if product.product_id == order.product_id %}
                            <td> ${{product.product_price}}/- </td>
                            {% endif %}
                            {% endfor %}

                            <td> ${{order.total_price}}/- </td>
                        </tr>
                        {% endfor %}
                        {% endif %}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{% endblock %}