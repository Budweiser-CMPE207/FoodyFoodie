/**
 * For Restaurants.php
 */
var showRestaurantForm = function(){
  var dom = document.getElementById("addRestaurant");
  dom.style.display= (dom.style.display=="none"?"block":"none");
}

/**
 * For Items.php
 */
var showItemForm = function(){
  var dom = document.getElementById("addItem");
  dom.style.display= (dom.style.display=="none"?"block":"none");
}

/**
 * Get current page params
 * @param {String} key Name of param
 */
var getQueryStringValue = function(key) {
  return unescape(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + escape(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
}

/**
 * For Items.php
 */
var getOrderRequest = function(){
  var result = {};
  result.restaurant_id = getQueryStringValue("restaurant_id");
  result.orders=[];
  var items = $(".buy");
  for(var i=0; i < items.length; i++){
    var cur = items[i].dataset;
    cur.qty = items[i].value;
    if(cur.qty>0)
      result.orders.push(cur);
  }
  cartRender(result);
  return result;
}

/**
 * For Items.php render cart
 * @param {Object} data render the shopping cart
 */
var cartRender = function(data){
  var orders = data.orders;
  $("#cartTable").empty();
  if(orders.length==0){
    $("#cart").hide();
    return;
  }else{
    $("#cart").show();
  }
  var rawPrice = 0;
  for (var i = 0; i < orders.length; i++) {
    var rowData = orders[i];
    var row = $("<tr />")
    $("#cartTable").append(row);
    row.append($("<td>" + rowData.name + " X " + rowData.qty + "</td>"));
    row.append($("<td>" + (rowData.price * rowData.qty).toFixed(2) + "</td>"));
    rawPrice += rowData.price * rowData.qty;
  }
  $("#cartFoot").html("<h4 style='display:inline-block'>Total: " + rawPrice.toFixed(2) + "</h4>");
}

var placeOrder = function(){
  var json = JSON.stringify(getOrderRequest());
  $.post( "orders_add.php", json).done(function( data ) {
    window.location.href = "orders.php";
  });
}

/*
** for customers.php
*/
var showCustomerForm = function(){
  var dom = document.getElementById("addCustomer");
  dom.style.display= (dom.style.display=="none"?"block":"none");
}
