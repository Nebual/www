$(function() { // On page load:

$(".addtocart").click(function(event) {
	$.ajax("cart_backend.php?action=add&id="+$(this).attr("widgetid"), "GET", function(recv) {
		alert("Cart updated! Server said: "+recv);
	});
	event.preventDefault();
});




}); // End on page load
