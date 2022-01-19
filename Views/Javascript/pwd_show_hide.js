function togglePwView(x) {

    var pw = document.getElementById("password");
    var cPw = document.getElementById("confirm_password");
    x.classList.toggle("fa-eye-slash");
    if (pw.type === "password") {
        pw.type = "text";
    } else {
        pw.type = "password";
    }
    if (cPw.type === "password") {
        cPw.type = "text";
    } else {
        cPw.type = "password";
    }
}