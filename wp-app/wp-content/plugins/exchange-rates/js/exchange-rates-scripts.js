(function() {
 const mode = 'develop';
 const element = mode == 'develop' ? document.querySelector('#site-header') : document.querySelector('#exchange-rates')

 var vm = new Vue({
    el: element,
    mounted(){
        console.log("Hello Vue!");
     }
 });
})();