$(function(){ 
// On page load:

function alertIfMsg(recv){
	if(recv != "") {
		alert(recv);
	}
}

$(".addtocart").click(function(event){
	$.ajax({
		url:"cart_backend.php?action=add&id=" + $(this).attr("widgetid") + "&value=" + $(this).prev().val(),
		method:"GET",
		success: alertIfMsg,
			});
	event.preventDefault();
});

$(".removefromcart").click(function(event){
	$.ajax({
		url:"cart_backend.php?action=remove&id=" + $(this).attr("widgetid"),
		method:"GET",
		success: alertIfMsg,
			});

	$(this).parent().parent().remove(); // Remove the row
	/*
	// AJAX call to reload the page each time this remove function runs
	$.ajax({
		url: "",
		context: document.body,
		success: function(s,x){
			$(this).html(s);
		}
	});
	*/
});

$(".updatecart").click(function(event){
	var quantity = $(this).parent().parent().find("input.quantity").val();
	if(quantity <= 0) {
		$(this).parent().parent().find(".removefromcart").click();
	} else {
		$.ajax({
			url:"cart_backend.php?action=quantity&id=" + $(this).attr("widgetid") + "&value=" + quantity,
			method:"GET",
			success: alertIfMsg,
				});
	}
});

// End on page load
});
