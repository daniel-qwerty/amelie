var urlBase = "";
$(document).ready(function () {
    $(".form-login input[type=submit]").attr("value", "Ingresar");

    $("input[rel=date]").each(function () {
        var name = "#" + $(this).attr("id");
        $(name + "Year").change(function () {
            $(name).attr('value', $(name + "Year").val() + "-" + $(name + "Month").val() + "-" + $(name + "Day").val());
        });
        $(name + "Month").change(function () {
            $(name).attr('value', $(name + "Year").val() + "-" + $(name + "Month").val() + "-" + $(name + "Day").val());
        });
        $(name + "Day").change(function () {
            $(name).attr('value', $(name + "Year").val() + "-" + $(name + "Month").val() + "-" + $(name + "Day").val());
        });
        $(name).attr('value', $(name + "Year").val() + "-" + $(name + "Month").val() + "-" + $(name + "Day").val());
    });

    //datepicker
    $("input[rel=datepicker]").each(function () {
        $(this).datepick();
    });

    //Editor
    $('.htmlEditor').each(function () {
        $(this).summernote({
            height: 250
        });
    });

    //fileUpload
    $(".fileUploader input.file").hide();
    $(".fileUploader input.text").click(function () {
        var name = "#" + $(this).attr("id");
        name = name.replace("Name", "");
        $(name).click();
    });

    $("ul.sortable").each(function () {
        $("form ul.sortable").sortable({
            handle: '.handle',
            update: function () {

            }
        });
    });

    $('.selectable').each(function () {
        var selectButton = $(this).attr('rel') + "Select";
        var removeButton = $(this).attr('rel') + "Delete";
        var id = $(this).attr('rel');
        var url = $(this).attr('url');
        var removeUrl = $(this).attr('removeUrl');
        $('#' + selectButton).click(function () {
            window.open(url, "mywindow", "status=0,toolbar=0,titlebar=0,scrollbars=1,width=640,height=480");
        });

        $('#' + removeButton).click(function () {
            $("#" + id + "Table input[type='checkbox']").each(function () {
                if ($(this).prop("checked")) {

                    $.ajax({
                        type: "POST",
                        url: removeUrl,
                        data: {item: $(this).val()}
                    });

                    $(this).parent().parent().remove();
                }
            });
        });
    });

    $('.codeEditor').each(function () {
        CodeMirror.fromTextArea(document.getElementById($(this).attr("id")), {
            lineNumbers: true,
            matchBrackets: true,
            continueComments: "Enter",
            extraKeys: {"Ctrl-Q": "toggleComment"}
        });
    });

    $('.tree').each(function () {
        $('.tree .node .alias').click(function () {
            $('.child', $(this).parent().parent()).toggle();
        });

        $('.tree .child').hide();

        if ($('input:checked', this).val() > 0) {
            var check = $('input:checked', this);
            var parent = check.parent();
            while (!(parent.hasClass("tree"))) {
                if (parent.hasClass('node')) {
                    $('.alias', parent).click();
                }
                parent = parent.parent();
            }
        }
    });

    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });

    /*setTimeout(function() {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut',
            timeOut: 5000
        };
        toastr.success('Checkout settings menu on left!', 'Welcome to Modern!');
    }, 1800);*/

    //CKEDITOR.disableAutoInline = true;
    //
    //CKEDITOR.replaceClass = 'ckeditor';
    //
    //$('.ckeditor').each(function () {
    //
    //    var roxyFileman = "http://heifer-bolivia.org/cms/Resources/Script/Admin/ckeditor/fileman/index.html";
    //
    //    CKEDITOR.replace($(this).attr('id'), {
    //        "language": "es",
    //        "resize_enabled": false,
    //        "toolbarCanCollapse": false,
    //        "height": "450px",
    //        "width": "100%",
    //        "toolbar": [["Source", "Maximize"],
    //            ["Cut", "Copy", "Paste", "PasteText", "PasteAsPlainText", "PasteFromWord", "-", "Undo", "Redo", "RemoveFormat"],
    //            ["Bold", "Italic", "Underline", "Strike", "NumberedList", "BulletedList", "TextColor", "BGColor"],
    //            ["Font", "FontSize", "Format"],
    //            ["JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyBlock", "Outdent", "Indent"],
    //            ["Link", "Unlink", "-", "Image", "Code", "Table"]],
    //        "filebrowserBrowseUrl": roxyFileman,
    //        "filebrowserImageBrowseUrl": roxyFileman + "?type=image",
    //        "removeDialogTabs": 'link:upload;image:upload'
    //    });
    //});
    $(".live-tile").liveTile();
});

function showHide(filter) {
    if ($(filter).is(":visible")) {
        $(filter).hide();
    } else {
        $(filter).show();
    }
}

function addToSelectable(itemId) {
    var addUrl = $(".selectable", window.opener.document).attr('addUrl');
    $.ajax({
        type: "POST",
        url: addUrl,
        data: {item: itemId},
        success: function (data) {
            window.opener.location.href = window.opener.location.href;
        }
    });
}

function printReport(BaseUrl) {
    var Obj = document.getElementById("cuerpoReporte");

    var VentanaNueva = window.open("", "", "menubar=0,resizable=1,width=800,height=600,scrollbars=1,statusbar=0");

    VentanaNueva.document.write('<html><body onclick="window.print();">');

    VentanaNueva.document.write('<link rel="stylesheet" type="text/css" href="' + BaseUrl + '/print.css">');

    VentanaNueva.document.write('<div id="CuerpoReporte">');

    VentanaNueva.document.write(Obj.innerHTML);

    VentanaNueva.document.write('</div>');

    VentanaNueva.document.write('</body></html>');

    VentanaNueva.document.close();
}