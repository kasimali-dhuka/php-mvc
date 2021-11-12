$(document).ready(function () {

  if ($("#add_order #category_id").find(".selected").length > 0) {
    let value = $("#add_order #category_id")
      .find(".selected")
      .attr("value");
    $.post(
      `${BASE_URL}posts/test`,
      { category: value },
      function (data, textStatus, jqXHR) {
        $("select#product_id").html(
          `<option value="" selected disabled>Product</option>` + data
        );
      }
    );
  }

  $("#add_order #category_id").on("change", function () {
    let value = $(this).val();
    console.log(value);
    $.post(
      `${BASE_URL}posts/test`,
      { category: value },
      function (data, textStatus, jqXHR) {
          $("select#product_id").html(`<option value="" selected disabled>Product</option>` + data);
      }
    );
  });

  $("select#product_id").on("change", function () {
      const value = $(this).val();
      const price = $(this).find(`option[value=${value}]`).attr('data-price');
      $("input[type=hidden]#product_price").attr('value', price);
  });

  $(".delete-btn").click(function (e) {
    e.preventDefault();
    const id = $(this).attr('data-id');
    const list = $(this).attr('data-list');
    $("#modal-delete-btn").attr('value', id);
    $("#modal-delete-btn").attr('data-list', list);
  });
  

  $("#myModal").on("hidden.bs.modal", function () {
    $(this).find("#modal-delete-btn").attr('value', '');
  });

  $("#modal-delete-btn").click(function(e) {
    const list_attr = $(this).attr('data-list');
    const value = $(this).val();
    if(list_attr === 'orderlist') {
      $.ajax({
        type: "POST",
        url: `${BASE_URL}posts/delete`,
        data: {order_id : value},
        success: function (response) {
          $(`.delete-btn[data-id=${value}]`).closest('tr').remove();
          $("#myModal").modal("hide");
          toastr["success"](`${response}`, "Deleted !");
        }
      });
    } else if(list_attr === 'productlist') {
      $.ajax({
        type: "POST",
        url: `${BASE_URL}posts/delete`,
        data: { product_id: value },
        success: function (response) {
          $(`.delete-btn[data-id=${value}]`).closest("tr").remove();
          $("#myModal").modal("hide");
          toastr["success"](`${response}`, "Deleted !");
          console.log('Product delete');
        },
      });
    } else if(list_attr === 'categorylist') {
      $.ajax({
        type: "POST",
        url: `${BASE_URL}posts/delete`,
        data: { category_id: value },
        success: function (response) {
          $(`.delete-btn[data-id=${value}]`).closest("tr").remove();
          $("#myModal").modal("hide");
          toastr["success"](`${response}`, "Deleted !");
        },
      });
    }
  });

  // Prevent resubmission
  window.onload = function () {
    history.replaceState("", "", window.location.href);
  };
});