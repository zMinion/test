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
        $("#rules").animatedModal({
                modalTarget:'design-rules',
                animatedIn:'zoomIn',
                animatedOut:'bounceOutDown',
                color:'#3498db',
        });
        $("#arguments").animatedModal({
                modalTarget:'design-arguments',
                animatedIn:'zoomIn',
                animatedOut:'bounceOutDown',
                color:'#3498db',
        }); 
        function chooseMockup() {
        	$("#fileMockup").click();
        }
        $("#fileMockup").change(function() {
    		$("form#formMockup").submit();
	});
	
var logosg = [
    {
        text: "UK/IE - Video available",
        value: 105,
        selected: true,
        description: "Position: left",
        imageSrc: "/logo/105.jpg"
    },
    {
        text: "FR - Video disponible",
        value: 107,
        selected: false,
        description: "Position: left",
        imageSrc: "/logo/107.jpg"
    },
    {
        text: "UK/IE - Video available",
        value: 106,
        selected: false,
        description: "Position: right",
        imageSrc: "/logo/106.jpg"
    },
    {
        text: "FR - Video disponible",
        value: 108,
        selected: false,
        description: "Position: right",
        imageSrc: "/logo/108.jpg"
    },
    {
        text: "Price drop",
        value: 101,
        selected: false,
        description: "FR",
        imageSrc: "/logo/101.jpg"
    },
    {
        text: "Price drop",
        value: 102,
        selected: false,
        description: "UK",
        imageSrc: "/logo/102.jpg"
    },
    {
        text: "Price drop",
        value: 103,
        selected: false,
        description: "NL/BE",
        imageSrc: "/logo/103.jpg"
    }	
];
	
var logost = [
    {
        text: "Best of Groupon",
        value: 02,
        selected: true,
        description: "All TMC deals except for DE, PL, UAE",		
        imageSrc: "/logo/02.jpg"
    },
    {
        text: "Booking",
        value: 01,
        selected: false,
        description: "xFly",
        imageSrc: "/logo/01.jpg"
    },
    {
        text: "Inter Hotel",
        value: 03,
        selected: false,
        description: "SEH",
        imageSrc: "/logo/03.jpg"
    },
    {
        text: "Qualys Hotel",
        value: 04,
        selected: false,
        description: "SEH",
        imageSrc: "/logo/04.jpg"
    },
    {
        text: "Relais du Silence",
        value: 05,
        selected: false,
        description: "SEH",
        imageSrc: "/logo/05.jpg"
    },
    {
        text: "Balladins Hotel",
        value: 06,
        selected: false,
        description: " ",
        imageSrc: "/logo/06.jpg"
    },
    {
        text: "P'tit Dej Hotel",
        value: 07,
        selected: false,
        description: " ",
        imageSrc: "/logo/07.jpg"
    },
    {
        text: "MSC Cruise",
        value: 08,
        selected: false,
        description: " ",
        imageSrc: "/logo/08.jpg"
    },
    {
        text: "Escale Oceania",
        value: 09,
        selected: false,
        description: " ",
        imageSrc: "/logo/09.jpg"
    },
    {
        text: "Phantasia LAND",
        value: 10,
        selected: false,
        description: " ",
        imageSrc: "/logo/10.jpg"
    },
    {
        text: "PlopsaCoo",
        value: 11,
        selected: false,
        description: " ",
        imageSrc: "/logo/11.jpg"
    },
    {
        text: "Local Star",
        value: 13,
        selected: false,
        description: " ",
        imageSrc: "/logo/13.jpg"
    },
    {
        text: "Costa Cruises",
        value: 14,
        selected: false,
        description: " ",
        imageSrc: "/logo/14.jpg"
    },
    {
        text: "Relais Heritage",
        value: 15,
        selected: false,
        description: " ",
        imageSrc: "/logo/15.jpg"
    },
    {
        text: "Renouveau Vacances",
        value: 16,
        selected: false,
        description: " ",
        imageSrc: "/logo/16.jpg"
    },
    {
        text: "Telethon",
        value: 17,
        selected: false,
        description: " ",
        imageSrc: "/logo/17.jpg"
    },
    {
        text: "Best of DACH",
        value: 19,
        selected: false,
        description: " ",
        imageSrc: "/logo/19.jpg"
    },
    {
        text: "BedyCasa",
        value: 20,
        selected: false,
        description: " ",
        imageSrc: "/logo/20.jpg"
    },
    {
        text: "AIRC",
        value: 21,
        selected: false,
        description: " ",
        imageSrc: "/logo/21.jpg"
    },
    {
        text: "Citotel",
        value: 22,
        selected: false,
        description: " ",
        imageSrc: "/logo/22.jpg"
    },
    {
        text: "Camping No 1",
        value: 23,
        selected: false,
        description: " ",
        imageSrc: "/logo/23.jpg"
    },
    {
        text: "CenterParcs",
        value: 24,
        selected: false,
        description: " ",
        imageSrc: "/logo/24.jpg"
    }	
];		


	