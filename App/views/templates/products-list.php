{% extends 'base.php' %}

{% block title %} Product List {% endblock %}

{% block user %} Kasimali {% endblock %}

{% block body %}
<div class="product-container table-container">
    <div class="table-header">
        <div class="table-title">
            <h2>Product List</h2>
        </div>
        <div class="add-list">
            <a href="./posts/addproduct"> + Add Product</a>
        </div>
    </div>
    <div class="product-table table-wrapper">
        <table class="table table-borderless table-hover table-striped">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                {% if is_empty %}
                <tr>
                    <td colspan='3' class="text-center">
                        ⚠ No Products are added, please add some. ⚠
                    </td>
                </tr>
                {% else %}
                {% for item in lists %}
                <tr>
                    <td> {{item.product_name}} </td>
                    <td> ${{item.product_price}}/- </td>
                    <td>
                        <a href="./posts/addproduct?id={{item.product_id}}">
                            <img src="../assets/images/edit.png" alt="Edit order">
                        </a>
                        <a href="javascript:void(0);" data-toggle="modal" class="delete-btn" data-target="#myModal"
                            data-id="{{item.product_id}}" data-list="productlist">
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