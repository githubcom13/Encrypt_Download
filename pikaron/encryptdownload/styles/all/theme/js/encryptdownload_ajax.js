var req_ED;
var url_ED;

// Reload Object
function Reload_Body_ED(url_ED,name)
{
	// Remove Accents
	url_ED = RemoveAccents(url_ED);
	Processing_ED(name);
	SendQuery_ED(url_ED,'DisplayContent_ED("'+name+'")');
	return false;
}

// Remove Accents
function RemoveAccents(strAccents) {
	var strAccents = strAccents.split('');
	var strAccentsOut = new Array();
	var strAccentsLen = strAccents.length;
	var accents = 'ÀÁÂÃÄÅĄĀāàáâãäåąßÒÓÔÕÕÖØŐòóôőõöøĎďDŽdžÈÉÊËĘèéêëęðÇçČčĆćÐÌÍÎÏĪìíîïīÙÚÛÜŰùűúûüĽĹŁľĺłÑŇŃňñńŔŕŠŚŞšśşŤťŸÝÿýŽŻŹžżźđĢĞģğ';
	var accentsOut = "AAAAAAAAaaaaaaaasOOOOOOOOoooooooDdDZdzEEEEEeeeeeeCcCcCcDIIIIIiiiiiUUUUUuuuuuLLLlllNNNnnnRrSSSsssTtYYyyZZZzzzdGGgg";
	for (var y = 0; y < strAccentsLen; y++) {
		if (accents.indexOf(strAccents[y]) != -1) {
			strAccentsOut[y] = accentsOut.substr(accents.indexOf(strAccents[y]), 1);
		} else
			strAccentsOut[y] = strAccents[y];
	}
	strAccentsOut = strAccentsOut.join('');
	return strAccentsOut;
}

// Init Xmlhttp Object
function Initialize_ED()
{
	try
	{
		req_ED = new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
		try
		{
			req_ED = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(oc)
		{
			req_ED = null;
		}
	}

	if(!req_ED && typeof XMLHttpRequest != "undefined")
	{
		req_ED = new XMLHttpRequest();
	}

}

// Display loading while tranfering data , call it before SendQuery function
// name parameter is the name of div tag
function Processing_ED(name)
{
	obj = document.getElementById(name);
	obj.innerHTML = '<table style="width: 660px;"><tr><td><center><img border="0" src="ext/pikaron/encryptdownload/images/icons/loading.gif" align="absbottom"></center></td></tr></table>';
}

// callbackFunction parameter is the function will process returned data
function SendQuery_ED(url_ED,callbackFunction)
{
	// Init Object
	Initialize_ED();

	if ( (req_ED != null) )
	{
		req_ED.onreadystatechange = function()
		{
			// only if req shows "complete"
			if (req_ED.readyState == 4)
			{
				// only if "OK"
				if (req_ED.status == 200)
				{
					// Process
					eval(callbackFunction);
				}
			}
		};
		url_ED += "&rand="+Math.random()*1000;
		req_ED.open("GET", url_ED , true);
		req_ED.send(null);
	}
}

// Display content after data is recieved
// name parameter is the name of div tag
function DisplayContent_ED(name)
{
	obj = document.getElementById(name);
	obj.innerHTML = req_ED.responseText;
}