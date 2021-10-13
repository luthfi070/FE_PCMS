<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">

    <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
    <link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">

    <style type="text/css">
        html,
        body {
            height: 100%;
            padding: 0px;
            margin: 0px;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div id="gantt_here" style='width:100%; height:100%;'></div>

</body>
<script src="{{url('assets/js/jquery.min.js')}}"></script>
<script src="{{url('assets/js/popper.min.js')}}"></script>
<script type="text/javascript">
    data = {
        "tasks": [{
                "id": "1",
                "text": "Project #2",
                "start_date": "01-04-2020",
                "duration": 18,
                "progress": 0.4,
                "open": true
            },
            {
                "id": "2",
                "text": "Task #1",
                "start_date": "02-04-2020",
                "duration": 8,
                "progress": 0.6,
                "parent": "1"
            },
            {
                "id": "3",
                "text": "Task #2",
                "start_date": "11-04-2020",
                "duration": 8,
                "progress": 0.6,
                "parent": "1"
            }
        ]
    };
    var url = $(location).attr('href').split("/").splice(4, 5);

    $.ajax({
        type: "POST",
        url: '/getWbsGantt/',
        data: {
            _token: "{{ csrf_token() }}",
            id: url[0]
        },
        dataType: "JSON"
    }).done(function(msg) {
        data = {
            "tasks": msg
        };

        gantt.init("gantt_here");

        gantt.parse(data);
        $(".gantt_add").css("display", "none");
        gantt.attachEvent("onTaskCreated", function(task) {
            task.preventDefault();

            return false;
        });
        gantt.config.readonly = true;
        gantt.config.columns = [{
                name: "text",
                label: "Task name",
                width: "*",
                tree: true
            },
            {
                name: "start_date",
                label: "Start time",
                align: "center"
            },
            {
                name: "duration",
                label: "Duration",
                align: "center"
            }
        ];
    }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
</script>