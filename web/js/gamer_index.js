
function ajax_set_server(obj, url)
{
    $.get(url,
        {
            server_id:obj.val()
        },
        function(ret){
            if (ret.ok) {
                window.location.reload();
            } else {
                alert(ret.msg);
            }
        },
        'json'
    );
}
