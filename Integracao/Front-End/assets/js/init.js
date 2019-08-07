function copyrightOnFooter() {
  var d = new Date();
  var n = d.getFullYear();
  document.getElementById("copyright-js").innerHTML = " &copy; " + n;
}

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.modal');
  var instances = M.Modal.init(elems);
  var elems = document.querySelectorAll('.sidenav');
  var instances = M.Sidenav.init(elems);
});