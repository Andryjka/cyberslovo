
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

(function() {
    var editor_id = "";
    tinymce.PluginManager.add('instagram', function(editor, url) {
        // Add a button that opens a window
        editor.addButton('instagram', {
            text: 'Instagram',
            icon: false,
            onclick: function() {
                // Open window
                editor.windowManager.open({
                    title: 'Instagram Embed',
                    body: [
                        {   type: 'textbox',
                            size: 40,
                            height: '300px',
                            name: 'instagram код',
                            label: 'instagram'
                        }
                    ],
                    onsubmit: function(e) {
                        // Insert content when the window form is submitted
                        console.log(e.data.instagram);
                        var embedCode = e.data.instagram;
                        var script = embedCode.match(/<script.*<\/script>/)[0];
                        var scriptSrc = script.match(/".*\.js/)[0].split("\"")[1];
                        console.log(script, scriptSrc);

                        var sc = document.createElement("script");
                        sc.setAttribute("src", scriptSrc);
                        sc.setAttribute("type", "text/javascript");

                        var iframe = document.getElementById(editor_id + "_ifr");
                        var iframeHead = iframe.contentWindow.document.getElementsByTagName('head')[0];

                        tinyMCE.activeEditor.insertContent(e.data.instagram);
                        iframeHead.appendChild(sc);
                        setTimeout(function() {
                        	iframe.contentWindow.instgrm.Embeds.process();
                        }, 1000)
                        // editor.insertContent('Title: ' + e.data.title);
                    }
                });
            }
        });
    });

       tinymce.PluginManager.add('twitter_url', function(editor, url) {
        var icon_url='img/social/twitter.png';

        editor.on('init', function (args) {
            editor_id = args.target.id;

        });
        editor.addButton('twitter_url',
            {
                text: 'Twitter',
                icon: false,

                onclick: function() {

                    editor.windowManager.open({
                        title: 'Twitter Embed',

                        body: [
                            {   type: 'textbox',
                                size: 40,
                                height: '100px',
                                name: 'Ссылка на твит',
                                label: 'Ссылка на твит',
                            }
                        ],
                        onsubmit: function(e) {

                            var tweetEmbedCode = e.data.twitter;

                            $.ajax({
                                url: "https://publish.twitter.com/oembed?url="+tweetEmbedCode,
                                dataType: "jsonp",
                                async: false,
                                success: function(data){
                                   //$("#embedCode").val(data.html);
                                   //$("#preview").html(data.html)
                                    tinyMCE.activeEditor.insertContent(
                                        '<div class="div_border" contenteditable="false">'
                                            +data.html+
                                        '</div>');

                                },
                                error: function (jqXHR, exception) {
                                    var msg = '';
                                    if (jqXHR.status === 0) {
                                        msg = 'Not connect.\n Verify Network.';
                                    } else if (jqXHR.status == 404) {
                                        msg = 'Requested page not found. [404]';
                                    } else if (jqXHR.status == 500) {
                                        msg = 'Internal Server Error [500].';
                                    } else if (exception === 'parsererror') {
                                        msg = 'Requested JSON parse failed.';
                                    } else if (exception === 'timeout') {
                                        msg = 'Time out error.';
                                    } else if (exception === 'abort') {
                                        msg = 'Ajax request aborted.';
                                    } else {
                                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                                    }
                                    alert(msg);
                                },
                            });
                            setTimeout(function() {
                                iframe.contentWindow.twttr.widgets.load();

                            }, 1000)
                        }
                    });
                }
            });
    });
    tinymce.init({
        selector: 'textarea#description, textarea#description_short',
        height: 300,
        theme: 'modern',
        toolbar: 'bold italic | styleselect | alignleft aligncenter alignright alignjustify | undo redo | link image media | code preview | fullscreen | instagram | twitter_url',
        plugins: "advlist wordcount fullscreen link image code preview media instagram twitter_url",
        menubar: true,
        valid_elements: '+*[*]',
        extended_valid_elements : "+iframe[width|height|name|align|class|frameborder|allowfullscreen|allow|src|*]," +
        "script[language|type|async|src|charset]" +
        "img[*]" +
        "embed[width|height|name|flashvars|src|bgcolor|align|play|loop|quality|allowscriptaccess|type|pluginspage]" +
        "blockquote[dir|style|cite|class|id|lang|onclick|ondblclick"
        +"|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout"
        +"|onmouseover|onmouseup|title]",
        content_css: ['css/main.css?' + new Date().getTime(),
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ],
        setup: function (editor) {
            editor.on('init', function (args) {
                editor_id = args.target.id;
            });
        }
    });
})();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
