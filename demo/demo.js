$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#content').toggleClass('active');
        $(this).toggleClass('active');
    });
    $('#unclustered').on('click', function () {
        $(this).toggleClass('active');
        deactivateElement(['#clustered','#timeseries']);
        $('#igraph').attr('src','../unclustered-plot.html');
    });
    $('#clustered').on('click', function () {
        $(this).toggleClass('active');
        deactivateElement(['#unclustered','#timeseries']);
        $('#igraph').attr('src','../clustered-plot.html');
    });
    $('#timeseries').on('click', function () {
        $(this).toggleClass('active');       
        deactivateElement(['#unclustered','#clustered']);
        $('#igraph').attr('src','../timeseries-plot.html');
    });
});

function deactivateElement(elements){
    for (i=0; i<elements.length; i++) {
        $(elements[i]).removeClass('active')
    }
}