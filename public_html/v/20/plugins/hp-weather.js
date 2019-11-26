/*! */

W.define("hpArticles", ["store", "http", "rootScope", "storage"], function(t, i, g, l) {
    var s=!1, h=l.get("articles")|| {}
    , a=function(e, n) {
        var t=n.data;
        if(!s&&t&&t.length) {
            if(t.forEach(function(e) {
                var n=e.id+"-"+e.updated, t=h[n];
                t?(e.count=t.count, e.checked=t.checked): e.count=e.checked=0, e.key=n
            }
            ), 2<=(t=t.filter(function(e) {
                return e.count<3
            }
            )).length&&3<=t[0].ranking-t[1].ranking) {
                var i=t.shift();
                (t=t.sort(function(e, n) {
                    return e.checked-n.checked
                }
                )).unshift(i)
            }
            else t=t.sort(function(e, n) {
                return e.checked-n.checked
            }
            );
            var a, r=window.innerHeight;
            if(e.style.display=null, t.length) {
                a=g.isMobile||r<707?c(t[0]): (2<t.length&&(t.length=2), t.map(c).join("")), e.innerHTML=a;
                var o=Date.now();
                Object.keys(h).forEach(function(e) {
                    2592e6<o-h[e].seen&&delete h[e]
                }
                ), l.put("articles", h)
            }
        }
    }
    , c=function(e) {
        var n=e.coverPhoto, t=e.slug, i=e.type, a=e.title, r=e.id, o=e.subtitle, l=e.key, s=e.importance, c=h[l], p=Date.now();
        c?432e5<(c.checked=p)-c.seen&&(c.seen=p, c.count++):h[l]= {
            seen: p, checked: p, count: 1
        }
        ;
        var d=/extreme|severe|moderate/.test(s)&&'<div class="article-warning warning-'+s+'">'+s+" warning</div>";
        return'<div class="article-announce-small bg-transparent clickable type-'+i+'" data-do="rqstOpen,articles,'+r+'">\n\t\t<span style="background-image: url(\''+n.src+"?w="+(g.isRetina?200:100)+"');\"></span>\n\t\t"+(d||"")+"\n\t\t"+(o&&!d?'<div class="article-subtitle size-s">'+o+"</div>":"")+'\n\t\t<a href="https://www.windy.com/articles/'+t+"-"+r+'" class="nomouse">'+a+"</a>\n\t</div>"
    }
    ;
    return {
        load:function(e) {
            var n= {
                homepage: 1, language: t.get("usedLang"), country: t.get("country"), target: g.target, device: g.device
            }
            ;
            // s=!1, i.get("/articles/related", {
            //     qs: n
            // }
            // ).then(a.bind(null, e)).catch(console.error)
        }
        , cancel:function() {
            return s=!0
        }
    }
}

),

/*! */

W.define("hpCapAlerts", ["broadcast", "hp", "trans", "format"], function(o, l, u, s) {
    var w= {
        R: "/", T: "î€—", N: "î€—", F: "î€Š", I: "î€³", H: "î€…", L: "î€…", W: "|", G: "î€¦", C: "î€Š", S: "î€€", Q: "î€©", A: "P"
    }
    ;
    return function(e, n, t) {
        var i=e.lat, a=e.lon, r=e.name, g=t.data;
        if(false&&g&&!l.cancelShow()) {
            var h=s.getHoursFunction();
            n.style.display=null, n.innerHTML=g.map(function(e) {
                e.weekday, e.hour;
                var n=e.severity, t=e.type, i=e.event, a=e.startLocal, r=e.endLocal, o=!1;
                24<i.length&&(i=i.substr(0, 24)+"...", o=!0);
                var l=a.weekday!==r.weekday, s=l&&o?"2": "", c=u[a.weekday+s], p=l&&u[r.weekday+s], d=c+" "+h(+a.hour)+" -"+(l?" "+p: "")+" "+h(+r.hour);
                return'<div class="cap-line clickable-size '+(1<g.length?"multiline": "")+'"\n\t\t\t\t\tdata-icon="'+w[t]+'"\n\t\t\t\t\tdata-severity="'+n+'">'+i+"\n\t\t\t\t\t<small>"+d+"</small></div>"
            }
            ).join(""), n.classList.add("show"), n.onclick=function() {
                return o.emit("rqstOpen", "cap-alert", {
                    lat: i, lon: a, name: r, source: "hp"
                }
                )
            }
        }
    }
}

),

/*! */

W.tag("hp-weather", '<div class="w-now"></div><div class="slider-wrapper"><canvas></canvas><table></table><div class="slider"></div><div class="slider-rain" style="display: none;"></div></div>', '.weather-box{width:392px;position:relative;margin-top:5px}#device-mobile .weather-box{width:100%}#warnings{width:100%;z-index:10;margin-top:2px;flex-direction:row;-webkit-flex-direction:row;-ms-flex-direction:row}#warnings .cap-line{font-size:14px;background-color:rgba(68,65,65,0.84);white-space:nowrap;line-height:1.6;margin-right:.3em;padding-right:1em;overflow:hidden;flex-grow:4;flex-basis:0;position:relative}#warnings .cap-line:last-child{margin-right:0}#warnings .cap-line::before{font-size:16px;display:block;float:left;font-weight:normal;text-align:center;position:relative;padding:.2em .3em;margin-right:.3em;line-height:normal;height:100%}#warnings .cap-line small{display:block;opacity:.6}#warnings .cap-line:not(.multiline) small{position:absolute;top:2px;right:6px}#warnings .cap-line.multiline{font-size:12px;line-height:1.4}#warnings .cap-line.multiline small{font-size:8px;padding-bottom:.3em}#warnings .cap-line.multiline::before{padding-top:.4em}#warnings .cap-line[data-severity="M"]::before{background-color:#b3b300}#warnings .cap-line[data-severity="S"]::before{background-color:#c17d00}#warnings .cap-line[data-severity="E"]::before{background-color:#a50000}#plugin-hp-weather{cursor:pointer;transition:all .5s;opacity:0;margin-top:10px;width:372px;white-space:nowrap}#plugin-hp-weather.open{opacity:1}.onsearch #plugin-hp-weather{display:none !important}#device-mobile #plugin-hp-weather{width:calc(100vw - 20px)}#plugin-hp-weather .slider-wrapper{width:calc( 100% - 100px )}#plugin-hp-weather .w-now,#plugin-hp-weather .slider-wrapper{display:inline-block;vertical-align:top}#plugin-hp-weather .w-now{width:100px;text-align:center;line-height:1;margin-top:-5px}#plugin-hp-weather .w-now big{font-size:67px;font-family:bariolnumbers,Arial,Helvetica,sans-serif;font-weight:normal}#plugin-hp-weather .w-now big sup{font-size:30px}#plugin-hp-weather .w-now .ws-wind{font-size:.8em;margin-left:.2em;color:#c1c1c1;margin-top:4px;display:block;font-size:12px;margin-left:-1em}#plugin-hp-weather .w-now .ws-wind div{display:inline-block;position:relative;top:1px}#plugin-hp-weather .w-now .ws-wind img{width:13.5px;display:inline-block;position:relative;margin-right:.3em;top:.2em}#articles .article-announce-small{padding:5px 10px 5px 110px;font-size:18px;line-height:1.4;letter-spacing:.02em;margin-bottom:5px;position:relative}#articles .article-announce-small span{width:100px;height:100%;display:block;position:absolute;left:0;top:0;background-size:cover;background-repeat:no-repeat;background-position-x:center;background-position-y:center}#articles .article-announce-small a{display:block}#articles .article-announce-small .article-warning{font-size:11px;border-radius:3px;padding:.1em .7em;position:relative;display:inline-block;top:-3px;letter-spacing:.05em;text-transform:uppercase}#articles .article-announce-small .article-warning.warning-extreme{background:#a50000}#articles .article-announce-small .article-warning.warning-severe{background:#c17d00}#articles .article-announce-small .article-warning.warning-moderate{background:#b3b300}', "", function(e) {
    var o=this, n=W.require, l=n("overlays"), s=n("utils"), a=n("store"), r=n("query"), c=n("rootScope"), p=n("$"), d=n("broadcast"), g=n("weatherRender"), h=n("hp"), u=n("reverseName"), w=n("hpCapAlerts"), m=n("hpArticles"), f=p("#articles"), v=p("#warnings");
    this.onopen=function(e) {
        var t=e.coords, i=e.promises;
        !function(n) {
            n.name&&r.set(n.name);
            if("location"!==a.get("startUp")||"gps"===n.source) {
                var e=a.get("startupReverseName");
                if(e&&s.isNear(n, e)&&e.lang===a.get("usedLang"))r.set(e.name), n.name=e.name;
                else {
                    var t="gps"===n.source?14: 6;
                    u.get(n, t).then(function(e) {
                        n.name=e.name, r.set(e.name), e.nameValid&&a.set("startupReverseName", e)
                    }
                    )
                }
            }
        }
        (t), i.wx.then(function(e) {
            var n=e.data;
            !h.cancelShow()&&n&&(r.hideLoader(), b(n, t), document.body.classList.add("onweather"), a.set("hpShown", !0), f.classList.add("show"), f.style.display="block", setTimeout(function() {
                h.cancelShow()||(i.capAlerts.then(w.bind(null, t, v)), m.load(f))
            }
            , 500))
        }
        ).catch(function(e) {
            console.error(e), h.hide()
        }
        )
    }
    , this.onclose=function(e) {
        r.hideLoader(), r.set(""), f.classList.remove("show"), v.classList.remove("show"), a.set("hpShown", !1), d.emit("hpHidden"), e&&e.target&&"q"===e.target.id?(t(), r.element.focus()): setTimeout(t, 500)
    }
    ;
    var t=function() {
        h.cancelShow()&&document.body.classList.remove("onweather"), m.cancel(), v.style.display=f.style.display="none"
    }
    , b=function(e, n) {
        var t=n.lat, i=n.lon, a=n.name, r=e.now;
        g.renderFragment(p(".slider-wrapper", o.node), e, {
            iconSize: 27, addRain: !0, days: o.node.offsetWidth<350?3: 4, bgHeight: 60
        }
        ), r&&(r.dir=r.windDir, p(".w-now", o.node).innerHTML="\n\t\t\t\t\t<big>"+l.temp.convertNumber(r.temp)+'<sup>Â°</sup></big>\n\t\t\t\t\t<span class="ws-wind"><img src="'+c.iconsDir+"/png_27px/"+r.icon+'.png">\n\t\t\t\t\t'+s.windDir2html(r)+" "+(r.wind?l.wind.convertValue(r.wind, " "):"")+"</span>"), o.node.onclick=function() {
            return d.emit("rqstOpen", "detail", {
                lat: t, lon: i, name: a, source: "hp"
            }
            )
        }
    }
}

);