{% extends 'base.php' %}

{% block title %} Category List {% endblock %}

{% block user %} Kasimali {% endblock %}

{% block body %}
<div class="category-container table-container">
    <div class="table-header">
        <div class="table-title">
            <h2>Category List</h2>
        </div>
        <div class="add-list">
            <a href="./posts/addcategory"> + Add Category</a>
        </div>
    </div>
    <div class="category-table table-wrapper">
        <table class="table table-borderless table-hover table-striped">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {% if is_empty %}
                <tr>
                    <td colspan="2" class="text-center">
                        ⚠ No Categories are added, please add some. ⚠
                    </td>
                </tr>

                {% else %}

                {% for item in lists %}
                <tr>
                    <td> {{item.category_name}} </td>
                    <td>
                        <a href="./posts/addcategory?id={{item.category_id}}">
                            <img src="../assets/images/edit.png" alt="Edit order">
                        </a>
                        <a href="javascript:void(0);" class="delete-btn" data-toggle="modal" data-target="#myModal"
                            data-id="{{item.category_id}}" data-list="categorylist">
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