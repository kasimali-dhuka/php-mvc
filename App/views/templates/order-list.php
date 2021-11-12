{% extends 'base.php' %}

{% block title %} Order List {% endblock %}

{% block user %} Kasimali {% endblock %}

{% block body %}
<div class="order-container table-container">
    <div class="table-header">
        <div class="table-title">
            <h2>Order List</h2>
        </div>
        <div class="add-list">
            <a href="./posts/addorder">+ Add Order</a>
        </div>
    </div>
    <div class="order-table table-wrapper">
        <table class="table table-borderless table-hover table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Total Quantity</th>
                    <th>Total Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {% if is_empty %}

                <tr>
                    <td colspan="5" class="text-center">
                        ⚠ No Orders are added, please add some. ⚠
                    </td>
                </tr>

                {% else %}
                {% for item in lists %}
                <tr>
                    <td> {{item.order_id}} </td>
                    <td> {{item.order_date}} </td>
                    <td> {{item.order_quantity}} </td>
                    <td> ${{item.total_price}}/- </td>
                    <td>
                        <a href="./posts/add-order?id={{item.order_id}}">
                            <img src="../assets/images/edit.png" alt="Edit order">
                        </a>
                        <a href="javascript:void(0);" class="delete-btn" data-toggle="modal" data-target="#myModal"
                            data-id="{{item.order_id}}" data-list="orderlist">
                            <img src="../assets/images/ic_delete.png" alt="delete order">
                        </a>
                    </td>
                </tr>
                {% endfor %}
                {% endif %}
            </tbody>
        </table>
    </div>
</div>


{% endblock %}
{% block modal %} Order {% endblock %}