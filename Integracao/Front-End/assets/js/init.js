(function($){
  $(function(){

    $('.sidenav').sidenav();
    $('select').formSelect();
    $('.modal').modal();
    //$('select').formSelect();
  });
})(jQuery);

function copyrightOnFooter() {
  var d = new Date();
  var n = d.getFullYear();
  document.getElementById("copyright-js").innerHTML = " &copy; " + n;
}
