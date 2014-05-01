$(function() { // On page load:

$(".addtocart").click(function(event) {
	$.ajax({url:"cart_backend.php?action=add&id="+$(this).attr("widgetid"), method:"GET", success: function(recv) {
		alert("Cart updated! Server said: "+recv);
	}});
	event.preventDefault();
});




}); // End on page load
