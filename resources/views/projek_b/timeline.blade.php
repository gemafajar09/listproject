@extends('template')
@section('content')
<div class="col-md-3">
    <div class="sticky-top mb-3">
        <!--  -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Programmer</h4>
            </div>
            <div class="card-body">
                <!-- the events -->
                <div id="user">
                    <input type="hidden" id="id_project" value="{{ $id_project }}">
                    <select name="id_user" id="id_user" class="form-control">
                        <option value="">-- Pilih --</option>
                        @foreach($user as $no => $u)
                        <option value="{{ $u->id_user }}">{{ $u->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <!--  -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Seret Event</h4>
            </div>
            <div class="card-body">
                <!-- the events -->
                <div id="external-events">
                    <div class="external-event bg-info" id="0">Progres</div>
                    <div class="external-event bg-warning" id="1">Izin</div>
                    <div class="external-event bg-danger" id="2">Stop</div>
                    <div class="external-event bg-success" id="3">Selesai</div>
                    <div class="checkbox">
                        <label for="drop-remove">
                            <input type="checkbox" id="drop-remove">
                            Hapus Setelah Ditarik
                        </label>
                    </div>
                </div>
                <hr>
                <button class="btn btn-danger btn-block"><i class="fa fa-trash"></i> Hapus</button>
            </div>
        </div>
        <!-- /.card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Buat Event</h3>
            </div>
            <div class="card-body">
                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                    <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                    <ul class="fc-color-picker" id="color-chooser">
                        <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                    </ul>
                </div>
                <!-- /btn-group -->
                <div class="input-group">
                    <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                    <div class="input-group-append">
                        <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                    </div>
                </div>
                <!-- /input-group -->
            </div>
        </div>
    </div>
</div>
<div class="col-md-9">
    <div class="card card-primary">
        <div class="card-body p-0">
            <div id="calendar"></div>
        </div>
    </div>
</div>


<script>
    $(function () {

        /* initialize the external events
        -----------------------------------------------------------------*/
        function ini_events(ele) {
            ele.each(function () {

                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                }

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject)

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                })

            })
        }

        ini_events($('#external-events div.external-event'))

        /* initialize the calendar
        -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear()

        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendarInteraction.Draggable;

        var containerEl = document.getElementById('external-events');
        var checkbox = document.getElementById('drop-remove');
        var calendarEl = document.getElementById('calendar');

        // initialize the external events
        // -----------------------------------------------------------------

        new Draggable(containerEl, {
            itemSelector: '.external-event',
            eventData: function (eventEl) {
                // simpan ke database
                var id_user = $('#id_user').val()
                if(id_user == ''){
                    alert('Programmer harus dipilih');
                    return;
                }
                console.log(eventEl);
                return {
                    title: eventEl.innerText,
                    backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue(
                        'background-color'),
                    borderColor: window.getComputedStyle(eventEl, null).getPropertyValue(
                        'background-color'),
                    textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                };
            }
        });

        var calendar = new Calendar(calendarEl, {
            plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            allDaySlot: false,
            slotEventOverlap: false,
            eventOverlap: function (stillEvent, movingEvent) {
                return stillEvent.allDay && movingEvent.allDay;
            },
            'themeSystem': 'bootstrap',
            //Random default events
            // tempat olah data
            events:<?= json_encode($event) ?>,
            eventDrop: function (event, delta, revertFunc) {
                //inner column movement drop so get start and call the ajax function......
                console.log(event);
                // console.log(event.draggedEl.id);
                //alert(event.title + " was dropped on " + event.start.format());
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (info) {
                // is the "remove after drop" checkbox checked?
                // if (checkbox.checked) {
                //     // if so, remove the element from the "Draggable Events" list
                //     info.draggedEl.parentNode.removeChild(info.draggedEl);
                // }
                
                // else{
                    var id_project = $('#id_project').val();
                    var id_user = $('#id_user').val();
                    var tanggal = info.dateStr;
                    var status = info.draggedEl.id;
                    
                    if(id_user == ''){
                        alert('Programmer harus dipilih');
                        return;
                    }else{
                        axios.post("{{ route('projek-berjalan-timeline.store') }}", {
                            "id_project" : id_project,
                            "id_user" : id_user,
                            "tanggal" : tanggal,
                            "status" : status,
                        }).then(function(res){
                            var status = res.data.data;
                            var event = res.data.event;
                            location.reload(); 
                        }).catch(function(err){
                            console.log(err);
                        })
                    }
                    
                // }


            },
            eventRender: function (event, element) {

            }       
        });

        calendar.render();
        // $('#calendar').fullCalendar()

        /* ADDING EVENTS */
        var currColor = '#3c8dbc' //Red by default
        //Color chooser button
        var colorChooser = $('#color-chooser-btn')
        $('#color-chooser > li > a').click(function (e) {
            e.preventDefault()
            //Save color
            currColor = $(this).css('color')
            //Add color effect to button
            $('#add-new-event').css({
                'background-color': currColor,
                'border-color': currColor
            })
        })
        $('#add-new-event').click(function (e) {
            e.preventDefault()
            //Get value and make sure it is not null
            var val = $('#new-event').val()
            if (val.length == 0) {
                return
            }

            //Create events
            var event = $('<div />')
            event.css({
                'background-color': currColor,
                'border-color': currColor,
                'color': '#fff'
            }).addClass('external-event')
            event.html(val)
            $('#external-events').prepend(event)

            //Add draggable funtionality
            ini_events(event)

            //Remove event from text input
            $('#new-event').val('')
        })
    })

</script>
@endsection
