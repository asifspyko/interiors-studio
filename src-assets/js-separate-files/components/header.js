var body = document.querySelector("body");
var siteNavigation = document.getElementById('siteNavigation');
siteNavigation.addEventListener('show.bs.collapse', function () {
  body.classList.add("overflow-stopped");
})

siteNavigation.addEventListener('hide.bs.collapse', function () {
  body.classList.remove("overflow-stopped");
});
