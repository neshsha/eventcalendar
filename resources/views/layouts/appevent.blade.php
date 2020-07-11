<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Scheduler</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <!-- BOOTSTRAP -->
   <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- JQuery datatables -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Full calendar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

     <style>
        html, body {
                background-image: url('/pictures/background-image.jpg');
                background-attachment: fixed;;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover; 
                margin:0;

            }
    </style>
    
</head>

<body>

    <div id="app">

        <main class="py-4">
            @yield('content')
        </main>

    </div>

<!-- SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>


<!-- Calendar script -->
{!! $calendar->script() !!}


<script>

$(function() {

 //Highlight date field

    $('.fc-day').on('mouseover', function(e) {
        $(this).css('background-color', '#aaa');
    });

    $('.fc-day').on('mouseout', function(e) {
        $(this).css('background-color', '#fff');
    });

//Add event

    $('.fc-day').on('click', function(e) {
      
        jQuery.noConflict(); 

        var date = $(this).attr('data-date');

        $('#exampleModal').modal('toggle');

        var modal = $('#exampleModal');

        modal.find('.modal-title').text('New event for ' + date);
        modal.find('.modal-body input[name="start_date"]').val(date);
        modal.find('.modal-body input[name="end_date"]').val(date);

   
    }); 

//Update OR Delete Event

     $('.fc-day-grid-event').on('click', function(e) {

        e.preventDefault();

        jQuery.noConflict();
        
        var href = $(this).attr('href');
        var id = href.split('/')[2];
        var date = href.split('/')[3];
        var event_name = href.split('/')[4];

        
        $('#updateModal').modal('toggle');

        var modal = $('#updateModal');

        modal.find('.modal-title').text('Update event for ' + date);
        modal.find('.modal-body input[name="event_name"]').val(event_name);
        modal.find('.modal-body input[name="start_date"]').val(date);
        modal.find('.modal-body input[name="end_date"]').val(date);
        modal.find('.modal-body input[name="id"]').val(id);
        modal.find('.modal-body a').attr('href', '/events/destroy/' + id);

    });

     
});


</script>

</body>
</html>
