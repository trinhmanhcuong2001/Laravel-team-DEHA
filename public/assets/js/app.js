import loadTask from "./roles/role.js";
    
$('#keyword').on('keyup', () => {
    const keyword = $('#keyword').val();
    const url = $('#url').val();

    loadTask(url, keyword).done(function(result) {
        $('#role-table-body').html(result.html);
    }).fail(function(xhr, status, error) {
        console.error('AJAX Error: ', status, error);
    });
});