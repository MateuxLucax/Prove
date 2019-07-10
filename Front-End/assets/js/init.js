(function($){
  $(function(){

    $('.sidenav').sidenav();
    $('select').formSelect();
    $('.modal').modal();
    $('.datepicker').datepicker({
      format: 'dd/mm/yyyy'
    });
    
  });
})(jQuery);


function copyrightOnFooter() {
  var d = new Date();
  var n = d.getFullYear();
  document.getElementById("copyright-js").innerHTML = " &copy; " + n;
}
