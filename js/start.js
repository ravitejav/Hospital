function formsubmit1()
{
  if(_("name").value!="" && _("phone").value!="" && _("email").value!="" && _("sub").value!="" && _("sug").value!="")
  {
      _("status").innerHTML="Please wait...";
  }
}
function _(id)
{
  return document.getElementById(id);
}
