$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#content').toggleClass('active');
        $(this).toggleClass('active');
    });
    $('#raw-data').on('click', function () {
        $(this).toggleClass('active');
        deactivateElement(['#kmeans','#timeseries']);
        $('#igraph').attr('src','../rawData.html');
    });
    $('#kmeans').on('click', function () {
        $(this).toggleClass('active');
        deactivateElement(['#raw-data','#timeseries']);
        $('#igraph').attr('src','../kmeans.html');
    });
    $('#timeseries').on('click', function () {
        $(this).toggleClass('active');       
        deactivateElement(['#raw-data','#kmeans']);
        $('#igraph').attr('src','../timeseries.html');
    });
});

function deactivateElement(elements){
    for (i=0; i<elements.length; i++) {
        $(elements[i]).removeClass('active')
    }
}