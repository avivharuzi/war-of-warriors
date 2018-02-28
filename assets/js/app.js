$(function() {
	$("#warNameSearch").autocomplete({
	source: function (request, response) {
		$.ajax({
			type: "POST",
			url: "server.php",
			data: {
				query:request.term
			},
			success: response,
			dataType: "JSON",
			minLength: 1,
			delay: 100
		});
	}});
});
