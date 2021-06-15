<?php
  include("includes/config.php");
  include("views/partials/main-header.php");
  include("includes/handlers/ticket-handler.php");
?>

  <section class="newUser">
	<div class="container">
	<div class="row"><a class="btn black_button" href="/tools/wcd-asset-tool">Go Back</a></div>
	<div class="row newUser_container form_container">
		<h1 class="text-center pt-4" style="width: 100%; margin: 1rem auto">Create A Ticket</h1>
    <div id="support_ticket" class="form_container-wrapper">


			<form id="support_ticket" action="support_ticket.php" method="POST" style="margin: 1rem auto" class="pb-4">
        <div class="form-group mb-3">
          <label class="form_label font_15" for="ticketForm_name">Full Name:</label>
          <input id="ticketForm_name" class="form-control ticket_input" type="text" name="ticketForm_name" placeholder="Dexter McPherson" required/>
				</div>
        <div class="form-group mb-3">
          <label class="form_label font_15" for="ticketForm_email">Email:</label>
					<input id="ticketForm_email" class="form-control ticket_input" type="email" name="ticketForm_email" placeholder="dexters@laboratory.com" required/>
				</div>
        <div class="form-group mb-3">
          <label class="form_label font_15" for="ticketForm_headline">Support Issue:</label>
					<select id="ticketForm_headline" class="form-control ticket_input" name="ticketForm_headline" required>
						<option selected disabled>Choose Support Issue</option>
						<option>Password Help</option>
						<option>Devices</option>
						<option>Other</option>
					</select>
				</div>
				<div class="form-group mb-5">
          <label class="form_label font_15" for="ticketForm_message">Message:</label>
					<textarea id="ticketForm_message" class="form-control ticket_message" type="text" name="ticketForm_message" placeholder="Type your message..." required>
          </textarea>
				</div>




				<button type="submit" name="support_button" class="btn btn-lg black_button btn-block m-auto mb-5">Send Message</button>
			</form>

		</div>

	</div>
</div>
</section>
<?php
include("views/partials/footer.php");
?>
