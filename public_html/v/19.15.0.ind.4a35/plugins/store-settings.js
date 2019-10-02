/*! */
W.define("store-settings",["http","recents","dataSpecifications","utils","broadcast","storage","store","rootScope","products","favs","log","geolocation"],function(e,t,s,a,i,n,r,o,g,l,c,d){var u=l.getArray(),w=n.get("webGLtest3"),f=n.get("promos2"),v=Object.keys(t.getAll()),m=r.get("firstUserSession"),p=Object.keys(c.clientLog).sort().map(function(e){return e+": "+c.clientLog[e]}).join("\n"),h=r.getDeviceID(),S=n.get("favsLastBackup")||0,b=d.getMyLatestPos(),y={deviceId:h,minifest:g.ecmwf.refTime(),localStorage:n.isAvbl,firstSession:new Date(m).toISOString(),url:window.location.href,ua:window.navigator.userAgent,ver:o.version,target:o.target,user:o.user&&o.user.username,session:o.sessionCounter,lang:r.get("usedLang"),retina:o.isRetina,size:window.screen.width+"x"+window.screen.height,screenWidth:window.screen.width,screenHeight:window.screen.height,glParticles:o.glParticlesOn,platform:o.platform,cc:r.get("country"),place:b.name,positionSource:b.source,favs:u.length,alerts:u.filter(function(e){return"alert"===e.type}).length,favAds:u.filter(function(e){return"airport"===e.type}).length,webGL:w&&w.status,promos:f&&JSON.stringify(f),recents:v.length,isImperial:r.get("isImperial"),loadingTime:o.loadedTime-W.startTs,renderingTime:o.renderedTime-o.loadedTime,missingLang:o.missingLang,browserLang:o.prefLang,isTouch:o.isTouch,device2:o.isMobile?"mobile":o.isTablet?"tablet":"desktop",stat:p};y.daysWithUs=Math.round((Date.now()-m)/(24*a.tsHour))+1,y.seesionsPerDay=o.sessionCounter/y.daysWithUs;var L=n.get("version");if(L?L!==o.version&&(y.install="upgrade",y.upgradeFrom=L):y.install="install",n.put("version",o.version),window.device&&(y.manufacturer=window.device.manufacturer,y.model=window.device.model),"index"===W.target&&(window.top!==window.self?y.target="unlegalIframe":/Android.* wv\)/.test(window.navigator.userAgent)?y.target="unlegalWebView":window.cordova&&(y.target="unlegalCordova")),n.isAvbl){try{a.each(s,function(e,t){var s="settings_"+t;if(e&&e.save&&s in localStorage&&!/email|country|session/i.test(t)){var i=n.get(s);if(null===i)return;y[s]=i!==Object(i)?i:a.isArray(i)?i.length:"Object"}})}catch(e){y.note="key in localStorage failed"}["rateDialogShown","cordovaLastTimestamp","storedSettings","storedFavs","lastSyncableUpdatedItem","favs_ts","recents4_ts"].forEach(function(e){var t=n.get(e);t&&(y[e]=new Date(t).toISOString())})}e.post("/sedlina/settings",{data:y});var T=Date.now();!o.user&&1<u.length&&T-S>168*a.tsHour&&(n.put("favsLastBackup",T),e.post("/users/favsBackup",{data:{version:2,user:h,data:l.data,storeTs:T}})),i.emit("settingsStored",y)});