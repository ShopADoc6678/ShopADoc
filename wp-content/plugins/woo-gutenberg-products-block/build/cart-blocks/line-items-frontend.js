(window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[]).push([[27],{165:function(e,t){},247:function(e,t,c){"use strict";var r=c(0),a=c(4),n=c.n(a);c(277),t.a=e=>{let{children:t,className:c}=e;return Object(r.createElement)("div",{className:n()("wc-block-components-product-badge",c)},t)}},250:function(e,t,c){"use strict";var r=c(0),a=c(1),n=c(97),l=c(4),o=c.n(l),i=c(40);c(251);const s=e=>{let{currency:t,maxPrice:c,minPrice:l,priceClassName:s,priceStyle:u={}}=e;return Object(r.createElement)(r.Fragment,null,Object(r.createElement)("span",{className:"screen-reader-text"},Object(a.sprintf)(
/* translators: %1$s min price, %2$s max price */
Object(a.__)("Price between %1$s and %2$s","woo-gutenberg-products-block"),Object(i.formatPrice)(l),Object(i.formatPrice)(c))),Object(r.createElement)("span",{"aria-hidden":!0},Object(r.createElement)(n.a,{className:o()("wc-block-components-product-price__value",s),currency:t,value:l,style:u})," — ",Object(r.createElement)(n.a,{className:o()("wc-block-components-product-price__value",s),currency:t,value:c,style:u})))},u=e=>{let{currency:t,regularPriceClassName:c,regularPriceStyle:l,regularPrice:i,priceClassName:s,priceStyle:u,price:m}=e;return Object(r.createElement)(r.Fragment,null,Object(r.createElement)("span",{className:"screen-reader-text"},Object(a.__)("Previous price:","woo-gutenberg-products-block")),Object(r.createElement)(n.a,{currency:t,renderText:e=>Object(r.createElement)("del",{className:o()("wc-block-components-product-price__regular",c),style:l},e),value:i}),Object(r.createElement)("span",{className:"screen-reader-text"},Object(a.__)("Discounted price:","woo-gutenberg-products-block")),Object(r.createElement)(n.a,{currency:t,renderText:e=>Object(r.createElement)("ins",{className:o()("wc-block-components-product-price__value","is-discounted",s),style:u},e),value:m}))};t.a=e=>{let{align:t,className:c,currency:a,format:l="<price/>",maxPrice:i,minPrice:m,price:b,priceClassName:p,priceStyle:d,regularPrice:O,regularPriceClassName:j,regularPriceStyle:_}=e;const y=o()(c,"price","wc-block-components-product-price",{["wc-block-components-product-price--align-"+t]:t});l.includes("<price/>")||(l="<price/>",console.error("Price formats need to include the `<price/>` tag."));const f=O&&b!==O;let g=Object(r.createElement)("span",{className:o()("wc-block-components-product-price__value",p)});return f?g=Object(r.createElement)(u,{currency:a,price:b,priceClassName:p,priceStyle:d,regularPrice:O,regularPriceClassName:j,regularPriceStyle:_}):void 0!==m&&void 0!==i?g=Object(r.createElement)(s,{currency:a,maxPrice:i,minPrice:m,priceClassName:p,priceStyle:d}):b&&(g=Object(r.createElement)(n.a,{className:o()("wc-block-components-product-price__value",p),currency:a,value:b,style:d})),Object(r.createElement)("span",{className:y},Object(r.createInterpolateElement)(l,{price:g}))}},251:function(e,t){},252:function(e,t,c){"use strict";var r=c(11),a=c.n(r),n=c(0),l=c(21),o=c(4),i=c.n(o);c(253),t.a=e=>{let{className:t="",disabled:c=!1,name:r,permalink:o="",rel:s,style:u,onClick:m,...b}=e;const p=i()("wc-block-components-product-name",t);if(c){const e=b;return Object(n.createElement)("span",a()({className:p},e,{dangerouslySetInnerHTML:{__html:Object(l.decodeEntities)(r)}}))}return Object(n.createElement)("a",a()({className:p,href:o,rel:s},b,{dangerouslySetInnerHTML:{__html:Object(l.decodeEntities)(r)},style:u}))}},253:function(e,t){},263:function(e,t,c){"use strict";var r=c(0),a=c(116),n=c(117);const l=e=>{const t=e.indexOf("</p>");return-1===t?e:e.substr(0,t+4)},o=e=>e.replace(/<\/?[a-z][^>]*?>/gi,""),i=(e,t)=>e.replace(/[\s|\.\,]+$/i,"")+t,s=function(e,t){let c=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"&hellip;";const r=o(e),a=r.split(" ").splice(0,t).join(" ");return Object(n.autop)(i(a,c))},u=function(e,t){let c=!(arguments.length>2&&void 0!==arguments[2])||arguments[2],r=arguments.length>3&&void 0!==arguments[3]?arguments[3]:"&hellip;";const a=o(e),l=a.slice(0,t);if(c)return Object(n.autop)(i(l,r));const s=l.match(/([\s]+)/g),u=s?s.length:0,m=a.slice(0,t+u);return Object(n.autop)(i(m,r))};t.a=e=>{let{source:t,maxLength:c=15,countType:o="words",className:i="",style:m={}}=e;const b=Object(r.useMemo)(()=>function(e){let t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:15,c=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"words";const r=Object(n.autop)(e),o=Object(a.count)(r,c);if(o<=t)return r;const i=l(r),m=Object(a.count)(i,c);return m<=t?i:"words"===c?s(i,t):u(i,t,"characters_including_spaces"===c)}(t,c,o),[t,c,o]);return Object(r.createElement)(r.RawHTML,{style:m,className:i},b)}},276:function(e,t){},277:function(e,t){},278:function(e,t){},279:function(e,t){},301:function(e,t,c){"use strict";var r=c(11),a=c.n(r),n=c(0),l=c(21),o=c(2);c(276),t.a=e=>{let{image:t={},fallbackAlt:c=""}=e;const r=t.thumbnail?{src:t.thumbnail,alt:Object(l.decodeEntities)(t.alt)||c||"Product Image"}:{src:o.PLACEHOLDER_IMG_SRC,alt:""};return Object(n.createElement)("img",a()({className:"wc-block-components-product-image"},r,{alt:r.alt}))}},302:function(e,t,c){"use strict";var r=c(0),a=c(1),n=c(247);t.a=()=>Object(r.createElement)(n.a,{className:"wc-block-components-product-backorder-badge"},Object(a.__)("Available on backorder","woo-gutenberg-products-block"))},303:function(e,t,c){"use strict";var r=c(0),a=c(1),n=c(247);t.a=e=>{let{lowStockRemaining:t}=e;return t?Object(r.createElement)(n.a,{className:"wc-block-components-product-low-stock-badge"},Object(a.sprintf)(
/* translators: %d stock amount (number of items in stock for product) */
Object(a.__)("%d left in stock","woo-gutenberg-products-block"),t)):null}},312:function(e,t,c){"use strict";var r=c(0),a=c(5),n=c(21);c(279);var l=e=>{let{details:t=[]}=e;return Array.isArray(t)?(t=t.filter(e=>!e.hidden),0===t.length?null:Object(r.createElement)("ul",{className:"wc-block-components-product-details"},t.map(e=>{const t=(null==e?void 0:e.key)||e.name||"",c=t?"wc-block-components-product-details__"+Object(a.kebabCase)(t):"";return Object(r.createElement)("li",{key:t+(e.display||e.value),className:c},t&&Object(r.createElement)(r.Fragment,null,Object(r.createElement)("span",{className:"wc-block-components-product-details__name"},Object(n.decodeEntities)(t),":")," "),Object(r.createElement)("span",{className:"wc-block-components-product-details__value"},Object(n.decodeEntities)(e.display||e.value)))}))):null},o=c(263),i=c(50),s=e=>{let{className:t,shortDescription:c="",fullDescription:a=""}=e;const n=c||a;return n?Object(r.createElement)(o.a,{className:t,source:n,maxLength:15,countType:i.n.wordCountType||"words"}):null};c(278),t.a=e=>{let{shortDescription:t="",fullDescription:c="",itemData:a=[],variation:n=[]}=e;return Object(r.createElement)("div",{className:"wc-block-components-product-metadata"},Object(r.createElement)(s,{className:"wc-block-components-product-metadata__description",shortDescription:t,fullDescription:c}),Object(r.createElement)(l,{details:a}),Object(r.createElement)(l,{details:n.map(e=>{let{attribute:t="",value:c}=e;return{key:t,value:c}})}))}},337:function(e,t){},390:function(e,t,c){"use strict";c.r(t);var r=c(0),a=c(24),n=c(4),l=c.n(n),o=c(1),i=c(25),s=c(171),u=c(52);c(337);var m=e=>{let{className:t,quantity:c=1,minimum:a=1,maximum:n,onChange:m=(()=>{}),step:b=1,itemName:p="",disabled:d}=e;const O=l()("wc-block-components-quantity-selector",t),j=void 0!==n,_=c-b>=a,y=!j||c+b<=n,f=Object(r.useCallback)(e=>{let t=e;j&&(t=Math.min(t,Math.floor(n/b)*b)),t=Math.max(t,Math.ceil(a/b)*b),t=Math.floor(t/b)*b,t!==e&&m(t)},[j,n,a,m,b]),g=Object(u.a)(f,300);Object(r.useLayoutEffect)(()=>{f(c)},[c,f]);const k=Object(r.useCallback)(e=>{const t=void 0!==typeof e.key?"ArrowDown"===e.key:e.keyCode===s.DOWN,r=void 0!==typeof e.key?"ArrowUp"===e.key:e.keyCode===s.UP;t&&_&&(e.preventDefault(),m(c-b)),r&&y&&(e.preventDefault(),m(c+b))},[c,m,y,_,b]);return Object(r.createElement)("div",{className:O},Object(r.createElement)("input",{className:"wc-block-components-quantity-selector__input",disabled:d,type:"number",step:b,min:a,max:n,value:c,onKeyDown:k,onChange:e=>{let t=parseInt(e.target.value,10);t=isNaN(t)?c:t,t!==c&&(m(t),g(t))},"aria-label":Object(o.sprintf)(
/* translators: %s refers to the item name in the cart. */
Object(o.__)("Quantity of %s in your cart.","woo-gutenberg-products-block"),p)}),Object(r.createElement)("button",{"aria-label":Object(o.__)("Reduce quantity","woo-gutenberg-products-block"),className:"wc-block-components-quantity-selector__button wc-block-components-quantity-selector__button--minus",disabled:d||!_,onClick:()=>{const e=c-b;m(e),Object(i.speak)(Object(o.sprintf)(
/* translators: %s refers to the item name in the cart. */
Object(o.__)("Quantity reduced to %s.","woo-gutenberg-products-block"),e)),f(e)}},"－"),Object(r.createElement)("button",{"aria-label":Object(o.__)("Increase quantity","woo-gutenberg-products-block"),disabled:d||!y,className:"wc-block-components-quantity-selector__button wc-block-components-quantity-selector__button--plus",onClick:()=>{const e=c+b;m(e),Object(i.speak)(Object(o.sprintf)(
/* translators: %s refers to the item name in the cart. */
Object(o.__)("Quantity increased to %s.","woo-gutenberg-products-block"),e)),f(e)}},"＋"))},b=c(250),p=c(252),d=c(9),O=c(6),j=c(95),_=c(63),y=c(67),f=c(18),g=c(32);var k=c(33),E=c(301),w=c(302),v=c(303),N=c(97),h=c(247),C=e=>{let{currency:t,saleAmount:c,format:a="<price/>"}=e;if(!c||c<=0)return null;a.includes("<price/>")||(a="<price/>",console.error("Price formats need to include the `<price/>` tag."));const n=Object(o.sprintf)(
/* translators: %s will be replaced by the discount amount */
Object(o.__)("Save %s","woo-gutenberg-products-block"),a);return Object(r.createElement)(h.a,{className:"wc-block-components-sale-badge"},Object(r.createInterpolateElement)(n,{price:Object(r.createElement)(N.a,{currency:t,value:c})}))},x=c(312),I=c(40),P=c(15),S=c(300),q=c(2);const D=(e,t)=>e.convertPrecision(t.minorUnit).getAmount(),A=e=>Object(P.mustContain)(e,"<price/>");var R=Object(r.forwardRef)((e,t)=>{let{lineItem:c,onRemove:n=(()=>{}),tabIndex:s=null}=e;const{name:u="",catalog_visibility:N="visible",short_description:h="",description:R="",low_stock_remaining:T=null,show_backorder_badge:F=!1,quantity_limits:L={minimum:1,maximum:99,multiple_of:1,editable:!0},sold_individually:M=!1,permalink:U="",images:Q=[],variation:V=[],item_data:$=[],prices:H={currency_code:"USD",currency_minor_unit:2,currency_symbol:"$",currency_prefix:"$",currency_suffix:"",currency_decimal_separator:".",currency_thousand_separator:",",price:"0",regular_price:"0",sale_price:"0",price_range:null,raw_prices:{precision:6,price:"0",regular_price:"0",sale_price:"0"}},totals:B={currency_code:"USD",currency_minor_unit:2,currency_symbol:"$",currency_prefix:"$",currency_suffix:"",currency_decimal_separator:".",currency_thousand_separator:",",line_subtotal:"0",line_subtotal_tax:"0"},extensions:K}=c,{quantity:W,setItemQuantity:J,removeItem:Y,isPendingDelete:z}=(e=>{const t={key:"",quantity:1};(e=>Object(f.d)(e)&&Object(f.f)(e,"key")&&Object(f.f)(e,"quantity")&&Object(f.e)(e.key)&&Object(f.c)(e.quantity))(e)&&(t.key=e.key,t.quantity=e.quantity);const{key:c="",quantity:n=1}=t,{cartErrors:l}=Object(a.a)(),{dispatchActions:o}=Object(g.b)(),[i,s]=Object(r.useState)(n),[u]=Object(j.a)(i,400),m=Object(_.a)(u),{removeItemFromCart:b,changeCartItemQuantity:p}=Object(d.useDispatch)(O.CART_STORE_KEY);Object(r.useEffect)(()=>s(n),[n]);const k=Object(d.useSelect)(e=>{if(!c)return{quantity:!1,delete:!1};const t=e(O.CART_STORE_KEY);return{quantity:t.isItemPendingQuantity(c),delete:t.isItemPendingDelete(c)}},[c]),E=Object(r.useCallback)(()=>c?b(c).then(()=>(Object(y.d)(),!0)):Promise.resolve(!1),[c,b]);return Object(r.useEffect)(()=>{c&&Object(f.c)(m)&&Number.isFinite(m)&&m!==u&&p(c,u)},[c,p,u,m]),Object(r.useEffect)(()=>(k.delete?o.incrementCalculating():o.decrementCalculating(),()=>{k.delete&&o.decrementCalculating()}),[o,k.delete]),Object(r.useEffect)(()=>(k.quantity||u!==i?o.incrementCalculating():o.decrementCalculating(),()=>{(k.quantity||u!==i)&&o.decrementCalculating()}),[o,k.quantity,u,i]),{isPendingDelete:k.delete,quantity:i,setItemQuantity:s,removeItem:E,cartItemQuantityErrors:l}})(c),{dispatchStoreEvent:G}=Object(k.a)(),{receiveCart:X,...Z}=Object(a.a)(),ee=Object(r.useMemo)(()=>({context:"cart",cartItem:c,cart:Z}),[c,Z]),te=Object(I.getCurrencyFromPriceResponse)(H),ce=Object(P.__experimentalApplyCheckoutFilter)({filterName:"itemName",defaultValue:u,extensions:K,arg:ee}),re=Object(S.a)({amount:parseInt(H.raw_prices.regular_price,10),precision:H.raw_prices.precision}),ae=Object(S.a)({amount:parseInt(H.raw_prices.price,10),precision:H.raw_prices.precision}),ne=re.subtract(ae),le=ne.multiply(W),oe=Object(I.getCurrencyFromPriceResponse)(B);let ie=parseInt(B.line_subtotal,10);Object(q.getSetting)("displayCartPricesIncludingTax",!1)&&(ie+=parseInt(B.line_subtotal_tax,10));const se=Object(S.a)({amount:ie,precision:oe.minorUnit}),ue=Q.length?Q[0]:{},me="hidden"===N||"search"===N,be=Object(P.__experimentalApplyCheckoutFilter)({filterName:"cartItemClass",defaultValue:"",extensions:K,arg:ee}),pe=Object(P.__experimentalApplyCheckoutFilter)({filterName:"cartItemPrice",defaultValue:"<price/>",extensions:K,arg:ee,validation:A}),de=Object(P.__experimentalApplyCheckoutFilter)({filterName:"subtotalPriceFormat",defaultValue:"<price/>",extensions:K,arg:ee,validation:A}),Oe=Object(P.__experimentalApplyCheckoutFilter)({filterName:"saleBadgePriceFormat",defaultValue:"<price/>",extensions:K,arg:ee,validation:A});return Object(r.createElement)("tr",{className:l()("wc-block-cart-items__row",be,{"is-disabled":z}),ref:t,tabIndex:s},Object(r.createElement)("td",{className:"wc-block-cart-item__image","aria-hidden":!Object(f.f)(ue,"alt")||!ue.alt},me?Object(r.createElement)(E.a,{image:ue,fallbackAlt:ce}):Object(r.createElement)("a",{href:U,tabIndex:-1},Object(r.createElement)(E.a,{image:ue,fallbackAlt:ce}))),Object(r.createElement)("td",{className:"wc-block-cart-item__product"},Object(r.createElement)("div",{className:"wc-block-cart-item__wrap"},Object(r.createElement)(p.a,{disabled:z||me,name:ce,permalink:U}),F?Object(r.createElement)(w.a,null):!!T&&Object(r.createElement)(v.a,{lowStockRemaining:T}),Object(r.createElement)("div",{className:"wc-block-cart-item__prices"},Object(r.createElement)(b.a,{currency:te,regularPrice:D(re,te),price:D(ae,te),format:de})),Object(r.createElement)(C,{currency:te,saleAmount:D(ne,te),format:Oe}),Object(r.createElement)(x.a,{shortDescription:h,fullDescription:R,itemData:$,variation:V}),Object(r.createElement)("div",{className:"wc-block-cart-item__quantity"},!M&&!!L.editable&&Object(r.createElement)(m,{disabled:z,quantity:W,minimum:L.minimum,maximum:L.maximum,step:L.multiple_of,onChange:e=>{J(e),G("cart-set-item-quantity",{product:c,quantity:e})},itemName:ce}),Object(r.createElement)("button",{className:"wc-block-cart-item__remove-link",onClick:()=>{n(),Y(),G("cart-remove-item",{product:c,quantity:W}),Object(i.speak)(Object(o.sprintf)(
/* translators: %s refers to the item name in the cart. */
Object(o.__)("%s has been removed from your cart.","woo-gutenberg-products-block"),ce))},disabled:z},Object(o.__)("Remove item","woo-gutenberg-products-block"))))),Object(r.createElement)("td",{className:"wc-block-cart-item__total"},Object(r.createElement)("div",{className:"wc-block-cart-item__total-price-and-sale-badge-wrapper"},Object(r.createElement)(b.a,{currency:oe,format:pe,price:se.getAmount()}),W>1&&Object(r.createElement)(C,{currency:te,saleAmount:D(le,te),format:Oe}))))});const T=[...Array(3)].map((_x,e)=>Object(r.createElement)(R,{lineItem:{},key:e})),F=e=>{const t={};return e.forEach(e=>{let{key:c}=e;t[c]=Object(r.createRef)()}),t};var L=e=>{let{lineItems:t=[],isLoading:c=!1,className:a}=e;const n=Object(r.useRef)(null),i=Object(r.useRef)(F(t));Object(r.useEffect)(()=>{i.current=F(t)},[t]);const s=e=>()=>{null!=i&&i.current&&e&&i.current[e].current instanceof HTMLElement?i.current[e].current.focus():n.current instanceof HTMLElement&&n.current.focus()},u=c?T:t.map((e,c)=>{const a=t.length>c+1?t[c+1].key:null;return Object(r.createElement)(R,{key:e.key,lineItem:e,onRemove:s(a),ref:i.current[e.key],tabIndex:-1})});return Object(r.createElement)("table",{className:l()("wc-block-cart-items",a),ref:n,tabIndex:-1},Object(r.createElement)("thead",null,Object(r.createElement)("tr",{className:"wc-block-cart-items__header"},Object(r.createElement)("th",{className:"wc-block-cart-items__header-image"},Object(r.createElement)("span",null,Object(o.__)("Product","woo-gutenberg-products-block"))),Object(r.createElement)("th",{className:"wc-block-cart-items__header-product"},Object(r.createElement)("span",null,Object(o.__)("Details","woo-gutenberg-products-block"))),Object(r.createElement)("th",{className:"wc-block-cart-items__header-total"},Object(r.createElement)("span",null,Object(o.__)("Total","woo-gutenberg-products-block"))))),Object(r.createElement)("tbody",null,u))};t.default=e=>{let{className:t}=e;const{cartItems:c,cartIsLoading:n}=Object(a.a)();return Object(r.createElement)(L,{className:t,lineItems:c,isLoading:n})}},95:function(e,t,c){"use strict";c.d(t,"a",(function(){return o}));var r=c(3),a=c(52);function n(e,t){return e===t}function l(e){return"function"==typeof e?function(){return e}:e}function o(e,t,c){var o=c&&c.equalityFn||n,i=function(e){var t=Object(r.useState)(l(e)),c=t[0],a=t[1];return[c,Object(r.useCallback)((function(e){return a(l(e))}),[])]}(e),s=i[0],u=i[1],m=Object(a.a)(Object(r.useCallback)((function(e){return u(e)}),[u]),t,c),b=Object(r.useRef)(e);return o(b.current,e)||(m(e),b.current=e),[s,m]}},97:function(e,t,c){"use strict";var r=c(11),a=c.n(r),n=c(0),l=c(135),o=c(4),i=c.n(o);c(165);const s=e=>({thousandSeparator:e.thousandSeparator,decimalSeparator:e.decimalSeparator,decimalScale:e.minorUnit,fixedDecimalScale:!0,prefix:e.prefix,suffix:e.suffix,isNumericString:!0});t.a=e=>{let{className:t,value:c,currency:r,onValueChange:o,displayType:u="text",...m}=e;const b="string"==typeof c?parseInt(c,10):c;if(!Number.isFinite(b))return null;const p=b/10**r.minorUnit;if(!Number.isFinite(p))return null;const d=i()("wc-block-formatted-money-amount","wc-block-components-formatted-money-amount",t),O={...m,...s(r),value:void 0,currency:void 0,onValueChange:void 0},j=o?e=>{const t=+e.value*10**r.minorUnit;o(t)}:()=>{};return Object(n.createElement)(l.a,a()({className:d,displayType:u},O,{value:p,onValueChange:j}))}}}]);