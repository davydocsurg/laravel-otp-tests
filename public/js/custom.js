// Generic Ajax GET function
function goGet(url) {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "GET",
            url,
            statusCode: {
                200: (res) => {
                    if (res.status != undefined) {
                        res.status == 200 ? resolve(res) : reject(res);
                    } else {
                        resolve(res);
                    }
                },
                500: (err) => {
                    err.status = 500;
                    reject(err);
                },
                404: (err) => {
                    err.status = 404;
                    reject(err);
                },
                419: (err) => {
                    err.status = 419;
                    reject(err);
                },
            },
        });
    });
}

// Generic Ajax POST function
function goPost(url, data) {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "POST",
            url,
            data,
            processData: false,
            contentType: false,
            statusCode: {
                200: (res) => {
                    if (res.status != undefined) {
                        res.status == 200 ? resolve(res) : reject(res);
                    } else {
                        resolve(res);
                    }
                },
                500: (err) => {
                    err.status = 500;
                    reject(err);
                },
                404: (err) => {
                    err.status = 404;
                    reject(err);
                },
                419: (err) => {
                    err.status = 419;
                    reject(err);
                },
            },
        });
    });
}

// Handle form error
function handleErr(err) {
    toastr.error("Please check your credentials and try again");
}

// Handle form error
function handleOTPResendSuccess(suc) {
    toastr.success("A new OTP has been sent to your email.");
}

function handleFormRes(res, form = false) {
    switch (res.status) {
        case 200:
            break;
        case 400:
            errors = res.message;

            if (typeof errors === "object") {
                for (const [key, value] of Object.entries(errors)) {
                    e = document.getElementById(key);
                    e.innerHTML = "";
                    [...value].forEach((m) => {
                        e.innerHTML += `<p>${m}</p>`;
                    });
                }
            } else {
                if (form) {
                    $("#" + form).html(errors);
                    $("#" + form).removeClass("d-none");
                } else {
                    showAlert(false, errors);
                }
            }
            break;

        default:
            if (form) {
                $("#" + form).text("Oops! Something's not right. Try Again");
                $("#" + form).removeClass("d-none");
            } else {
                showAlert(false, "Oops! Something's not right. Try Again");
            }
            break;
    }
}

// Toggle Spinner
let btnDis = false;

function spin(id) {
    btnDis = btnDis ? false : true;
    $(`#${id}-txt`).toggle();
    $(`#${id}-spinner`).toggle();

    btnDis
        ? $(`#${id}-btn`).attr("disabled", true)
        : $(`#${id}-btn`).removeAttr("disabled");
}

// Turn off Form Errors
function offError(form = false) {
    $(".error-message").html("");
    form ? $("#" + form).addClass("d-none") : null;
}

// Check response
function trueRes(res) {
    return res.status == 200 || res.status == undefined ? true : false;
}

// Show Alert
function showAlert(status, message) {
    if (!status) {
        $("#alert-error").html(message);
        $("#alert-error").removeClass("d-none");

        setTimeout(() => {
            $("#alert-error").addClass("d-none");
            $("#alert-error").html("");
        }, 4000);
    } else {
        $("#alert-success").html(message);
        $("#alert-success").removeClass("d-none");

        setTimeout(() => {
            $("#alert-success").addClass("d-none");
            $("#alert-success").html("");
        }, 4000);
    }
}

function refreshPage() {
    $("#refresh").css("display", "inline-block");
    setTimeout(() => {
        location.reload();
    }, 0500);
}

// loading...
function sendReq() {
    $(".spinner-border").css("display", "inline-block");
}

// stop loading...
function stopLoading() {
    $(".spinner-border").css("display", "none");
}

window.onscroll = () => {
    shrinkNavBar();
};

function shrinkNavBar() {
    if (
        document.body.scrollTop > 500 ||
        document.documentElement.scrollTop > 500
    ) {
        $("#navbar").css({
            padding: "3px 5px",
            margin: "0rem 0rem",
        });
        $("#navbar").addClass("fixed-top");
        // $(".logo").style.width = "2rem !important";
    } else {
        $("#navbar").css({
            padding: "15px 15px",
        });
        $("#navbar").removeClass("fixed-top");

        // $("#logo").style.fontSize = "35px !important";
    }
}

let yr = new Date().getFullYear();
$(".year").html(yr);

// ******************************************404 page***************************************************//

let pageX = $(document).width();
let pageY = $(document).height();
let mouseY = 0;
let mouseX = 0;

// $(document).ready(function () {
$(document).mousemove(function (event) {
    //verticalAxis
    mouseY = event.pageY;
    yAxis = ((pageY / 2 - mouseY) / pageY) * 300;
    //horizontalAxis
    mouseX = event.pageX / -pageX;
    xAxis = -mouseX * 100 - 100;

    $(".box__ghost-eyes").css({
        transform: "translate(" + xAxis + "%,-" + yAxis + "%)",
    });

    // console.log("X: " + xAxis);
});

function goHome() {
    location.href = `/`;
}

$(".resp-nav").click(() => {
    $("#hamburger-1").click();
});
// });

// const SELECTOR_PRELOADER = '.preloader';

// (function($) {
//     "use strict";

//     var fullHeight = function() {
//         $(".js-fullheight").css("height", $(window).height());
//         $(window).resize(function() {
//             $(".js-fullheight").css("height", $(window).height());
//         });
//     };
//     fullHeight();

//     var carousel = function() {
//         $(".home-slider").owlCarousel({
//             loop: true,
//             autoplay: true,
//             margin: 0,
//             animateOut: "fadeOut",
//             animateIn: "fadeIn",
//             nav: true,
//             dots: true,
//             autoplayHoverPause: false,
//             items: 1,
//             navText: [
//                 "<span class='ion-ios-arrow-back'></span>",
//                 "<span class='ion-ios-arrow-forward'></span>"
//             ],
//             responsive: {
//                 0: {
//                     items: 1
//                 },
//                 600: {
//                     items: 1
//                 },
//                 1000: {
//                     items: 1
//                 }
//             }
//         });
//     };
//     carousel();
// })(jQuery);

// $(function() {
//     if ($(".owl-2").length > 0) {
//         $(".owl-2").owlCarousel({
//             center: false,
//             items: 1,
//             loop: true,
//             stagePadding: 0,
//             margin: 20,
//             smartSpeed: 1000,
//             autoplay: true,
//             nav: true,
//             dots: true,
//             pauseOnHover: false,
//             responsive: {
//                 600: {
//                     margin: 20,
//                     nav: true,
//                     items: 2
//                 },
//                 1000: {
//                     margin: 20,
//                     stagePadding: 0,
//                     nav: true,
//                     items: 3
//                 }
//             }
//         });
//     }
// });
