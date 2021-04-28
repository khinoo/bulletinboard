$(document).ready(function () {
    var dateControl = document.querySelector('input[type="date"]');
    if(dateControl != null){
      var dob = document.getElementById("dateofbirth").value;
      dateControl.value = dob;
    }
    $(document).on('click', '#postdetail', function(event) {
       $id =  $(this).attr('data-id');
       $('#title').val($(".title_"+$id).val());
       $('#description').val($(".des_"+$id).val());
       $('#status').val($(".status_"+$id).val());

        var str = $(".created_at_"+$id).val();
        var cyear = str.substr(0, 4);
        var cmonth = str.substr(5, 2);
        var cdate = str.substr(8, 2);
        var created_at = cyear +'/'+ cmonth +'/'+cdate;

       $('#created_at').val(created_at);
       $('#created_user_id').val($(".created_user_"+$id).val());
    });

     $(document).on('click', '#userdetail', function(event) {
       $id =  $(this).attr('data-id');
       var str = $(".dob_"+$id).val();
        var dobyear = str.substr(0, 4);
        var dobmonth = str.substr(5, 2);
        var dobdate = str.substr(8, 2);
        var dob = dobyear +'/'+ dobmonth +'/'+dobdate;
       $('#username').val($(".name_"+$id).val());
       $('#useremail').val($(".email_"+$id).val());
       $('#phone').val($(".phone_"+$id).val());
       $('#address').val($(".address_"+$id).val());
       $('#dob').val(dob);
    });
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });
    $(document).on('click', '#deleteModal', function(event) {
      var id = $(this).attr('data-id');
      $('#userForm').attr("action", '/deletepost/'+id);
    });
});
