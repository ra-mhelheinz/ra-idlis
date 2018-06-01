@if (session()->exists('client_data'))
		<?php
			$clientData = session('client_data');
		?>
@else
	<script type="text/javascript">
		window.location.href = "{{asset('/')}}";
	</script>
@endif