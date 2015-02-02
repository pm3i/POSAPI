var index   = $('table tbody tr').length;
function add() {
    var index   = $('table tbody tr').length;
    var row     = $('script[type="text/html"]').text().replace(/\$\$name\$\$/g, index);
    
    $('table tbody').append(row);
}
 
if ($('table tbody tr').length === 0) {
    add();
}
 
$('table tbody :checkbox').live('click', function(event) {
    $('table tbody :checkbox').attr('checked', false);
    $(this).attr('checked', true);
});
 
$(document).ready($('a').live('click', function(event) {

    // alert("somethings");
    event.preventDefault();
    if ($(this).text() === "Add") {
        add();
    }
 
    if ($(this).text() === "Remove") {
        $(this).closest('tr').remove();
    }
 
    if ($('table tbody tr').length === 0) {
        add();
    }
}));