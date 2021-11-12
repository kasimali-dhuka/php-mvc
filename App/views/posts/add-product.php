{% extends 'base.php' %}

{% block title %} Add Product {% endblock %}

{% block user %} Kasimali {% endblock %}

{% block body %}

<div class="custom-container">
    <div class="heading">
        {% if edit_products %}
        <h2>Edit Product</h2>
        {% else %}
        <h2>Add Product</h2>
        {% endif %}
    </div>
    <div class="custom-container-wrapper">
        <div class="add-product-form add-form">
            <form action="./posts/addproduct" method="post" id="add_product" class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="product_name" id="product_name" class="form-control"
                            placeholder="Product Name" value="{{edit_products.product_name}}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="product_price" id="product_price" class="form-control"
                            placeholder="Product Price" value="{{edit_products.product_price}}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="" selected disabled>Category</option>
                            {% if is_empty %}
                            <option value="" disabled> ⚠ No Categories ⚠ </option>
                            {% else %}
                            {% for item in categorylist %}
                            {% if item.category_id == edit_products.category_id %}
                            <option value="{{item.category_id}}" selected> {{item.category_name}} </option>
                            {% else %}
                            <option value="{{item.category_id}}"> {{item.category_name}} </option>
                            {% endif %}
                            {% endfor %}
                            {% endif %}

                        </select>
                    </div>
                </div>
                <div class="add-btn col-12">
                    {% if edit_products %}
                    <input type="hidden" name="product_id" value="{{edit_products.product_id}}">
                    <button type="submit" class="btn btn-danger" name="edit_product_btn" value="edit_product_btn">Edit
                        Product</button>
                    <a href="./lists/productslist" class="btn btn-secondary standard-btn ml-2">Cancel</a>
                    {% else %}
                    <button type="submit" class="btn btn-danger" name="add_product_btn" value="add_product_btn">Add
                        Product</button>
                    {% endif %}
                </div>
            </form>
        </div>
    </div>
</div>

{% endblock %}