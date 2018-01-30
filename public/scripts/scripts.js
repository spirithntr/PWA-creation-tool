$(document).ready(function(){
  $('button').click(function(){
      var clickBtnId = $(this).attr('id');
      var ajaxurl = 'ajax.php',
      data =  {'action': clickBtnId};
      // console.log(clickBtnId);
      $.post(ajaxurl, data, function (response) {
          // Response div goes here.
          console.log(response);
          location.href = "pic1.zip";
          alert("action performed successfully");
      });
  });

});