
<!-- OR ANY OTHER AMD LOADER HERE INSTEAD OF loader.js -->
<script src="/node_modules/monaco-editor/min/vs/loader.js"></script>
<div id="container" style="width: 100%; height: 400px; border: 1px solid grey;"></div>

<script>
    require.config({ paths: { vs: '/node_modules/monaco-editor/min/vs' } });
    let m = null;
    require(['vs/editor/editor.main'], function () {
        var editor = monaco.editor.create(document.getElementById('container'), {
            value: atob('{!! $code !!}'),
            language: 'php',
            theme: 'vs-dark',
            readOnly:true,
            minimap:{enabled:false},
            overviewRulerLanes: 0,
            fontSize: '22px',
            scrollbar: {
                vertical:"hidden",
                horizontal: "hidden",
                handleMouseWheel:false,
            }
        });
        m = editor;
    });
</script>
</body>
