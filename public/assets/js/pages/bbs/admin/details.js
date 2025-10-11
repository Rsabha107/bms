!(function () {
    "use strict";
    (() => {
        const e = document.querySelectorAll(".count-input");
        if (0 === e.length) return;
        const t = (e) => {
                const t =
                        e.currentTarget.parentNode.querySelector(
                            ".form-control"
                        ),
                    n = parseInt(t.getAttribute("max")) || 1 / 0;
                t.value < n && (t.value++, i(t));
            },
            n = (e) => {
                const t =
                        e.currentTarget.parentNode.querySelector(
                            ".form-control"
                        ),
                    n = parseInt(t.getAttribute("min")) || 0;
                t.value > n && (t.value--, i(t));
            },
            i = (e) => {
                const t = e.parentNode.querySelector("[data-decrement]"),
                    n = e.parentNode.querySelector("[data-increment]"),
                    i = parseInt(e.getAttribute("min")) || 0,
                    s = parseInt(e.getAttribute("max")) || 1 / 0;
                (t.disabled = e.value <= i), (n.disabled = e.value >= s);
                const o = e.closest(".count-input");
                if (!o.classList.contains("count-input-collapsible")) return;
                const r = n.querySelector("[data-count-input-value]");
                e.value > 0
                    ? (o.classList.remove("collapsed"),
                      r && (r.textContent = e.value))
                    : (o.classList.add("collapsed"), r && (r.textContent = ""));
            };
        e.forEach((e) => {
            const s = e.querySelector("[data-increment]"),
                o = e.querySelector("[data-decrement]"),
                r = e.querySelector(".form-control");
            s.addEventListener("click", t),
                o.addEventListener("click", n),
                i(r);
        });
    })(),
        (() => {
            const e = document.querySelectorAll("[data-swiper]");
            0 !== e.length &&
                e.forEach((e, t) => {
                    var n;
                    let i;
                    var s;
                    void 0 !== e.dataset.swiper &&
                        "" !== e.dataset.swiper &&
                        ((i = JSON.parse(e.dataset.swiper)),
                        null == (s = i) ||
                            null == (s = s.thumbnails) ||
                            s.images);
                    const o = new Swiper(e, i);
                    if (null != (n = i) && n.controlSlider) {
                        let e = [];
                        Array.isArray(i.controlSlider)
                            ? (e = i.controlSlider.map((e) =>
                                  document.querySelector(e)
                              ))
                            : e.push(document.querySelector(i.controlSlider));
                        const t = e.map((e) => {
                            const t =
                                (null == e ? void 0 : e.dataset.swiper) &&
                                JSON.parse(e.dataset.swiper);
                            return new Swiper(e, t);
                        });
                        o.controller.control = t;
                    }
                });
        })();
})();
