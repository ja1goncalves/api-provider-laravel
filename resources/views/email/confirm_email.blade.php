<!doctype html>
<html lang="{{ app()->getLocale() }}" xmlns="http://www.w3.org/1999/xhtml" style="width:100% !important;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <script src="https://js-agent.newrelic.com/nr-1118.min.js"></script><script type="text/javascript" src="https://bam.nr-data.net/1/aece2c08f5?a=22912202&v=1118.0c07c19&to=ZgMBMkBYDRcCARVQC19JIBNBTQwJTA8AUAhuAQYS&rst=469&ref=file:///home/joaopaulo/%25C3%2581rea%2520de%2520Trabalho/mail/teste.html&ap=259&be=290&fe=384&dc=306&perf=%7B%22timing%22:%7B%22of%22:1559849857440,%22n%22:0,%22u%22:218,%22ue%22:218,%22f%22:1,%22dn%22:1,%22dne%22:1,%22c%22:1,%22ce%22:1,%22rq%22:1,%22rp%22:1,%22rpe%22:111,%22dl%22:220,%22di%22:306,%22ds%22:306,%22de%22:306,%22dc%22:384,%22l%22:384,%22le%22:385%7D,%22navigation%22:%7B%22ty%22:1%7D%7D&at=SkQCRAhCHhk%3D&jsonp=NREUM.setToken"></script><script type="text/javascript">window.NREUM||(NREUM={}),__nr_require=function(e, n, t){function r(t){if(!n[t]){var o=n[t]={exports:{}};e[t][0].call(o.exports,function(n){var o=e[t][1][n];return r(o||n)},o,o.exports)}return n[t].exports}if("function"==typeof __nr_require)return __nr_require;for(var o=0; o<t.length; o++)r(t[o]);return r}({1:[function(e, n, t){function r(){}function o(e, n, t){return function(){return i(e,[c.now()].concat(u(arguments)),n?null:this,t),n?void 0:this}}var i=e("handle"),a=e(3),u=e(4),f=e("ee").get("tracer"),c=e("loader"),s=NREUM;"undefined"==typeof window.newrelic&&(newrelic=s);var p=["setPageViewName","setCustomAttribute","setErrorHandler","finished","addToTrace","inlineHit","addRelease"],d="api-",l=d+"ixn-";a(p,function(e,n){s[n]=o(d+n,!0,"api")}),s.addPageAction=o(d+"addPageAction",!0),s.setCurrentRouteName=o(d+"routeName",!0),n.exports=newrelic,s.interaction=function(){return(new r).get()};var m=r.prototype={createTracer:function(e,n){var t={},r=this,o="function"==typeof n;return i(l+"tracer",[c.now(),e,t],r),function(){if(f.emit((o?"":"no-")+"fn-start",[c.now(),r,o],t),o)try{return n.apply(this,arguments)}catch(e){throw f.emit("fn-err",[arguments,this,e],t),e}finally{f.emit("fn-end",[c.now()],t)}}}};a("actionText,setName,setAttribute,save,ignore,onEnd,getContext,end,get".split(","),function(e,n){m[n]=o(l+n)}),newrelic.noticeError=function(e,n){"string"==typeof e&&(e=new Error(e)),i("err",[e,c.now(),!1,n])}},{}],2:[function(e,n,t){function r(e,n){if(!o)return!1;if(e!==o)return!1;if(!n)return!0;if(!i)return!1;for(var t=i.split("."),r=n.split("."),a=0;a<r.length;a++)if(r[a]!==t[a])return!1;return!0}var o=null,i=null,a=/Version\/(\S+)\s+Safari/;if(navigator.userAgent){var u=navigator.userAgent,f=u.match(a);f&&u.indexOf("Chrome")===-1&&u.indexOf("Chromium")===-1&&(o="Safari",i=f[1])}n.exports={agent:o,version:i,match:r}},{}],3:[function(e,n,t){function r(e,n){var t=[],r="",i=0;for(r in e)o.call(e,r)&&(t[i]=n(r,e[r]),i+=1);return t}var o=Object.prototype.hasOwnProperty;n.exports=r},{}],4:[function(e,n,t){function r(e,n,t){n||(n=0),"undefined"==typeof t&&(t=e?e.length:0);for(var r=-1,o=t-n||0,i=Array(o<0?0:o);++r<o;)i[r]=e[n+r];return i}n.exports=r},{}],5:[function(e,n,t){n.exports={exists:"undefined"!=typeof window.performance&&window.performance.timing&&"undefined"!=typeof window.performance.timing.navigationStart}},{}],ee:[function(e,n,t){function r(){}function o(e){function n(e){return e&&e instanceof r?e:e?f(e,u,i):i()}function t(t,r,o,i){if(!d.aborted||i){e&&e(t,r,o);for(var a=n(o),u=v(t),f=u.length,c=0;c<f;c++)u[c].apply(a,r);var p=s[y[t]];return p&&p.push([b,t,r,a]),a}}function l(e,n){h[e]=v(e).concat(n)}function m(e,n){var t=h[e];if(t)for(var r=0;r<t.length;r++)t[r]===n&&t.splice(r,1)}function v(e){return h[e]||[]}function g(e){return p[e]=p[e]||o(t)}function w(e,n){c(e,function(e,t){n=n||"feature",y[t]=n,n in s||(s[n]=[])})}var h={},y={},b={on:l,addEventListener:l,removeEventListener:m,emit:t,get:g,listeners:v,context:n,buffer:w,abort:a,aborted:!1};return b}function i(){return new r}function a(){(s.api||s.feature)&&(d.aborted=!0,s=d.backlog={})}var u="nr@context",f=e("gos"),c=e(3),s={},p={},d=n.exports=o();d.backlog=s},{}],gos:[function(e,n,t){function r(e,n,t){if(o.call(e,n))return e[n];var r=t();if(Object.defineProperty&&Object.keys)try{return Object.defineProperty(e,n,{value:r,writable:!0,enumerable:!1}),r}catch(i){}return e[n]=r,r}var o=Object.prototype.hasOwnProperty;n.exports=r},{}],handle:[function(e,n,t){function r(e,n,t,r){o.buffer([e],r),o.emit(e,n,t)}var o=e("ee").get("handle");n.exports=r,r.ee=o},{}],id:[function(e,n,t){function r(e){var n=typeof e;return!e||"object"!==n&&"function"!==n?-1:e===window?0:a(e,i,function(){return o++})}var o=1,i="nr@id",a=e("gos");n.exports=r},{}],loader:[function(e,n,t){function r(){if(!E++){var e=x.info=NREUM.info,n=l.getElementsByTagName("script")[0];if(setTimeout(s.abort,3e4),!(e&&e.licenseKey&&e.applicationID&&n))return s.abort();c(y,function(n,t){e[n]||(e[n]=t)}),f("mark",["onload",a()+x.offset],null,"api");var t=l.createElement("script");t.src="https://"+e.agent,n.parentNode.insertBefore(t,n)}}function o(){"complete"===l.readyState&&i()}function i(){f("mark",["domContent",a()+x.offset],null,"api")}function a(){return O.exists&&performance.now?Math.round(performance.now()):(u=Math.max((new Date).getTime(),u))-x.offset}var u=(new Date).getTime(),f=e("handle"),c=e(3),s=e("ee"),p=e(2),d=window,l=d.document,m="addEventListener",v="attachEvent",g=d.XMLHttpRequest,w=g&&g.prototype;NREUM.o={ST:setTimeout,SI:d.setImmediate,CT:clearTimeout,XHR:g,REQ:d.Request,EV:d.Event,PR:d.Promise,MO:d.MutationObserver};var h=""+location,y={beacon:"bam.nr-data.net",errorBeacon:"bam.nr-data.net",agent:"js-agent.newrelic.com/nr-1118.min.js"},b=g&&w&&w[m]&&!/CriOS/.test(navigator.userAgent),x=n.exports={offset:u,now:a,origin:h,features:{},xhrWrappable:b,userAgent:p};e(1),l[m]?(l[m]("DOMContentLoaded",i,!1),d[m]("load",r,!1)):(l[v]("onreadystatechange",o),d[v]("onload",r)),f("mark",["firstbyte",u],null,"api");var E=0,O=e(5)},{}]},{},["loader"]);</script>
    <style>
        @font-face{font-family:'Coolvetica'; src: url(data:application/font-woff;charset=utf-8;base64,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) format('woff')}
        html {width: 100% !important;}
        body {width: 100% !important;margin: 0;padding: 0;font-family: 'Coolvetica';}
        .ReadMsgBody {width: 100%;background-color: #EAEAEA;}
        .ExternalClass {width: 100%;background-color: #EAEAEA;}
        @media only screen and (max-width: 839px) {
            body table table{width: 100% !important; }
            body td[class="td-pad10-45-wide"]{padding: 0px 10px 45px 10px !important;}
            body td[class="td-pad10-wide"]{padding: 0px 10px 0px 10px !important;}
            body td[class="td-display-block-center"]{display: block !important;width: 100% !important;padding: 0px 0px !important;text-align: center !important;}
            body td[class="td-display-block-center-pad18"]{display: block !important;width: 100% !important;padding: 18px 0px 0px 0px !important;text-align: center !important;}
            body table[class="table-button180"]{width: 180px !important;}
            body td[class="header-center-pad10"]{display: block !important;width: 100% !important;height: 100% !important;text-align: center !important;padding: 10px 0px 10px 0px !important;}
            body td[class="td-pad10-wide"]{padding: 0px 10px 0px 10px !important;}
            body td[class="td-display-block"]{display: block !important;width: 100% !important;padding: 0px 0px !important;}
            body img[class="img-full"]{width: 100% !important;height: 272px !important;}
            body table[class="table-button210"]{width: 210px !important;}
            body td[class="header-center-pad10"]{display: block !important;width: 100% !important;height: 100% !important;text-align: center !important;padding: 10px 0px 10px 0px !important;}
            body td[class="td-display-block"]{display: block !important;width: 100% !important;padding: 0px 0px !important;}
            body td[class="td-pad10-wide"]{padding: 0px 10px 0px 10px !important;}
            body td[class="td-pad10-30"]{padding: 0px 10px 30px 10px !important;}
            body td[class="td-pad30-10"]{padding: 30px 10px 0px 10px !important;}
            body td[class="td-pad10-wide-center"]{padding: 0px 10px 0px 10px !important;text-align: center !important;}
            body img[class="img-full"]{width: 100% !important;height: 352px !important;}
            body img[class="img-full1"]{width: 100% !important;height: 170px !important;}
            body table[class="table-button130"]{width: 130px !important;margin: auto !important;}
            body td[class="td-pad10-wide"]{padding: 0px 10px 0px 10px !important;}
            body td[class="td-pad10-20-wide"]{padding: 30px 10px 0px 10px !important;}
            body table[class="table-button220"]{width: 220px !important;margin: auto !important;}
            body td[class="td-pad10-wide"]{padding: 0px 10px 0px 10px !important;}
            body td[class="header-center-pad10"]{display: block !important;width: 100% !important;height: 100% !important;text-align: center !important;padding: 10px 0px 10px 0px !important;}
            body td[class="td-text-align-center"]{text-align: center !important;}
            body table[class="table-button220"]{width: 220px !important;margin: auto !important;}
            body td[class="header-center-pad10"]{display: block !important;width: 100% !important;height: 100% !important;text-align: center !important;padding: 10px 0px 10px 0px !important;}
            body td[class="header-center-pad23"]{display: block !important;width: 100% !important;height: 100% !important;text-align: center !important;padding: 23px 0px 10px 0px !important;}
            body td[class="td-pad10-46-wide"]{padding: 0px 10px 46px 10px !important;}
            body td[class="td-pad10-wide"]{padding: 0px 10px 0px 10px !important;}
            body img[class="full-img"]{width: 100% !important;height: 341px !important;}
            body table[class="table-button179"]{width: 179px !important;margin: auto !important;}
            body td[class="td-hidden"]{display: none !important;}
            body td[class="td-text-align-center"]{text-align: center !important;padding: 0px 10px 0px 10px !important;}
            body td[class="header-center-pad10"]{display: block !important;width: 100% !important;height: 100% !important;text-align: center !important;padding: 10px 0px 10px 0px !important;}
            body td[class="td-pad10-wide"]{padding: 0px 10px 0px 10px !important;}
            body img[class="img-full"]{width: 100% !important;height: 343px !important;}
            body td[class="td-pad10-wide"]{padding: 0px 10px 0px 10px !important;}
            body td[class="header-center-pad10"]{display: block !important;width: 100% !important;height: 100% !important;text-align: center !important;padding: 10px 0px 10px 0px !important;}
            body table[class="table-button200"]{width: 200px !important;margin: auto !important;}
        }
    </style>
</head>
<body marginwidth="0" marginheight="0" offset="0" topmargin="0" leftmargin="0" style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0;width:100% !important;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;margin-right:0;margin-left:0;padding-right:0;padding-left:0;font-family:&#39;Coolvetica&#39;;">
<table width="100%" height="100" cellpadding="0" cellspacing="0" border="0" bgcolor="#eaeaea">
    <tbody style="background-color:#E7EDF3;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;">
    <tr>
        <td>
            <table width="800" height="1037" cellpadding="0" cellspacing="0" border="0" align="center" style="background-color:#E7EDF3;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;">
                <tbody>
                <tr>
                    <td>
                        <table width="480" height="164" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#0880c9" style="border-radius:10px 10px 0 0;">
                            <tbody>
                            <tr>
                                <td>
                                    <table width="380" cellpadding="0" cellspacing="0" border="0" align="center">
                                        <tbody>
                                        <tr>
                                            <td data-color="Logo" data-size="Logo" data-min="5" data-max="50" align="center" style="font-weight:500;font-size:18px;letter-spacing:0.100em;line-height:auto;color:#ffffff;font-family:&#39;Coolvetica&#39;, sans-serif;mso-line-height-rule:exactly;">
                                                <img width="150" src="https://www.elomilhas.com.br/wp-content/uploads/2016/03/logo-elomilhas-branco.png" style="vertical-align:middle;">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <p>Caro, {{$data['provider']['name']}}</p>
                                        <p>Obrigado pela inscrição! Antes de começar, você deve confirmar sua conta.</p>
                                        <a href="{{url($data['url_confirmation'])}}">Clique e confirme sua conta...'</a>
                                        <p>Obrigado por usar nosso aplicativo!</p>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <div class="content">
        <div class="links">
            Powered by <a href="https://mangue3.com">Mangue3</a>
        </div>
    </div>
    </tbody>
</table>
<script type="text/javascript">window.NREUM||(NREUM={});NREUM.info={"beacon":"bam.nr-data.net","licenseKey":"aece2c08f5","applicationID":"22912202","transactionName":"ZgMBMkBYDRcCARVQC19JIBNBTQwJTA8AUAhuAQYS","queueTime":0,"applicationTime":294,"atts":"SkQCRAhCHhk=","errorBeacon":"bam.nr-data.net","agent":""}</script>
</body></html>