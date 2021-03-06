<!-- jQuery -->
<script src="{{asset('/asset/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/asset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/asset/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('/asset/plugins/toastr/toastr.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('/asset/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/asset/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- jQuery UI -->
<script src="{{asset('/asset/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- fullCalendar 2.2.5 -->
<script src="{{asset('/asset/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('/asset/plugins/fullcalendar/main.min.js')}}"></script>
<script src="{{asset('/asset/plugins/fullcalendar-daygrid/main.min.js')}}"></script>
<script src="{{asset('/asset/plugins/fullcalendar-timegrid/main.min.js')}}"></script>
<script src="{{asset('/asset/plugins/fullcalendar-interaction/main.min.js')}}"></script>
<script src="{{asset('/asset/plugins/fullcalendar-bootstrap/main.min.js')}}"></script>

<!-- ChartJS -->
<script src="{{asset('/asset/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('/asset/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('/asset/dist/js/demo.js')}}"></script>

<!-- axios -->
<script src="{{asset('/asset/dist/js/axios.min.js')}}"></script>

<script>
	$(function () {
		$("#example1").DataTable({
		"responsive": true,
		"autoWidth": false,
		});
		$('#example2').DataTable({
		"paging": true,
		"lengthChange": false,
		"searching": false,
		"ordering": true,
		"info": true,
		"autoWidth": false,
		"responsive": true,
		});
		//Initialize Select2 Elements
		$('.select2').select2()
		//Initialize Select2 Elements
		$('.select2bs4').select2({
		theme: 'bootstrap4'
		})
	});
    function logout(){
		var hapusin=confirm("Apakah Anda yakin ingin keluar?");
		if(hapusin==true){
	    	window.location='/logout';
	    }
	    return hapusin;
	}
</script>