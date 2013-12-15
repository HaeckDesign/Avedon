/*
IcoMoon - icomoon.io
License: CC BY 3.0
Copyright: Keyamoon, Keyamoon.com
*/

/* Load this script using conditional IE comments if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'avedon\'">' + entity + '</span>' + html;
	}
	var icons = {
			'avedonicon-refresh' : '&#xf021;',
			'avedonicon-chevron-left' : '&#xf053;',
			'avedonicon-chevron-right' : '&#xf054;',
			'avedonicon-question-sign' : '&#xf059;',
			'avedonicon-info-sign' : '&#xf05a;',
			'avedonicon-exclamation-sign' : '&#xf06a;',
			'avedonicon-eject' : '&#xf052;',
			'avedonicon-pause' : '&#xf04c;',
			'avedonicon-play' : '&#xf04b;',
			'avedonicon-foursquare' : '&#xe007;',
			'avedonicon-youtube' : '&#xe008;',
			'avedonicon-pinterest' : '&#xe00a;',
			'avedonicon-googleplus' : '&#xe00b;',
			'avedonicon-stumbleupon' : '&#xe001;',
			'avedonicon-linkedin' : '&#xe003;',
			'avedonicon-twitter' : '&#xe004;',
			'avedonicon-facebook' : '&#xe000;',
			'avedonicon-vimeo' : '&#xe00c;',
			'avedonicon-flickr' : '&#xe002;',
			'avedonicon-instagram' : '&#xe005;',
			'avedonicon-phone' : '&#xe006;',
			'avedonicon-location' : '&#xe009;',
			'avedonicon-mail' : '&#xe00d;',
			'avedonicon-dribbble' : '&#xe00e;',
			'avedonicon-forrst' : '&#xe00f;',
			'avedonicon-wordpress' : '&#xe010;',
			'avedonicon-soundcloud' : '&#xe013;',
			'avedonicon-lastfm' : '&#xe011;',
			'avedonicon-html5' : '&#xe012;',
			'avedonicon-paypal' : '&#xe015;',
			'avedonicon-reddit' : '&#xe014;',
			'avedonicon-feed' : '&#xe016;',
			'avedonicon-safari' : '&#xe017;',
			'avedonicon-console' : '&#xe018;',
			'avedonicon-meter' : '&#xe019;',
			'avedonicon-gift' : '&#xe01a;',
			'avedonicon-chevron-up' : '&#xf077;',
			'avedonicon-chevron-down' : '&#xf078;',
			'avedonicon-reorder' : '&#xf0c9;',
			'avedonicon-adjust' : '&#xf042;',
			'avedonicon-tag' : '&#xf02b;',
			'avedonicon-code' : '&#xf121;',
			'avedonicon-fullscreen' : '&#xf0b2;',
			'avedonicon-link' : '&#xf0c1;',
			'avedonicon-cloud' : '&#xf0c2;',
			'avedonicon-music' : '&#xf001;',
			'avedonicon-quote-right' : '&#xf10e;',
			'avedonicon-comment' : '&#xf075;',
			'avedonicon-facetime-video' : '&#xf03d;',
			'avedonicon-time' : '&#xf017;',
			'avedonicon-picture' : '&#xf03e;',
			'avedonicon-bookmark' : '&#xf02e;',
			'avedonicon-edit' : '&#xf044;',
			'avedonicon-asterisk' : '&#xf069;',
			'avedonicon-bullhorn' : '&#xf0a1;',
			'avedonicon-camera' : '&#xf030;',
			'avedonicon-html5-2' : '&#xf13b;',
			'avedonicon-css3' : '&#xf13c;',
			'avedonicon-rocket' : '&#xf135;',
			'avedonicon-superscript' : '&#xf12b;',
			'avedonicon-ticket' : '&#xf145;',
			'avedonicon-code-fork' : '&#xf126;',
			'avedonicon-question' : '&#xf128;',
			'avedonicon-tablet' : '&#xf10a;',
			'avedonicon-laptop' : '&#xf109;',
			'avedonicon-beaker' : '&#xf0c3;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, html, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		attr = el.getAttribute('data-icon');
		if (attr) {
			addIcon(el, attr);
		}
		c = el.className;
		c = c.match(/avedonicon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
};