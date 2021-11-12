{% extends 'base.php' %}

{% block title %} Add Category {% endblock %}

{% block user %} Kasimali {% endblock %}

{% block body %}

<div class="custom-container">
    <div class="heading">
        {% if edit_category %}
        <h2>Edit Category</h2>
        {% else %}
        <h2>Add Category</h2>
        {% endif %}
    </div>
    <div class="custom-container-wrapper">
        <div class="add-product-form add-form">
            <form action="./posts/addcategory" method="POST" id="add_category" class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="category_name" id="category_name" class="form-control"
                            placeholder="Category Name" value="{{edit_category.category_name}}" required>
                        <div class="error-message"></div>
                    </div>
                </div>
                <div class="add-btn col-12">
                    {% if edit_category %}
                    <input type="hidden" name="category_id" value="{{edit_category.category_id}}">
                    <button type="submit" class="btn btn-danger" name="edit_category_btn" value="edit_category_btn">
                        Edit Category
                    </button>
                    <a href="./lists/categorylist" class="btn btn-secondary standard-btn ml-2">Cancel</a>
                    {% else %}
                    <button type="submit" class="btn btn-danger" name="add_category_btn" value="add_category_btn">
                        Add Category
                    </button>
                    {% endif %}
                </div>
            </form>
        </div>
    </div>
</div>


{% endblock %}