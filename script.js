console.log("hello");
$(document).ready(function(){
  $(".active").click();
    $(".side").click(function(){
      $(".side").removeClass("active");
      var clas=$(this).text().replaceAll(' ','');
      let text1 = ".";
      let text3 = text1.concat(clas);
      $(".Dashboard").hide();
      $(".Settings").hide();
      $(".Pages").hide();
      $(".Users").hide();
      $(".AddUser").hide();
      console.log(text3);
      $(text3).show();
      $(this).addClass("active");
    });
    if ($("#signerror").text() != "") {
      console.log("hello sign");
      $(".AddUser").show();
      $("#sign").click();
  }
    $('#myTable').DataTable();
  });