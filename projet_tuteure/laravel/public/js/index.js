function openNavLeft() {
	document.getElementById("menu-open-left").style.width = "300px";
	document.getElementById("menu-open-left").style.minWidth = "300px";
}

function closeNavLeft() {
	document.getElementById("menu-open-left").style.width = "0";
	document.getElementById("menu-open-left").style.minWidth = "0";
}

function openNavRight() {
	document.getElementById("menu-open-right").style.width = "300px";
	document.getElementById("menu-open-right").style.minWidth = "300px";
    document.getElementById("button-co-ad").style.display = "none";
	document.getElementById("close-menuRight").style.display = "block";

}

function closeNavRight() {
	document.getElementById("menu-open-right").style.width = "0";
	document.getElementById("menu-open-right").style.minWidth = "0px";
    document.getElementById("button-co-ad").style.display = "block";
	document.getElementById("close-menuRight").style.display = "none";

}

function closeHistory() {
	document.getElementById("history-open").style.width = "0";
	document.getElementById("history-open").style.minWidth = "0px";
}


function closeCommentary() {
	document.getElementById("commentary-open").style.width = "0";
	document.getElementById("commentary-open").style.minWidth = "0px";
}


function closeAddStr() {
	document.getElementById("casc-open-str").style.height = "0";
}

function openAddSup() {
	document.getElementById("casc-open-sup").style.height = "100%";

}

function closeAddSup() {
	document.getElementById("casc-open-sup").style.height = "0";
}

function openAddCon() {
	document.getElementById("casc-open-con").style.height = "100%";

}

function closeAddCon() {
	document.getElementById("casc-open-con").style.height = "0";
}

function openAddLife() {
	document.getElementById("casc-open-life").style.height = "100%";

}

function closeAddLife() {
	document.getElementById("casc-open-life").style.height = "0";
}

function openAddIce() {
	document.getElementById("casc-open-ice").style.height = "100%";

}

function closeAddIce() {
	document.getElementById("casc-open-ice").style.height = "0";
}
