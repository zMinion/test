$("#input-copy").fileinput({
    allowedFileExtensions: ["jpg"],
    elErrorContainer: '#copy-errors',
    msgErrorClass: 'alert alert-block alert-danger',
    elCaptionContainer: null,
    elCaptionText: null,
    elPreviewContainer: null,
    elPreviewStatus: null,
    elPreviewImage: '#copy-preview',
    showClose: false,
    showRemove: false,
    minImageWidth: 700,
    minImageHeight: 420,
    maxImageWidth: 2048,
    maxImageHeight: 1230,
    browseClass: "btn btn-success",
    browseLabel: "Pick Image",
    browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
    removeClass: "btn btn-danger",
    removeLabel: "X",
    removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> "
});

$("#input-logo").fileinput({
    allowedFileExtensions: ["jpg"],
    elErrorContainer: '#logo-errors',
    msgErrorClass: 'alert alert-block alert-danger',
    elCaptionContainer: null,
    elCaptionText: null,
    elPreviewContainer: null,
    elPreviewStatus: null,
    elPreviewImage: '#logo-preview',
    showClose: false,
    showRemove: true,
    minImageWidth: 700,
    minImageHeight: 420,
    maxImageWidth: 2048,
    maxImageHeight: 1230,
    browseClass: "btn btn-success",
    browseLabel: "Pick Image",
    browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
    removeClass: "btn btn-danger",
    removeLabel: "Delete",
    removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> "
});
$('#picklogo').ddslick({
    data: logos,
    width: "100%",
    height: 450,
    imagePosition: "left",
    selectText: "Select your logo"
});
$("#rules").animatedModal({
    modalTarget: 'design-rules',
    animatedIn: 'zoomIn',
    animatedOut: 'bounceOutDown',
    color: '#3498db',
});
$("#arguments").animatedModal({
    modalTarget: 'design-arguments',
    animatedIn: 'zoomIn',
    animatedOut: 'bounceOutDown',
    color: '#3498db',
},
$('#ifrm-design-arguments').prop('src', https://docs.google.com/a/groupon.com/spreadsheets/d/1tB-8IjzN6fGBaerrwK872bkMJN9cZrPMr0Z8BWFUXRs/pubhtml)
);

function chooseMockup() {
    $("#fileMockup").click();
}
$("#fileMockup").change(function() {
    $("form#formMockup").submit();
});