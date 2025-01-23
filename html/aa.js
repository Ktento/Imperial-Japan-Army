function sadako() {
	if (confirm("あなたは貞子ですか？")) {
		confirm("では、あなたは怨霊ですか？");
		alert("あなたは呪われてしまいました");
	} else {
		alert("あなたは呪われてしまいました");
	}
}

function noroi() {
	const tds = document.querySelectorAll("td, th");
	const sizes = [
		Math.random() * 200,
		Math.random() * 200,
		Math.random() * 200,
		Math.random() * 200,
		Math.random() * 200,
	];
	for (let i = 0; i < tds.length; i++) {
		tds[i].innerText = "呪";
		const size = sizes[i % sizes.length];
		tds[i].style.fontSize = size + "px";
	}
	// window.setInterval(noroi2, 750);
	// noroi2();
}
function noroi2() {
	const tds = document.querySelectorAll("td, th");
	const sizes = [
		Math.random() * 360,
		Math.random() * 360,
		Math.random() * 360,
		Math.random() * 360,
		Math.random() * 360,
		Math.random() * 360,
		Math.random() * 360,
		Math.random() * 360,
		Math.random() * 360,
		Math.random() * 360,
		Math.random() * 360,
		Math.random() * 360,
		Math.random() * 360,
		Math.random() * 360,
		Math.random() * 360,
		Math.random() * 360,
		Math.random() * 360,
		Math.random() * 360,
	];
	const size = sizes;
	if (false) {
		css.innerHTML += `tr:nth-child(odd) td:nth-child(odd), th { transform: rotateX(${size[1]}deg) rotateY(${size[2]}deg) rotateZ(${size[3]}deg) }
			tr:nth-child(odd) td:nth-child(even) { transform: rotateX(${size[4]}deg) rotateY(${size[5]}deg) rotateZ(${size[6]}deg) }
			tr:nth-child(even) td:nth-child(odd) { transform: rotateX(${size[7]}deg) rotateY(${size[8]}deg) rotateZ(${size[9]}deg) }
			tr:nth-child(even) td:nth-child(even) { transform: rotateX(${size[10]}deg) rotateY(${size[11]}deg) rotateZ(${size[12]}deg) }`;
	} else {
		for (let i = 0; i < tds.length; i++) {
			const size = sizes[i % sizes.length];
			const size2 = sizes[(i+1) % sizes.length];
			const size3 = sizes[(i+2) % sizes.length];
			tds[i].style.transform = `rotateX(${size}deg) rotateY(${size2}deg) rotateZ(${size3}deg)`;
		}
	}
}

let css = null;
css = document.createElement("style");
css.innerHTML = "* { background: red; font-family: serif; }";

function addCSS() {
	document.body.prepend(css);
}

let origin = null;

function addButton2() {
	const btn2 = document.createElement("button");
	btn2.addEventListener("click", function() {
		// css.innerHTML = "* { background: white!important; }";
		// css.innerHTML += "html { background-image: linear-gradient(red, black)!important; }";
		css.innerHTML = "* { background-image: url(/sadakobig.jpg)!important; color: transparent; border: none; } td { height: 1080px; }";
		// document.body.outerHTML = origin;
		addCSS();
	});
	btn2.innerHTML = "<span style='font-size: 50px'>成仏する</span>";
	document.body.prepend(btn2);
}

function addButton1() {
	if (origin === null) origin = document.body.outerHTML;
	const btn = document.createElement("button");
	btn.addEventListener("click", function() {
		sadako();
		noroi();
		addCSS();
		btn.innerHTML = "呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪呪";
		addButton2();
	});
	btn.innerHTML = "<span style='font-size: 50px'>☢危険⚠！！！！押すな！！！！</span>";
	document.body.prepend(btn);
}


// sadako();
addButton1();
addCSS();
//noroi();
