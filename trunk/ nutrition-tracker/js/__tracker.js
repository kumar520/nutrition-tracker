	$(function() {
		$("#move_b, #move_l, #move_d, #move_s").selectmenu({ style:'dropdown', menuWidth:120 });
		$("#button1, #button2, #button3, #button4, #button5").button();
		$("#button1, #button2, #button3, #button4, #button5").hover(function() { $(this).addClass("ui-state-hover"); }, function(){ $(this).removeClass("ui-state-hover"); });
		$("#chkallbfast, #chkalllunch, #chkalldinner, #chkallsnack").click(function() {
			var cs = this.checked;
			$("input[name=item_" + this.value + "[]]").each(function() { this.checked = cs; });
		});
		$("#datepicker").datepicker({
			showOn: 'both',
			buttonImage: 'images/calendar.gif',
			buttonImageOnly: true,
			onClose: function(dateText, inst) { location.href='tracker.php?action=view&date=' + dateText; }
		});
		$("#datepicker").datepicker('option', 'defaultDate', '{$date|date_format:"%m/%d/%Y"}');

		// Save note
		$("#savenote").click(function() {
			$("#savenote").text("Saving...");
			alert("{$smarty.session.user_info.user_id}");
			alert("{$date|date_format:'%Y-%m-%d'}");
			$.get("config/ajaxcalls.php", { method: "saveNote", tracker_note: $("#note").val(), 
				user_id: "{$smarty.session.user_info.user_id}", tracker_date: "{$date|date_format:'%Y-%m-%d'}" }, 
				function(data) {
					alert(data);
					if (data) { $("#savenote").text("Save Note"); }
				});
		});
		$("#move_b").change(function() {
			$("#action").val("move");
			$("#meal").val("b");
			$("#dest").val($("#move_b").val());
			this.form.submit();							  
		});
		$("#move_l").change(function() {
			$("#action").val("move");
			$("#meal").val("l");
			$("#dest").val($("#move_l").val());
			this.form.submit();							  
		});
		$("#move_d").change(function() {
			$("#action").val("move");
			$("#meal").val("d");
			$("#dest").val($("#move_d").val());
			this.form.submit();							  
		});
		$("#move_s").change(function() {
			$("#action").val("move");
			$("#meal").val("s");
			$("#dest").val($("#move_s").val());
			this.form.submit();							  
		});
		$("#button1").click(function() {
			$("#action").val("delete");
			$("#meal").val("b");
			this.form.submit();
		});
		$("#button2").click(function() {
			$("#action").val("delete");
			$("#meal").val("l");
			alert(1);
			this.form.submit();
		});
		$("#button3").click(function() {
			$("#action").val("delete");
			$("#meal").val("d");
			this.form.submit();
		});
		$("#button4").click(function() {
			$("#action").val("delete");
			$("#meal").val("s");
			this.form.submit();
		});
	});