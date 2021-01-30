


<button type="button" class="btn btn-info" data-toggle="modal" data-target="#uploadModal">Upload file</button>


<!-- The Modal remove-->
<div class="modal" id="uploadModal">
  <div class="modal-dialog">
    <div class="modal-content">

     <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Remove</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
    <!-- Modal body -->
    <div class="modal-body">

        <!-- <form method='post' action='' enctype="multipart/form-data"> -->
          Select file : <input type='file' name='file' id='file' class='form-control' ><br>
          <button type="button" class="btn btn-primary" id="" name="" onclick="s()"> add new example </button>
        <!-- </form> -->
<div id='preview'></div>
    </div>
  </div>
</div>

<script type="text/javascript">


   function  s(){

    var fd = new FormData();
    var files = $('#file')[0].files[0];
    fd.append('file',files);
alert ("ok 1");
    // AJAX request
    $.ajax({
      url: 'view/upload.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response){
        if(response != 0){
          // Show image preview
          $('#preview').append(
            "<img src='Pronunciation_English/"+response+"' width='100' height='100' style='display: inline-block;'>"
            );
        }else{
          alert('file not uploaded');
        }
      }
    });

}

</script>