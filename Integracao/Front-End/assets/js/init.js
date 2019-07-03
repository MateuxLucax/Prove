(function($){
  $(function(){

    $('.sidenav').sidenav();
    $('select').formSelect({
      coverTrigger:false
    });
    $('.modal').modal();
    $('.chips').chips();
  });
})(jQuery);

function copyrightOnFooter() {
  var d = new Date();
  var n = d.getFullYear();
  document.getElementById("copyright-js").innerHTML = " &copy; " + n;
}
