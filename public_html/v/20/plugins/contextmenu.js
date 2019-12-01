/*! */
// <a data-do="detail" class="clickable-size" data-t="D_FCST" data-icon="&"></a>
// <a data-do="sounding" class="clickable-size" data-t="SOUNDING" data-icon="&#xe015;"></a>

W.tag("contextmenu", '<div class="context-coords" data-do="copy" data-tooltipsrc="COPY_TO_C"></div><nav class="menu-items" data-ref="menu"><a data-do="picker" class="clickable-size" data-t="SHOW_PICKER" data-icon="&#xe034;"></a><a data-do="rplanner" class="clickable-size" data-t="MENU_DISTANCE" data-icon=","></a><a data-do="pickerx" class="clickable-size" data-t="ADD_RADAR" data-icon="&#xe015;"></a></nav>', "#plugin-contextmenu{font-size:12px;padding:.5em .7em;line-height:2;z-index:100}#plugin-contextmenu .closing-x{display:none}#plugin-contextmenu .context-coords{color:#9D0300;margin-bottom:.3em}#device-mobile #plugin-contextmenu{font-size:18px;position:fixed;left:20px;top:20px;right:20px}#device-mobile #plugin-contextmenu::before,#device-mobile #plugin-contextmenu::after{display:none}", "", function(e) {
    var n, t, a, o = this,
        i = W.require,
        c = i("broadcast"),
        l = i("$"),
        d = i("rootScope"),
        s = i("format"),
        r = i("map"),
        p = i("ClickHandler"),
        u = i("plugins"),
        m = i("utils");
    p.instance({
        el: this.node,
        stopPropagation: !0,
        click: function(e) {
            switch (e) {
                case "copy":
                    m.copy2clipboard(a);
                    break;
                default:
                    /^windy-plugin|detail|sounding|picker|rplanner/.test(e) && c.emit("rqstOpen", e, {
                        lat: n.lat,
                        lon: n.lng,
                        source: "contextmenu"
                    })
            }
            "copy" !== e && c.emit("rqstClose", "contextmenu")
        }
    });
    var x = function(e) {
        var n = u[e];
        n && "hook" in n && "contextmenu" === n.hook && (o.refs.menu.insertAdjacentHTML("beforeend", '<a data-do="' + n.ident + '" data-icon="&#xe03e;">' + n.title + "</a>"), n.hook = null)
    };
    Object.keys(u).forEach(x), c.on("externalPluginLoaded", x), this.onopen = function(e) {
        var i = e.latlng,
            c = e.containerPoint;
        n = i instanceof L.LatLng ? i.wrap() : i;
        var p = s.DD2DMS(n.lat, n.lng);
        a = m.normalizeLatLon(n.lat) + ", " + m.normalizeLatLon(n.lng), l(".context-coords", o.node).innerHTML = p, !d.isMobile && c && (o.node.style.left = c.x - 25 + "px", o.node.style.top = c.y + 10 + "px"), t ? t.setLatLng(n) : t = L.marker(n, {
            icon: r.myMarkers.pulsatingIcon,
            zIndexOffset: -300
        }).addTo(r)
    }, this.onclose = function() {
        t && (r.removeLayer(t), t = null)
    }
});