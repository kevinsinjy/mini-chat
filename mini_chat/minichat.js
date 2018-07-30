var auto_refresh = setInterval(     
    function () {
        $('#refresh').load('store.php').fadeIn("slow");     
    } 
, 2000); // refresh every 2000 milliseconds