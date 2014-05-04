$(function(){ 
// On page load:

$(".addtocart").click(function(event){
	$.ajax({
		url:"cart_backend.php?action=add&id=" + $(this).attr("widgetid"),
	       	method:"GET",
       		success: function(recv){
			alert(recv);}});
	event.preventDefault();
});

$(".removefromcart").click(function(event){
	$.ajax({
		url:"cart_backend.php?action=remove&id=" + $(this).attr("widgetid"),
		method:"GET",
	       	});

	// AJAX call to reload the page each time this remove function runs
	$.ajax({
		url: "",
		context: document.body,
		success: function(s,x){
			$(this).html(s);
		}
	});
});

// End on page load
});
