function refresh_tartalom(ik)
{
  var mitirki=document.getElementById("kiirni");
  if(ik==1)
	{
	  document.form_refr.submit();
	  return;
	}
	if(mitirki.value!="")
	{
	  var doc_tart=parent.frame_kapott.document.getElementById("tartalom");
	  doc_tart.innerHTML+=mitirki.value;
	  parent.frame_kapott.window.scrollBy(0,-1);
	  parent.frame_kapott.window.scrollTo(0,10000);
	}
//  window.setTimeout("refresh_tartalom(1)", 1000*<?=$refreshtime ?>);
}

refresh_tartalom(0);

//-->