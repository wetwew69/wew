//**************************
//Sample Modal Body and Chart
//**************************
$('#exampleModal').on('shown.bs.modal', function (event) {});

    //var button = $(event.relatedTarget);
    var modal = $(this);
    var canvas = modal.find('.modal-body canvas');

    // Chart initialisieren
    var ctx = canvas[0].getContext("2d");
    var chart = new Chart(ctx).Line({
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                fillColor: "rgba(190,144,212,0.2)",
                strokeColor: "rgba(190,144,212,1)",
                pointColor: "rgba(190,144,212,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [65, 59, 80, 81, 56, 55, 40]
            }
        ]
    }, {});