                               
$(document).ready(function() {
    $("#level").change(function(){
        if($(this).val()==2)
        {
            $("#parent").prop('disabled', false);
        }else {
            $("#parent").val("null");
            $("#parent").prop('disabled', true);
        }
    });
});
