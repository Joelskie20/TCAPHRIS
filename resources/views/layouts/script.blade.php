<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
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

@yield('scripts')