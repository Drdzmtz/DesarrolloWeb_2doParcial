import * as Checks from './modules/checks.js';

window.addEventListener('load', () => {

	document.getElementById("data-login").addEventListener('submit', ev => {
		let errs = "".concat(...[
			Checks.check("f-usuario",      "Usuario",       Checks.is_blank),
            Checks.check("f-password",     "Contraseña",    Checks.is_blank),
            Checks.check("f-captcha",      "Captcha",       Checks.is_blank),
		]);

		if(errs) {
			alert(errs);
			ev.preventDefault();
		}
	});

});