function setCookie(name, value, exdays)
{
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	var expires = "expires="+d.toUTCString();
	document.cookie = name + "=" + value + "; " + expires;
}

function getCookie(name)
{
	var nom = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++)
	{
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1);
		if (c.indexOf(nom) == 0) return c.substring(nom.length,c.length);
	}
	return "";
}

function checkCookie()
{
	var value = document.getElementById('ft_list');
	value.innerHTML = decodeURIComponent(getCookie('ma_div'));
}

function delete_div(new_div) {
	if (confirm("Avez vous vraiment finis cette tache ?")) {
		var ma_div = document.getElementById('ft_list');
		ma_div.removeChild(new_div);
		var value = encodeURIComponent(ma_div.innerHTML);
		setCookie('ma_div', value, 1);
	}
}

function create_div() {
	var text = prompt("Saisissez votre to do ici:");
	if (text) {
		var ma_div = document.getElementById('ft_list');
		var new_div = document.createElement('div');
		new_div.id = "to_do";
		new_div.setAttribute("onclick", "delete_div(this)");
		var text = document.createTextNode(text);
		new_div.appendChild(text);
		ma_div.insertBefore(new_div, ma_div.firstChild);
		var value = encodeURIComponent(ma_div.innerHTML);
		setCookie('ma_div', value, 1);
	}
}
