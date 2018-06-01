@if (session()->exists('client_data'))
@else
	<script type="text/javascript">
		window.location.href = "{{asset('/')}}";
	</script>
@endif