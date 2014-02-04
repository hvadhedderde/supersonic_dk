
/*seg_basic.js*/
if(!u || !Util) {
	var u, Util = u = new function() {}
	u.version = 0.7;
	u.bug = function() {}
	u.stats = new function() {this.pageView = function(){};this.event = function(){};this.customVar = function(){}}
}

/*u-init.js*/
Util.Objects = u.o = new Object();
Util.init = function(scope) {
	var i, node, nodes, object;
	scope = scope && scope.nodeName ? scope : document;
	nodes = u.ges("i\:([_a-zA-Z0-9])+");
	for(i = 0; node = nodes[i]; i++) {
		while((object = u.cv(node, "i"))) {
			u.rc(node, "i:"+object);
			if(object && typeof(u.o[object]) == "object") {
				u.o[object].init(node);
			}
		}
	}
}

/*i-unsupported.js*/
Util.Objects["page"] = new function() {
	this.init = function(page) {
		document.body.innerHTML = '<h1 style="text-align: center; margin: 20%;">Your browser is NOT supported. It is more outdated than steam-engines, typewriters and VHS tapes, so stop acting surprised.</h1>';
	}
}
u.e.addDOMReadyEvent(u.init)
