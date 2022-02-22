function rupl(a, b) {
    var c = b.indexOf("[");
    if (c == -1) return b;
    a = a + "";
    var d = a.substr(-1),
        e = b.substr(c + 2, b.indexOf("]") - c - 2).split("|"),
        f = b.substr(0, c);
    if (l == "cs") {
        if (a != 0 && a < 5) return f + e[0];
        return f + e[1];
    }
    if (l == "mk") {
        if (a % 10 == 1 && a % 100 != 11) return f + e[1];
        return f + e[0];
    }
    if ((4 < a && a < 21) || "056789".indexOf(d) != -1) return f + e[0];
    if (1 == d) return f + e[1];
    return f + e[2];
}
function l0(a) {
    return a > 9 ? a : "0" + a;
}
function time_is_widget() {
    var ca = 0,
        tD = 0,
        tout = 0,
        updint = 1e3,
        tl = "",
        u = "undefined",
        units = ["years", "days", "hours", "minutes", "seconds"],
        df = {
            units: "long",
            leading_zeros: "automatic",
            template: "(years, )(days, )(hours, )(minutes, )seconds",
            unit_names: units,
            units_pl: ["years", "days", "hours", "minutes", "seconds"],
            units_abbr: ["y", "d", "h", "m", "s"],
            on_0: "Time is up!",
            headline: "Countdown",
            countdown_to: new Date().getTime() + 6e4,
            p: "",
        },
        q = [];
    this.init = function (a) {
        if (tout != 0) clearInterval(time_is_widget.tout);
        var b, c;
        for (b in a) {
            if (typeof a[b]["id"] == u) a[b]["id"] = b;
            if (typeof a[b]["v"] == u) q.push(a[b]["id"]);
            for (c in df) if (typeof a[b][c] == u) a[b][c] = df[c];
        }
        this.ca = a;
        if (0 < q.length) {
            b = document.createElement("script");
            b.setAttribute("src", "https://widget.time.is/?" + encodeURIComponent(q.join("..")) + "&t=" + new Date().getTime());
            c = document.getElementsByTagName("head").item(0);
            c.appendChild(b);
        } else this.tick();
    };
    this.cb = function (a, b, c) {
        var d = new Date(),
            e = 0;
        time_is_widget.tD = d.getTime() - a - Math.round((d - b) / 2);
        for (i in this.ca) {
            this.ca[i]["v"] = c[e];
            e++;
        }
        this.td = "t";
        this.tick();
    };
    this.tick = function () {
        var bl = 1,
            tU = new Date(),
            tut = 0,
            i,
            c,
            factor = [31536e3, 86400, 3600, 60, 1];
        if (this.tD == "t") this.tD = tD;
        tU.setTime(tU.getTime() - this.tD);
        if (document.getElementById) i = document.getElementById("time_is_link");
        else i = eval("time_is_link");
        if (null != i && i.href.indexOf("time.is/") != -1) bl = 0;
		
		var status = jQuery("#UTC_za00").data('status');
		var future = jQuery("#UTC_za00").hasClass('future') ? 'true' : 'false';
        for (i in this.ca) {
            c = this.ca[i];
            tm = c["template"];
            var lz = c["leading_zeros"],
                j,
                n,
                d,
                p,
                p2,
                p3,
                tm2,
                dift = c["countdown_to"] - tU.getTime(),
                diff = Math.ceil(dift / 1e3),
                remD = diff;
			
            if (diff <= 0) {
				if(status=="win"){
				}else{
					if(jQuery("#UTC_za00").hasClass('future')){
						location.reload(true);
					}else{
						updateAuctionStatus();
					}
				}
                tm = c["on_0"];
                bl = 0;
            } else {
				if (diff < 300 && jQuery("#UTC_za00").hasClass('live')) {
					var play_snipping = jQuery("#play_snipping").val();
					if(play_snipping=='no'){
						jQuery("#play_snipping").val("yes");
					}
				}
                if (lz == "automatic") {
                    if (9 < diff) lz = "invisible";
                    else lz = "off";
                }
                for (j in units) {
                    p = tm.indexOf(units[j]);
                    if (p != -1) {
                        n = Math.floor(remD / factor[j]);
                        if (n == 1) d = c["unit_names"][j];
                        else d = rupl(n, c["units_pl"][j]);
                        if (lz == "on") n = l0(n);
                        if (lz == "invisible" && n < 10) n = '<span style="visibility:hidden">0</span>' + n;
                        if (c["units"] == "long") n= '<span class="countdown_amount">'+n +'</span><br>' + d;
                        else if (c["units"] == "short") n = '<span class="countdown_amount">'+n +'</span><br>'+ c["units_abbr"][j];
                        p2 = tm.indexOf("(");
                        p3 = tm.indexOf(")");
                        if (p2 < p && p < p3) {
                            tm2 = tm.substr(p2 + 1, p3 - p2 - 1).replace(units[j], n);
                            p3++;
                            if (diff < factor[j]) tm2 = '<span class="countdown_amount">0</span><br>' + c["unit_names"][j];
                        } else {
                            p2 = p;
                            p3 = p + units[j].length;
                            tm2 = n;
                        }
                        tm = tm.substr(0, p2) + tm2 + tm.substr(p3);
                        remD = remD % factor[j];
                    }
                }
                n = (c["countdown_to"] - tU) % updint;
                if (n == 0) n = updint;
                if (tut == 0 || n < tut) tut = n;
                tm = tm.replace("headline", c["headline"]);
				/*if(z<10){
					if(c["units_pl"][j]=="Days" || c["unit_names"][j]=="Hours" || c["unit_names"][j]=="Minutes"){
						 tm = tm.replace("s",'');
					}else if(c["unit_names"][j]=="Seconds"){
						tm = tm.replace("Seconds",'Second');
					}
				}*/
				
            }
            if (bl && tm.indexOf("time.is/") == -1) tm = "Link back to Time.is is missing!";
            if (tm != c["p"]) {
                if (document.getElementById) o = document.getElementById(i);
                else o = eval();
                if (null != o) {
                    o.innerHTML = tm;
                    c["p"] = tm;
                }
            }
            if (typeof c["callback"] != u) eval(c["callback"] + "(" + d + ")");
        }
        if (tut) tout = setTimeout('time_is_widget.tick("")', tut);
    };
}
var time_is_widget = new time_is_widget();
