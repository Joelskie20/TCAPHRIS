<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- FAST CLICK -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- bootstrap timepicker -->
<script src="{{ asset('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<!-- Multiple -->
<script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<!-- Moment.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js">
moment.tz.setDefault("Asia/Manila");
var moment = require('moment');
</script>
<script>
function startTime(){
	setTimeout(startTime, 1000);
	$('.display-time').html(moment().format('LTS'));
}

startTime();
</script>
<script>

  function infoToModal(id, textVal, location) {
		$('#modal-default-edit form').attr('action', '/' + location +'/' + id);
		$('#modal-default-edit').find('input[name="name"]').val(textVal);
	}

	$(function() {
		$('div.alert').delay(3000).fadeOut(300);
		FastClick.attach(document.body);
	});
</script>
@yield('scripts')