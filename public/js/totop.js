document.addEventListener("DOMContentLoaded", function () {
    var t = document.querySelector(".vanillatop"),
        e = 280;
        window.addEventListener("scroll", function () {
            document.body.scrollTop > e || document.documentElement.scrollTop > e
                ? (t.removeAttribute("style", "transform: translateX(120px);"),
                    t.setAttribute("style", "transform: translateX(0);"))
                : (t.removeAttribute("style", "transform: translateX(0);"),
                    t.setAttribute("style", "transform: translateX(120px);"));
        });
});
